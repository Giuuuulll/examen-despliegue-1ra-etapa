<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title>Publicar</title>
</head><link rel="stylesheet" href="formulario.css">
<body>
<h2>Crear publicación</h2>
<form action="guardar_publicacion.php" method="POST">
    <label>Título: <input type="text" name="titulo" required></label><br><br>
    <label>Contenido:<br>
        <textarea name="contenido" rows="5" cols="40" required></textarea>
    </label><br><br>
    <button type="submit">Publicar</button>
</form>

<button onclick="location.href='inicioed.php'">Volver</button>
</body>
</html>
