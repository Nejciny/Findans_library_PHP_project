<?php

$serverName = "localhost";
$DbUsername = "root";
$DbPassword = "";
$DbName = "phpproject01";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect($serverName, $DbUsername, $DbPassword, $DbName);

if (!$conn) {

    die("Something went wrong with the connection to the database: ". mysqli_connect_error() );
}