<?php

require_once  './src/Database.php';

$db = new Database();
$db->createUsersTable();
$db->createToDosTable();
$db->createAdminUser();