<?php
session_start();
require 'config.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    $accion  = $_POST['accion'] ?? '';

    if ($usuario === '' || $password === '') {
        $mensaje = "Por favor completa todos los campos.";
    } else {
        if ($accion === 'register') {
            $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE usuario = ?');
            $stmt->execute([$usuario]);
            if ($stmt->fetch()) {
                $mensaje = 'El usuario ya existe.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, password) VALUES (?, ?)');
                if ($stmt->execute([$usuario, $hash])) {
                    $mensaje = 'Usuario registrado correctamente. Ahora puedes iniciar sesión.';
                } else {
                    $mensaje = 'Error al registrar el usuario.';
                }
            }
        } elseif ($accion === 'login') {
            $stmt = $pdo->prepare('SELECT id, password FROM usuarios WHERE usuario = ?');
            $stmt->execute([$usuario]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php');
                exit;
            } else {
                $mensaje = 'Usuario o contraseña incorrectos.';
            }
        } else {
            $mensaje = 'Acción no válida.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Registro - Cine</title>
<link rel="stylesheet" href="css/style.css">
<script>
function showForm(formId) {
    document.querySelectorAll(".caja-formulario").forEach(form => form.classList.remove("active"));
    document.getElementById(formId).classList.add("active");
}
</script>
</head>
<body class="login-page">

<div class="login-container">
    <?php if ($mensaje): ?>
        <p class="error"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form id="loginForm" class="caja-formulario active" action="" method="POST">
        <h2>Iniciar Sesión</h2>
        <input type="hidden" name="accion" value="login">
        <label>Usuario</label>
        <input type="text" name="usuario" required>
        <label>Contraseña</label>
        <input type="password" name="password" required>
        <button type="submit">Entrar</button>
        <p>No tienes cuenta? <a href="#" onclick="showForm('registerForm'); return false;">Registrate</a></p>
    </form>

    <form id="registerForm" class="caja-formulario" action="" method="POST">
        <h2>Registrarse</h2>
        <input type="hidden" name="accion" value="register">
        <label>Usuario</label>
        <input type="text" name="usuario" required>
        <label>Contraseña</label>
        <input type="password" name="password" required>
        <label>Confirmar contraseña</label>
        <input type="password" name="confirmar" required>
        <button type="submit">Registrar</button>
        <p>Ya tienes cuenta? <a href="#" onclick="showForm('loginForm'); return false;">Inicia Sesión</a></p>
    </form>
</div>

</body>
</html>
