<?php
// Conexión a la base de datos (localhost, root, sin contraseña)
$conn = new mysqli("localhost", "root", "", "login");

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener la fecha y hora actual menos 30 segundos
$fecha_limite = date('Y-m-d H:i:s', time() - 30);

// Eliminar bloqueos expirados
$sql = "DELETE FROM usuarios_bloqueados WHERE fecha_hora_bloqueo < '$fecha_limite'";
$conn->query($sql);

$conn->close();
