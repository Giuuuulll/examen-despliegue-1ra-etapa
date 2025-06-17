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

$id = intval($_GET['id']);

// Verifico que la publicación es del usuario
$stmt = $conn->prepare("SELECT usuario FROM publicaciones WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($usuario_pub);
$stmt->fetch();
$stmt->close();

if (!$usuario_pub) {
    die("Publicación no encontrada.");
}
if ($usuario_pub !== $_SESSION['usuario']) {
    die("No tenés permiso para eliminar esta publicación.");
}

// Elimino publicación
$stmt = $conn->prepare("DELETE FROM publicaciones WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: inicioed.php");
    exit;
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
