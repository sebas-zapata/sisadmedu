<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sisadmedu";

try {
    
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";

    
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Manejo de errores con excepciones
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devolver resultados como arreglos asociativos
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Deshabilitar emulación de sentencias preparadas
    ];

    // Crear la conexión
    $pdo = new PDO($dsn, $username, $password, $options);


} catch (PDOException $e) {
    // Manejo de errores
    echo "Error en la conexión: " . $e->getMessage();
    exit; 
}
?>