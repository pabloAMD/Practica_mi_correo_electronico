<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invitar a una persona </title>
</head>

<body>
    <?php
    //incluir conexión a la base de datos
    include '../../../config/conexionBD.php';

    $id_reunion =$_POST["id_reunionn"];
    echo "casi llega  + $id_reunion";

    $inv_correo = isset($_POST["correo"]) ? trim($_POST["correo"], 'UTF-8') : null;
    $sql1="SELECT *  FROM usuario WHERE usu_correo = '$inv_correo' ";
    $result1 = $conn->query($sql1);
    while ($row = $result1->fetch_assoc()) {
        $id_correo_inv = $row["usu_id"];
    }
    echo "sorry + $id_correo_inv";



    
    $sql2 = "INSERT INTO tipo_participante VALUES (0,$id_correo_inv, $id_reunion,'invitado', null)";
    if ($conn->query($sql2) === TRUE) {
        echo "<p>Se ha creado los datos en la base tipo_participante correctamemte!!!</p>";

    } else {
        if ($conn->errno == 1062) {
            echo "<p ocurrio algo</p>";
        } else {
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
        
    }
   
    echo "<a href='../../vista/usuario/index_usuario.php'>Regresar</a>";
    $conn->close();
    ?>
</body>

</html>