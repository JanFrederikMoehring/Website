<?php

use Website\Database;

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once  __DIR__ . '/vendor/autoload.php';

// FQCN - Full quallified class name

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
    if (\array_key_exists($key,$_POST) && $_POST[$key] !== '') {
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

$db = new Database();

$db->createUsersTable();
$db->createToDosTable();
