<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$host = 'localhost';
$db = 'examen_desplieguebd';
$user = 'root'; // Cambia esto
$pass = ''; // Cambia esto

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

$usuario = $_SESSION['usuario'];
$titulo = trim($_POST['titulo']);
$contenido = trim($_POST['contenido']);

if (!$titulo || !$contenido) {
    die("Faltan datos");
}

$stmt = $conn->prepare("INSERT INTO publicaciones (usuario, titulo, contenido) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $usuario, $titulo, $contenido);

if ($stmt->execute()) {
    header("Location: inicioed.php");
    exit;
} else {
    echo "Error al publicar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
