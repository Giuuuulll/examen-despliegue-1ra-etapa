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

// Verifico que la publicación existe y que es del usuario
$stmt = $conn->prepare("SELECT titulo, contenido, usuario FROM publicaciones WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($titulo, $contenido, $usuario_pub);
$stmt->fetch();
$stmt->close();

if (!$titulo) {
    die("Publicación no encontrada.");
}

if ($usuario_pub !== $_SESSION['usuario']) {
    die("No tenés permiso para editar esta publicación.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Editar publicación</title>
</head>
<body>
<h2>Editar publicación</h2>
<form action="guardar_edicion.php" method="POST">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Título: <input type="text" name="titulo" value="<?= htmlspecialchars($titulo) ?>" required></label><br><br>
    <label>Contenido:<br>
        <textarea name="contenido" rows="5" cols="40" required><?= htmlspecialchars($contenido) ?></textarea>
    </label><br><br>
    <button type="submit">Guardar cambios</button>
</form>

<button onclick="location.href='inicioed.php'">Volver</button>
</body>
</html>
