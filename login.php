<?php
session_start();

$host = 'localhost';
$db = 'examen_desplieguebd';
$user = 'root';      // Cambia esto
$pass = '';     // Cambia esto

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (!$email || !$password) {
    die("Faltan datos");
}

$stmt = $conn->prepare("SELECT nombre, contraseña FROM iniciodesecion WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("Email o contraseña incorrectos");
}

$stmt->bind_result($nombre, $hash);
$stmt->fetch();

if (password_verify($password, $hash)) {
    $_SESSION['usuario'] = $nombre;
    header("Location: inicioed.php");
    exit;
} else {
    die("Email o contraseña incorrectos");
}

$stmt->close();
$conn->close();
?>
