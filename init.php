<?php
use Website\Database;
use Website\Cookies;

require_once  __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

new Cookies();

$whitelistedRoutes = [
    '/login.php',
    '/register.php'
];

if (!in_array(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $whitelistedRoutes, true) && ($_SESSION['user_id'] ?? null) === null) {
    header("Location: /login.php");
    exit;
}

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