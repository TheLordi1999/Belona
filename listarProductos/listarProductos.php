<?php
session_start(); // Asegúrate de que esta línea esté al principio, antes de cualquier salida HTML.

require("../config/conection.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding-top: 50px; /* Margen superior de 50px */
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            position: relative; /* Para posicionar el botón en la esquina superior derecha */
            box-sizing: border-box;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        .btn-create {
            display: inline-block;
            background-color: #28a745; /* Verde */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            position: absolute; /* Posiciona el botón en relación al contenedor */
            top: 20px; /* Margen desde la parte superior del contenedor */
            right: 20px; /* Margen desde la parte derecha del contenedor */
            transition: background-color 0.3s ease;
        }
        .btn-create:hover {
            background-color: #218838; /* Verde más oscuro */
        }
        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .search-container input {
            padding: 10px;
            width: 80%;
            max-width: 500px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50; /* Color de fondo de los encabezados de la tabla */
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("productTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                const td = tr[i].getElementsByTagName("td");
                for (let j = 0; j < td.length; j++) {
                    if (td[j]) {
                        if (td[j].innerHTML.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
        function confirmDelete(id) {
            if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
                window.location.href = `eliminar_producto.php?id=${id}`;
            }
        }
    </script>
</head>
<body>

<div class="container">
    <a href="../crearProductos/formulario.php" class="btn-create">Crear Nuevo Producto</a>

    <h2>Lista de Productos</h2>

    <?php
    if (isset($_SESSION['message'])) {
        $message_type = $_SESSION['message_type'] == "success" ? "alert-success" : "alert-error";
        echo '<div class="alert ' . $message_type . '">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar productos...">
    </div>

    <table id="productTable">
        <thead>
            <tr>
                <th>Medias/Color</th>
                <th>precio</th>
                <th>Talla 6-8</th>
                <th>Talla 8-10</th>
                <th>Talla 10-12</th>
                <th>Marca</th>
                <th>Tipo de Producto</th>
                <th>Referencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT p.id, p.description AS nombre, p.price AS precio, p.color, p.talla, p.cantidad, m.description AS marca, t.description AS tipo_producto, m.reference AS referencia
                    FROM product p
                    JOIN marcas m ON p.marca_id = m.id
                    JOIN type_produc t ON p.type_produc = t.id";
            $result = $conection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $precio_formateado = "$" . number_format($row["precio"], 2, ',', '.');
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                    echo "<td>" . $precio_formateado . "</td>";
                    echo "<td>" . htmlspecialchars($row["color"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["talla"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["cantidad"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["marca"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["tipo_producto"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["referencia"]) . "</td>";
                    echo "<td>
                            <button class='btn btn-edit'>Editar</button>
                            <button class='btn btn-delete' onclick=\"confirmDelete(" . $row["id"] . ")\">Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9' style='text-align: center;'>No se encontraron productos</td></tr>";
            }

            $conection->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
