<?php
// Datos para la conexión a la base de datos
$serverName = "localhost";
$userName = "root";
$password = "holakace1";
$dbName = 'eq5coreanos';

// Conexión al servidor MySQL
$db_cnx = mysql_connect($serverName, $userName, $password);
if (!$db_cnx) {
    die('No se pudo conectar: ' . mysql_error());
}
//echo "Conexión exitosa <br>";

// Selección de la base de datos
mysql_select_db($dbName, $db_cnx) or die ('No se pudo seleccionar la base de datos: ' . mysql_error());

// Obtenemos los datos del formulario
$nombre_album = $_POST['nombre_album'];
$nombre_artista = $_POST['nombre_artista'];
$correo_electronico = $_POST['correo_electronico'];
$tipo_pedido = $_POST['tipo']; 
$envio_nacional = isset($_POST['envio_nacional']) ? 1 : 0; // Checkbox
$genero_album = $_POST['genero_album'];

// Insertar datos en la base de datos
$sql_cmd = "INSERT INTO Pedidos (nombre_album, nombre_artista, correo_electronico, tipo_pedido, envio_nacional, genero_album) VALUES ('$nombre_album', '$nombre_artista', '$correo_electronico', '$tipo_pedido', $envio_nacional, '$genero_album')";
$result = mysql_query($sql_cmd, $db_cnx);
if (!$result) {
    die('Error al insertar los datos: ' . mysql_error());
} else {
    $last_id = mysql_insert_id($db_cnx); // Obtén el ID del último pedido insertado
    $count_sql = "SELECT COUNT(*) AS total FROM Pedidos";
    $count_result = mysql_query($count_sql, $db_cnx);
    $row = mysql_fetch_assoc($count_result);
    $total_pedidos = $row['total'];

    // Crear un mensaje personalizado
    $response = "¡Gracias! Tu solicitud con identificador: $last_id se ha guardado exitosamente. Al correo proporcionado ($correo_electronico) se te hará llegar más información en cuanto esté disponible. Hay $total_pedidos pedidos en espera antes que el tuyo.";
    echo $response;
}

// Cerrar conexión
mysql_close($db_cnx);
?>
