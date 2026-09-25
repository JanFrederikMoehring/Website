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

}