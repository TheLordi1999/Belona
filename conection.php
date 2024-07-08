<?php 
$hostname = "localhost";
$user = "root";
$password = "";
$database = "belona.data";
$conection = new mysqli("127.0.0.1", "root", "password","Medias",);

if ($conection->connect_error) {
    die("connection failed".$conection->connect_error);
};
echo "conection load";
?>
