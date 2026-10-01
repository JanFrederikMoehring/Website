<?php

namespace Website;

use PDO;
use Ramsey\Uuid\Uuid;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');

    }

    /**
     * @return void
     */
    public function createUser(string $email, string $pw): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (
            email,
            pw
        ) VALUES (
            :email,
            :pw
        )');

        $stmt->execute([
            'email' => $email,
            'pw' => $pw,
        ]);
    }

    /**
     * @return array<int, string>
     */
    public function getEmails(): array
    {
        $stmt = $this->pdo->query('SELECT email from users');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * @return void
     */
    public function createUsersTable(): void
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email VARCHAR UNIQUE,
            pw VARCHAR
    )   ');
    }

    public function getUser(string $email): ?User
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE email = :email'
        );
        $stmt->execute([
            'email' => $email,
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            return null;
        }

        return new User($user['id'], $user['email'], $user['pw']);

    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function createToDo(string $title, ?string $description, string $date, bool $status): void
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

        $stmt->execute([
            'uuid' => Uuid::uuid4()->toString(),
            'title' => $title,
            'description' => $description,
            'date' => $date,
            'status' => $status,
        ]);
    }

    /**
     * @return array<int, Todo>
     */
    public function getToDos(): array
    {
       $stmt = $this->pdo->query('SELECT * FROM todos');

        $todos = [];

        while (false !== $todo = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

    /**
     * @return ?array<int, mixed>|null>
     */
    public function getToDoByUuid(string $uuid): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM todos WHERE uuid = :uuid'
            );

        $stmt->execute([
            'uuid' => $uuid,    
        ]);
        
        $todo = $stmt->fetch(PDO::FETCH_ASSOC);

        return $todo === false ? null : $todo;
    }

    /**
     * @return void
     */
    public function updateToDo(string $uuid, string $title, ?string $description, bool $status): void
    {
        $stmt = $this->pdo->prepare("UPDATE todos
            SET title = :title,
                description = :description,
                status = :status
            WHERE uuid = :uuid");

        $stmt->execute([
            'uuid' => $uuid,
            'title' => $title,
            'description' => $description,
            'status' => $status,
        ]);
    }

    /**
     * @return void
     */
    public function deleteToDo(string $uuid): void
    {
        $stmt = $this->pdo->prepare(
            'DELETE FROM todos WHERE uuid = :uuid'
        );

        $stmt->execute([
            'uuid' => $uuid,
        ]);
    }

}