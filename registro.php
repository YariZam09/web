<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "login");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener datos del formulario (recuerda validar y sanitizar)
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a login.php después del registro exitoso
        header("Location: login.php");
        exit; // Importante: detener la ejecución del script después de la redirección
    } else {
        echo "<p>Error al registrar: " . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario Registro</title>
    <style>
        /* (Mismos estilos que en index.html) */
    </style>
</head>
<body>

    <form method="POST">
        <h2>Registrarse</h2>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <input type="submit" value="Registrarse">
    </form>

</body>
</html>