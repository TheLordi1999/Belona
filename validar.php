<?php

require("conection.php");

$email=$_POST['email'];
$contraseña=$_POST['password'];
session_start();

$_SESSION['email']=$email;

$consulta="SELECT * FROM login WHERE email='$email' and contraseña='$contraseña'";
$resultado=mysqli_query($conection,$consulta);
$filas=mysqli_num_rows($resultado);

if($filas)
{
    header("server.html");
}

else
{


    
}
?>