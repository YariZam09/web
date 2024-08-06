<?php
session_start();

// Declarar variables fuera del bloque if (para evitar errores)
$usuario = "";
$contrasena = "";
$conn = null;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos (localhost, root, sin contraseña)
    $conn = new mysqli("localhost", "root", "", "login");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener datos del formulario y sanitizarlos
    $usuario = $conn->real_escape_string($_POST["usuario"]);
    $contrasena = $conn->real_escape_string($_POST["contrasena"]);

    // Definir la variable $fecha_actual aquí
    $fecha_actual = date('Y-m-d H:i:s');

    // Validar datos
    if (empty($usuario) || empty($contrasena)) {
        $error_message = "Por favor, complete todos los campos.";
    } else {
        // Verificar si el usuario está bloqueado en la base de datos (con el nombre de columna correcto)
        $sql_bloqueo = "SELECT fecha_hora_bloqueo FROM usuarios_bloqueados WHERE usuario = '$usuario'";
        $result_bloqueo = $conn->query($sql_bloqueo);

        if ($result_bloqueo->num_rows > 0) {
            $row_bloqueo = $result_bloqueo->fetch_assoc();
            $fecha_bloqueo = strtotime($row_bloqueo['fecha_hora_bloqueo']);
            $tiempo_transcurrido = time() - $fecha_bloqueo;

            if ($tiempo_transcurrido < 30) {
                $tiempoRestante = 30 - $tiempo_transcurrido;
                $error_message = "Usuario bloqueado. Intente de nuevo en $tiempoRestante segundos.";
            } else {
                // Desbloquear al usuario
                $sql_desbloqueo = "DELETE FROM usuarios_bloqueados WHERE usuario = '$usuario'";
                $conn->query($sql_desbloqueo);
            }
        }

        if (empty($error_message)) { // Solo si no hay bloqueo activo
            // Consulta SQL para verificar credenciales
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verificar contraseña (sin hash, ya que no es necesario en este caso)
                if ($row["contrasena"] == $contrasena) {
                    // Inicio de sesión exitoso
                    $_SESSION['usuario'] = $usuario;

                    // Generar un token único para esta sesión
                    $token = bin2hex(random_bytes(16));
                    $_SESSION['token'] = $token;

                    // Redirigir a sesion.php con el token como parámetro GET
                    header("Location: sesion.php?token=$token");
                    exit;
                } else {
                    // Contraseña incorrecta
                    $error_message = "Contraseña incorrecta.";

                    // Lógica de bloqueo (solo actualizar si se alcanzan 3 intentos fallidos)
                    $sql_intentos = "SELECT COUNT(*) AS intentos FROM usuarios_bloqueados WHERE usuario = '$usuario'";
                    $result_intentos = $conn->query($sql_intentos);
                    $row_intentos = $result_intentos->fetch_assoc();
                    $intentos_fallidos = $row_intentos['intentos'];

                    if ($intentos_fallidos >= 2) { // Ya hubo 2 intentos fallidos, este es el tercero
                        // Bloquear o actualizar bloqueo en la base de datos
                        $sql_bloqueo_update = "INSERT INTO usuarios_bloqueados (usuario, fecha_hora_bloqueo) 
                                              VALUES ('$usuario', '$fecha_actual')
                                              ON DUPLICATE KEY UPDATE fecha_hora_bloqueo = '$fecha_actual'";
                        $conn->query($sql_bloqueo_update);
                    } else {
                        // Insertar un nuevo registro de intento fallido (si no existe)
                        $sql_insertar_intento = "INSERT IGNORE INTO usuarios_bloqueados (usuario, fecha_hora_bloqueo) VALUES ('$usuario', '$fecha_actual')";
                        $conn->query($sql_insertar_intento);
                    }
                }
            } else {
                // Usuario no encontrado
                $error_message = "Usuario no encontrado.";
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario Login</title>
    <style>
        /* (Aquí pondrás tus estilos) */
    </style>
</head>
<body>

    <form method="POST">
        <h2>Iniciar sesión</h2>

        <?php if ($error_message): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>

    <a href="registro.php">
        <button type="button">Registrarse</button>
    </a>
</body>
</html>
