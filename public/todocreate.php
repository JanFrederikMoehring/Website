<?php

require_once __DIR__ . '/../init.php';

// Nur POST-Requests akzeptieren
if (isPost() === false) {
    header('Location: /todo.php?error=no-post');
    exit;
}

// Variablen definieren
$title = getPostParam('title');
$description = getPostParam('description');
$status = getPostParam('checkbox') !== null;

// Leeren Title ausschließen
if ($title === null) {
    header('Location: /todo.php?error=no-title');
    exit;
}

// Zu kurzen Title ausschließen
if (strlen($title) < 3) {
    header('Location: /todo.php?error=short-title');
    exit;
}

// Eingabedatum definieren
$timestamp = time();
$date = date('d.m.Y.', $timestamp);

$db->createToDo($title, $description, $date, $status);

// Redirect
header('Location: /todo.php');