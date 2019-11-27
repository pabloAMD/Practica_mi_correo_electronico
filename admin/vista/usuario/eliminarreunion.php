<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Eliminar datos de persona</title>
</head>

<body>
    <?php

    $codigo = $_GET["eliminar"];
    echo "$codigo";
    $sql = "SELECT * FROM reunion where reu_id=$codigo";

    include '../../../config/conexionBD.php';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
            <form id="formulario01" method="POST" action="../../controladores/usuario/eliminar_reunion.php">
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
                <label for="fecha">Fecha (*)</label>
                <input type="text" id="fecha" name="fecha" value="<?php echo $row["reu_fecha"]; ?>" disabled />
                <br>
                <label for="hora">hora (*)</label>
                <input type="text" id="hora" name="hora" value="<?php echo $row["reu_hora"];
                                                                                ?>" disabled />
                <br>
                <label for="lugar">lugar (*)</label>
                <input type="text" id="lugar" name="lugar" value="<?php echo $row["reu_lugar"];
                                                                                    ?>" disabled />
                <br>
                <label for="latitud">latitud (*)</label>
                <input type="text" id="latitud" name="latitud" value="<?php echo $row["reu_latitud"];
                                                                                    ?>" disabled />
                <br>
                <label for="longitud">longitud (*)</label>
                <input type="text" id="longitud" name="longitud" value="<?php echo $row["reu_longitud"];
                                                                                ?>" disabled />
                <br>
              
                <label for="motivo">motivo  (*)</label>
                <input type="email" id="motivo" name="motivo" value="<?php echo $row["reu_motivo"]; ?>" disabled />
                <br>

                <label for="observaciones">observaciones (*)</label>
                <input type="text" id="observaciones" name="observaciones" value="<?php echo $row["reu_observaciones"]; ?>" disabled />
                <br>

                <input type="submit" id="eliminar" name="eliminar" value="Eliminar" />
                <button><a href='index.php'>Cancelar</a></button>
            </form>
    <?php
        }
    } else {
        echo "<p>Ha ocurrido un error inesperado !</p>";
        echo "<p>" . mysqli_error($conn) . "</p>";
    }
    $conn->close();
    ?>
</body>

</html>