<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');

// Users Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email VARCHAR UNIQUE,
        pw VARCHAR
)   ');

// To Dos Tabelle erstellen
$db->query('CREATE TABLE IF NOT EXISTS todos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    Title TEXT,
    Description TEXT,
    Date TEXT,
    Status TEXT
)');