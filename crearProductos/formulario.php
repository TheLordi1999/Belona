<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 50px; /* Margen superior de 50px */
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
            transition: background-color 0.3s ease;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            box-sizing: border-box;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        .btn:hover {
            background-color: #218838;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 16px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group.half-width {
            flex: 1 1 calc(33.333% - 20px);
        }
        .form-group.full-width {
            flex: 1 1 100%;
        }
    </style>
</head>
<body>

<div class="container">
<a href="../listarProductos/listarProductos.php" class="btn-create">Ver Productos</a>
    <h2>Crear Producto</h2>

    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        $message_type = $_SESSION['message_type'] == "success" ? "alert-success" : "alert-error";
        echo '<div class="alert ' . $message_type . '">' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>

    <form action="procesar_producto.php" method="post">
        <div class="form-row">
            <div class="form-group half-width">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group half-width">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
            </div>
            <div class="form-group half-width">
                <label for="color">Color</label>
                <input type="text" id="color" name="color" required>
            </div>
            <div class="form-group half-width">
                <label for="talla">Talla</label>
                <input type="text" id="talla" name="talla" required>
            </div>
            <div class="form-group half-width">
                <label for="cantidad">Cantidad</label>
                <input type="text" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group half-width">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" required>
                    <option value="">Selecciona una marca</option>
                    <?php
                    require("../config/consultas.php");
                    if ($marcas_result->num_rows > 0) {
                        while ($row = $marcas_result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["description"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group half-width">
                <label for="tipo_producto">Tipo de Producto</label>
                <select name="tipo_producto" id="tipo_producto" required>
                    <option value="">Selecciona un tipo</option>
                    <?php
                    if ($tipos_result->num_rows > 0) {
                        while ($row = $tipos_result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["description"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group full-width">
                <button type="submit" class="btn">Crear Producto</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
