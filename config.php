<?php
if (session_status() === PHP_SESSION_NONE) {

    session_start();
}

$DB_HOST = 'login.com';
$DB_NAME = 'simple_auth';
$DB_USER = 'root';
$DB_PASS = 'admin123';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);


if ($mysqli->connect_errno) {
    
    die('DB connect error: ' . $mysqli->connect_errno);
}
?>
