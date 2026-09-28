<?php

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'sqlite:' . __DIR__ . '/../public/database/database.sqlite');

    }

    public function getEmails(): array
    {
        $stmt = $this->pdo->query('SELECT email from users');
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
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
            title TEXT,
            description TEXT,
            date TEXT,
            status TEXT
    )   ');

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

    public function getToDos()
    {
        
       $stmt = $this->pdo->query('SELECT * FROM todos');

        while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Variable für Übergabeparameter definieren
            $number = $todo['id'];
        ?>

            <tr>
                <td><?= $todo['id'] ?></td>
                <td><?= $todo['title'] ?></td>
                <td><?= $todo['description'] ?></td>
                <td><?= $todo['date'] ?></td>

                <td>
                    <input class="checkbox" type="checkbox" <?= $todo['status'] == 1 ? 'checked' : '' ?> disabled>
                </td>

                <td>
                    <a href="/todoupdate.php?id=<?=urlencode($number) ?>">⌨</a>
                </td>

                <td>
                    <a href="/tododelete.php?id=<?=urlencode($number) ?>">🗑</a>
                </td>
            </tr>

        <?php
        }
    }

    public function columnById(string $argument, int $number)
    {
        $stmt = $this->pdo->prepare($argument);
        $stmt->execute([$number]);
        return $todo = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createToDo(string $title, string $description, string $date, int $checked): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO todos (
            title,
            description,
            date,
            status
        ) VALUES (
            :title,
            :description,
            :date,
            :status
        )');

        $stmt->bindValue('title', $title);
        $stmt->bindValue('description', $description);
        $stmt->bindValue('date', $date);
        $stmt->bindValue('status', $checked);
        $stmt->execute();
    }

    public function updateToDos( int $number, string $title, string $description, int $status)
    {
        $stmt = $this->pdo->prepare("UPDATE todos
            SET title = :title,
                description = :description,
                status = :status
            WHERE id = $number");

        $stmt->bindValue('title', $title);
        $stmt->bindValue('description', $description);
        $stmt->bindValue('status', $status);
        $stmt->execute();
    }

}