<?php
session_start();

$host = 'localhost';
$db = 'examen_desplieguebd';
$user = 'root';      // Cambia esto por tu usuario MySQL
$pass = '';     // Cambia esto por tu contraseña MySQL

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);
$pais = trim($_POST['pais']);
$password = trim($_POST['password']);

if (!$nombre || !$email || !$telefono || !$pais || !$password) {
    die("Faltan datos");
}

// Verifico si el email ya existe
$stmt = $conn->prepare("SELECT id FROM iniciodesecion WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    die("El email ya está registrado.");
}
$stmt->close();

// Hasheo la contraseña
$passHash = password_hash($password, PASSWORD_DEFAULT);

// Inserto usuario
$stmt = $conn->prepare("INSERT INTO iniciodesecion (nombre, email, telefono, pais, contraseña) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $email, $telefono, $pais, $passHash);

if ($stmt->execute()) {
    $_SESSION['usuario'] = $nombre;
    header("Location: inicioed.php");
    exit;
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
