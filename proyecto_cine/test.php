<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cine_db;charset=utf8", "usuario", "1234");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexión exitosa";
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}
?>