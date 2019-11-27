<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificar datos de persona </title>
</head>

<body>
    <?php
    //incluir conexión a la base de datos
    include '../../../config/conexionBD.php';
    $codigo = $_POST["codigo"];
    $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
    $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
    $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
    $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
    $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
    $correo = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
    $contrasenia = isset($_POST["contrasenia"]) ? trim($_POST["contrasenia"]) : null;
    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d H:i:s', time());
    $sql = "UPDATE usuario " .
        "SET usu_cedula = '$cedula', " .
        "usu_nombre = '$nombres', " .
        "usu_apellido = '$apellidos', " .
        "usu_direccion = '$direccion', " .
        "usu_telefono = '$telefono', " .
        "usu_correo = '$correo', " .
        "usu_contrasenia = '$contrasenia', " .
        "usu_modificacion = '$fecha' " .
        "WHERE usu_id = $codigo";
    if ($conn->query($sql) === TRUE) {
        echo "Se ha actualizado los datos personales correctamemte!!!<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
    echo "<a href='../../vista/usuario/index.php'>Regresar</a>";
    $conn->close();
    ?>
</body>

</html>