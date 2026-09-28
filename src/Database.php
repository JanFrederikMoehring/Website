<?php

namespace Website;

use PDO;
use Ramsey\Uuid\Uuid;

class Database
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO('sqlite:' . __DIR__ . '/../public/database/database.sqlite');

    }

    /**
     * @return array<int, string>
     */
    public function getEmails(): array
    {
        $stmt = $this->pdo->query('SELECT email from users');
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function createUsersTable(): void
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email VARCHAR UNIQUE,
            pw VARCHAR
    )   ');
    }

    public function createToDosTable(): void
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS todos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            uuid TEXT,
            title TEXT,
            description TEXT,
            date TEXT,
            status TEXT
        ) ');
    }

    public function createUser(string $email, string $pw): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (
            email,
            pw
        ) VALUES (
            :email,
            :pw
        )');

        $stmt->bindValue('email', $email);
        $stmt->bindValue('pw', $pw);
        $stmt->execute();
    }

    /**
     * @return array<int, Todo>
     */
    public function getToDos(): array
    {
       $stmt = $this->pdo->query('SELECT * FROM todos');

        $todos = [];

        while (false !== $todo = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $todos[] = new Todo(
                $todo['id'],
                $todo['uuid'],
                $todo['title'],
                $todo['description'] === '' ? null : $todo['description'],
                $todo['date'],
                $todo['status'] === '1' ? true : false,
            );
        }

        return $todos;
    }

    public function columnById(string $argument, string $number)
    {
        $stmt = $this->pdo->prepare($argument);
        $stmt->execute([$number]);
        return $todo = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createToDo(string $title, ?string $description, string $date, int $checked): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO todos (
            uuid,
            title,
            description,
            date,
            status
        ) VALUES (
            :uuid,
            :title,
            :description,
            :date,
            :status
        )');

        $stmt->bindValue('uuid', Uuid::uuid4());
        $stmt->bindValue('title', $title);
        $stmt->bindValue('description', $description);
        $stmt->bindValue('date', $date);
        $stmt->bindValue('status', $checked);
        $stmt->execute();
    }

    public function updateToDos( string $number, string $title, string $description, int $status)
    {
        $stmt = $this->pdo->prepare("UPDATE todos
            SET title = :title,
                description = :description,
                status = :status
            WHERE uuid = :uuid");

        $stmt->bindValue('title', $title);
        $stmt->bindValue('description', $description);
        $stmt->bindValue('status', $status);
        $stmt->bindValue('uuid', $number);
        $stmt->execute();
    }

}