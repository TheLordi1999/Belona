<?php
session_start(); // Iniciar la sesión para almacenar mensajes temporales

require("../config/conection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $cantidad = $_POST['cantidad'];
    $talla = $_POST['talla'];
    $marca = $_POST['marca'];
    $tipo_producto = $_POST['tipo_producto'];

    if (empty($nombre) || empty($precio) || empty($color) || empty($talla) || empty($marca) || empty($tipo_producto)) {
        $_SESSION['message'] = "Todos los campos son obligatorios.";
        $_SESSION['message_type'] = "error";
        header("Location: formulario.php");
        exit;
    }

    // Preparar y ejecutar la consulta SQL
    $stmt = $conection->prepare("INSERT INTO `product`(`description`, `price`, `color`, `talla`, `cantidad`, `marca_id`, `type_produc`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssiii", $nombre, $precio, $color, $talla, $cantidad, $marca, $tipo_producto);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Producto creado exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error al crear el producto: " . $stmt->error;
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    $conection->close();

    header("Location: formulario.php");
    exit;
}
?>
