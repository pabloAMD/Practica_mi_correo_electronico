<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/estilos/estilos.css">
    <title>Gestión de usuarios</title>
</head>

<body>
<?php
 session_start();
 if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
 header("Location: ../../../public/vista/login.html");
 }
?>
 <h2>Datos personales </h2>

    <table style="width:100%">
        <tr>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Eliminado</th>


        </tr>
        <?php
        
        include '../../../config/conexionBD.php';

        echo "valor :" . $_SESSION['usu'];
        echo "valor :" . $_SESSION['contra'];
        $aux = $_SESSION['usu'];
        $aux1 = $_SESSION['contra'];



        $sql = "SELECT * FROM usuario WHERE usu_correo = '$aux' and usu_contrasenia ='$aux1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            echo "Usuarios";
            while ($row = $result->fetch_assoc()) {
                $id_sql = $row["usu_id"];

                echo "<tr>";
                echo " <td>" . $row["usu_correo"] . "</td>";
                echo " <td>" . $row["usu_contrasenia"] . "</td>";
                echo " <td>" . $row["usu_cedula"] . "</td>";
                echo " <td>" . $row['usu_nombre'] . "</td>";
                echo " <td>" . $row['usu_apellido'] . "</td>";
                echo " <td>" . $row['usu_direccion'] . "</td>";
                echo " <td>" . $row['usu_telefono'] . "</td>";
                echo " <td>" . $row["usu_eliminado"] . "</td>";
                echo " <td> <a href='eliminar.php?codigo=" . $row['usu_id'] . "'>Eliminar</a> </td>";
                echo " <td> <a href='modificar.php?codigo=" . $row['usu_id'] . "'>Modificar</a> </td>";
                /* echo " <td> <a href='cambiar_contrasena.php?codigo=" . $row['usu_id'] . "'>Cambiarcontraseña</a> </td>";*/

                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
            echo "</tr>";
        }



        $conn->close();
        ?>
    </table>

    <table style="width:100%">
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Fecha de la reunion</th>
            <th>Hora de la reunion</th>
            <th>Lugar</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Motivo </th>
            <th>Observaciones</th>
            <th>Cargo</th>
          



        </tr>
        <h2>Listado de las reuniones creadas </h2>

        <?php
        include '../../../config/conexionBD.php';


        /************************************************************************************************ */

        $sql1 = "SELECT
            usuario.usu_cedula,usuario.usu_nombre,usuario.usu_apellido,usuario.usu_telefono,usuario.usu_direccion,
            reunion.reu_fecha,reunion.reu_hora,reunion.reu_lugar,reunion.reu_latitud,reunion.reu_longitud,reunion.reu_motivo,reunion.reu_observaciones,
            tipo_participante.tip_cargo,reunion.reu_id
         FROM
            tipo_participante,
            usuario,
            reunion
        WHERE
            tipo_participante.tip_usu_id = $id_sql
            and usuario.usu_id = $id_sql
            and tipo_participante.tip_reu_id = reunion.reu_id
            and tipo_participante.tip_cargo = 'remitente'
            AND reunion.reu_eliminado = 'N'
            GROUP by tip_id;";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {

            echo "Reuniones";
            while ($row1 = $result1->fetch_assoc()) {

                echo "<tr>";
                echo " <td>" . $row1["usu_cedula"] . "</td>";
                echo " <td>" . $row1["usu_nombre"] . "</td>";
                echo " <td>" . $row1["usu_apellido"] . "</td>";
                echo " <td>" . $row1['usu_telefono'] . "</td>";
                echo " <td>" . $row1['usu_direccion'] . "</td>";
                echo " <td>" . $row1["reu_fecha"] . "</td>";
                echo " <td>" . $row1["reu_hora"] . "</td>";
                echo " <td>" . $row1["reu_lugar"] . "</td>";
                echo " <td>" . $row1['reu_latitud'] . "</td>";
                echo " <td>" . $row1['reu_longitud'] . "</td>";
                echo " <td>" . $row1['reu_motivo'] . "</td>";
                echo " <td>" . $row1['reu_observaciones'] . "</td>";
                echo " <td>" . $row1['tip_cargo'] . "</td>";
                /*echo " <td>" . $row1['reu_id'] . "</td>";*/
                echo " <td> <a href='invitar.php?invitar=" . $row1['reu_id'] . "'>Invitar</a> </td>";

                echo "</tr>";
                
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen reuniones registradas en el sistema </td>";
            echo "</tr>";
        }
        /******************************************************************************* */



        $conn->close();
        ?>
    </table>









    
    <table style="width:100%">
        <tr>
       
            <th>Fecha de la reunion</th>
            <th>Hora de la reunion</th>
            <th>Lugar</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Motivo </th>
            <th>Observaciones</th>
            <th>Cargo</th>
          



        </tr>
        <h2>Listado de las reuniones a las cuales esta invitado </h2>

        <?php
        include '../../../config/conexionBD.php';


        /************************************************************************************************ */

        $sql1 = "SELECT
        reunion.reu_fecha,reunion.reu_hora,reunion.reu_lugar,reunion.reu_latitud,reunion.reu_longitud,reunion.reu_motivo,reunion.reu_observaciones,
        tipo_participante.tip_cargo
    FROM
        tipo_participante,
        usuario,
        reunion
    WHERE
        tipo_participante.tip_usu_id = $id_sql
        and usuario.usu_id = $id_sql
        and tipo_participante.tip_reu_id = reunion.reu_id
        and tipo_participante.tip_cargo = 'invitado'
        AND reunion.reu_eliminado = 'N'
        GROUP by tip_id;";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {

            echo "Reuniones";
            while ($row1 = $result1->fetch_assoc()) {

                echo "<tr>";
            
                echo " <td>" . $row1["reu_fecha"] . "</td>";
                echo " <td>" . $row1["reu_hora"] . "</td>";
                echo " <td>" . $row1["reu_lugar"] . "</td>";
                echo " <td>" . $row1['reu_latitud'] . "</td>";
                echo " <td>" . $row1['reu_longitud'] . "</td>";
                echo " <td>" . $row1['reu_motivo'] . "</td>";
                echo " <td>" . $row1['reu_observaciones'] . "</td>";
                echo " <td>" . $row1['tip_cargo'] . "</td>";
                /*echo " <td>" . $row1['reu_id'] . "</td>";*/
                /*echo " <td> <a href='invitar.php?invitar=" . $row1['reu_id'] . "'>Invitar</a> </td>";*/

                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen reuniones registradas en el sistema </td>";
            echo "</tr>";
        }
        /******************************************************************************* */



        $conn->close();
        ?>
    </table>




    <button><a href='../../../public/vista/crear_Reunion.html'>Crear Reunion</a></button>
    <button><a href='../../../config/cerrar_sesion.php'>Cerrar Sesion</a></button>




</body>

</html>