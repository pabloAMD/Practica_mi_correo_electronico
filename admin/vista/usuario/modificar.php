<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/estilos/estilos.css">
    <title>Modificar datos de persona</title>
</head>

<body>
    <section>
    <?php
    $codigo = $_GET["codigo"];
    $sql = "SELECT * FROM usuario where usu_id=$codigo";
    include '../../../config/conexionBD.php';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
            <form id="formulario01" method="POST" action="../../controladores/usuario/modificar.php">

                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
                <label for="cedula">Cedula (*)</label>
                <input type="text" id="cedula" name="cedula" value="<?php echo $row["usu_cedula"]; ?>" required placeholder="Ingrese la cedula ..." />
                <br>
                <label for="nombres">Nombres (*)</label>
                <input type="text" id="nombres" name="nombres" value="<?php echo $row["usu_nombre"];
                                                                                ?>" required placeholder="Ingrese los dos nombres ..." />
                <br>
                <label for="apellidos">Apelidos (*)</label>
                <input type="text" id="apellidos" name="apellidos" value="<?php echo $row["usu_apellido"];
                                                                                    ?>" required placeholder="Ingrese los dos apellidos ..." />
                <br>
                <label for="direccion">Dirección (*)</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $row["usu_direccion"];
                                                                                    ?>" required placeholder="Ingrese la dirección ..." />
                <br>
                <label for="telefono">Teléfono (*)</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $row["usu_telefono"];
                                                                                ?>" required placeholder="Ingrese el teléfono ..." />
                <br>
           
                <label for="correo">Correo electrónico (*)</label>
                <input type="email" id="correo" name="correo" value="<?php echo $row["usu_correo"]; ?>" required placeholder="Ingrese el correo electrónico ..." />
                <br>

                <label for="correo">Contraseña (*)</label>
                <input type="text" id="contrasenia" name="contrasenia" value="<?php echo $row["usu_contrasenia"]; ?>" required placeholder="Ingrese la contraseña ..." />
                <br>

                <input type="submit" id="modificar" name="modificar" value="Modificar" />
                
            </form>
    <?php
        }
    } else {
        echo "<p>Ha ocurrido un error inesperado !</p>";
        echo "<p>" . mysqli_error($conn) . "</p>";
    }
    $conn->close();
    ?>
    </section>
</body>

</html>