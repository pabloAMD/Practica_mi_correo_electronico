<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear Nueva Reunion</title>
    <style type="text/css" rel="stylesheet">
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';

        $sql1="SELECT( MAX(reu_id))+1 as consulta FROM reunion";
        $result1 = $conn->query($sql1);
        

        while ($row = $result1->fetch_assoc()) {
            $id_reuniones = $row["consulta"];
        }
        echo "$id_reuniones";
       





    echo "valor :".$_SESSION['id'];
    $id_usuario = $_SESSION['id'];

    $fecha = isset($_POST["fecha"]) ? trim($_POST["fecha"]) : null;
    $hora = isset($_POST["hora"]) ? mb_strtoupper(trim($_POST["hora"]), 'UTF-8') : null;
    $lugar = isset($_POST["lugar"]) ? mb_strtoupper(trim($_POST["lugar"]), 'UTF-8') : null;
    $latitud = isset($_POST["latitud"]) ? mb_strtoupper(trim($_POST["latitud"]), 'UTF-8') : null;
    $longitud = isset($_POST["longitud"]) ? trim($_POST["longitud"]) : null;
    $motivo = isset($_POST["motivo"]) ? trim($_POST["motivo"]) : null;
    /*$fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]) : null;*/
    $observaciones = isset($_POST["observaciones"]) ? trim($_POST["observaciones"]) : null;

    $sql = "INSERT INTO reunion VALUES ($id_reuniones,'$fecha', '$hora', '$lugar', '$latitud', '$longitud','$motivo', '$observaciones',  'N')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Se ha creado los datos de la reunion correctamemte!!!</p>";

    } else {
        if ($conn->errno == 1062) {
            echo "<p ocurrio algo</p>";
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }


    $sql2 = "INSERT INTO tipo_participante VALUES (0,$id_usuario, $id_reuniones,'remitente',null)";
    if ($conn->query($sql2) === TRUE) {
        echo "<p>Se ha creado los datos en la base tipo_participante correctamemte!!!</p>";

    } else {
        if ($conn->errno == 1062) {
            echo "<p ocurrio algo</p>";
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }

    }





    //cerrar la base de datos
    $conn->close();
    echo "<a href='../../admin/vista/usuario/index_usuario.html'>Regresar</a>";

    ?>
</body>

</html>