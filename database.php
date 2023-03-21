<?php

$host = "sql9.freesqldatabase.com";
$dbname = "sql9607367";
$username = "sql9607367";
$password = "mQQXyFvQAn";

$mysqli = new mysqli(hostname: $host,
                     username: $username,
                     password: $password,
                     database: $dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;