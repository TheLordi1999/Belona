<?php
require("../config/conection.php");

$marcas_sql = "SELECT * FROM marcas";
$marcas_result = $conection->query($marcas_sql);

$tipos_sql = "SELECT * FROM type_produc";
$tipos_result = $conection->query($tipos_sql);

?>