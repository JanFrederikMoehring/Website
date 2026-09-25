<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once  __DIR__ . '/src/User.php';
require_once  __DIR__ . '/src/Database.php';

$db = new Database();

// Users Tabelle erstellen
$db->createUsersTable();

// To Dos Tabelle erstellen
$db->createToDosTable();

function isPost(): bool 
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return true;
    } else {
        return false;
    }
};

function getPostParam(string $key): null|string
{
    if (array_key_exists($key,$_POST) && $_POST[$key] !== '') {
        return $_POST[$key];
    } else {
        return null;
    }
}

function dd(mixed $value): never
{
    var_dump($value);
    exit;
}