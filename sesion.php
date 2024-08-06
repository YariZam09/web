<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si el token coincide
if (!isset($_SESSION['usuario']) || !isset($_SESSION['token']) || !isset($_GET['token']) || $_GET['token'] !== $_SESSION['token']) {
    // Redirigir a login.php si no se cumple alguna de las condiciones
    header("Location: login.php");
    exit;
}

// Invalidar el token después de usarlo
unset($_SESSION['token']); // NUEVO

// Obtener datos del usuario de la sesión
$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sesión iniciada</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $usuario; ?>!</h2>
    <table>
        <tr><th>Nombre</th></tr>
        <tr><td><?php echo $usuario; ?></td></tr>
    </table>

    <form action="cerrar.php" method="POST">
        <input type="submit" value="Cerrar Sesión">
    </form>
</body>
</html>