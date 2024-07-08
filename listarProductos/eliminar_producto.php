<?php
require("../config/conection.php");

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Preparar la sentencia SQL para eliminar el producto
    $stmt = $conection->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Redirigir con un mensaje de éxito
        session_start();
        $_SESSION['message'] = "Producto eliminado exitosamente.";
        $_SESSION['message_type'] = "success";
    } else {
        // Redirigir con un mensaje de error
        session_start();
        $_SESSION['message'] = "Error al eliminar el producto.";
        $_SESSION['message_type'] = "error";
    }

    $stmt->close();
    $conection->close();
} else {
    // Redirigir con un mensaje de error si no se proporciona un ID
    session_start();
    $_SESSION['message'] = "ID de producto no proporcionado.";
    $_SESSION['message_type'] = "error";
}

// Redirigir de vuelta a la página de lista de productos
header("Location: listarProductos.php");
exit();
?>
