<?php

$dbHost = '127.0.0.1:3306';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'eventos';

$conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

define('SITE_ROOT', __DIR__);


?>
