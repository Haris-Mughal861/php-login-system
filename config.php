<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


$DB_HOST = 'login.com';
$DB_NAME = 'simple_auth';
$DB_USER = 'root';
$DB_PASS = 'admin123';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);


if($mysqli->connect_errno){

    die ('db connect error: ' . $mysqli->connect_errno);

}


function flash($key = null, $value = null) {

    if ($key !== null && $value !== null) {


        $_SESSION['flash'][$key] = $value;

        return;

    }

    if ($key !== null && isset($_SESSION['flash'][$key])) {

        $message = $_SESSION['flash'][$key];

        unset($_SESSION['flash'][$key]);
        
        return $message;
    }

    return null;

}


?>