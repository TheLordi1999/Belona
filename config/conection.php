<?php 
$hostname = "localhost";
$user = "root";
$password = "";
$database = "belona.data";
$conection = new mysqli($hostname, $user, $password, $database);

if ($conection->connect_error) {
    die("connection failed".$conection->connect_error);
};
?>