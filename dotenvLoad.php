<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$dotenv->required('DB_HOST')->notEmpty();
$dotenv->required('DB_USER')->notEmpty();
$dotenv->required('DB_NAME')->notEmpty();

?>