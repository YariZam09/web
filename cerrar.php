<?php
session_start();
session_destroy(); // Destruir la sesión

// Eliminar la variable de autenticación
unset($_SESSION['autenticado']); 

header("Location: login.php"); // Redirigir al login
exit;
?>