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
    include '../../../config/conexionBD.php';
     /*echo $_GET["invitar"];*/
     $codigo = $_GET["invitar"];

    
   

    $sql = "SELECT * FROM reunion WHERE reu_id = $codigo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            ?>
            <form id="formulario01" method="POST" action="../../controladores/usuario/invitar.php">

                <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />

                
                <input type="text" id="id_reunionn" name="id_reunionn" value="<?php echo $row["reu_id"];?>"  />
               
                <input type="text" id="reunion" name="reunion" value="<?php echo $row["reu_motivo"];?>" disabled />
              
                <input type="text" id="correo" name="correo" value="" required placeholder="Correo ..." />
                <br>
                
                

                <input type="submit" id="invitar" name="invitar" value="invitar" />
                
            </form>
            <a  class="a" href='./index_usuario.php'>Volver</a>
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