<?php 
$hostname = "localhost";
$user = "root";
$password = "Lfranco23*";
$database = "db_belona";
$conection = new mysqli($hostname, $user, $password, $database);

if ($conection->connect_error) {
    die("connection failed".$conection->connect_error);
};
?>
