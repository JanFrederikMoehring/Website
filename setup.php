<?php

use Website\Database;

require_once  __DIR__ . '/vendor/autoload.php';

$db = new Database();
$db->createUsersTable();
$db->createToDosTable();
$db->createAdminUser();