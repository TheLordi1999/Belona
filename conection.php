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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="validar.php" method="POST"></form>
            <h1>Login</h1>

            <div class="input-box">
                <input type="username" placeholder="Username"requiered>
                
            </div>

            <div class="input-box">
                <input type="password"
                placeholder="Password" required>
                
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">¿Forgot password?</a>
            </div> 
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>