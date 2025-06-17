<!-- ... los botones van arriba -->

<section class="seccion-publicaciones">
    <h2>Publicaciones</h2>

    <?php
    $conn = new mysqli("localhost", "tu_usuario", "tu_password", "examen_desplieguebd");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT id, usuario, titulo, contenido FROM publicaciones ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='publicacion'>";
            echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>";
            echo "<p class='autor'>Publicado por: " . htmlspecialchars($row['usuario']) . "</p>";

            if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === $row['usuario']) {
                echo "<a class='btn-accion' href='editar.php?id=" . $row['id'] . "'>Editar</a>";
                echo "<a class='btn-accion' href='eliminar.php?id=" . $row['id'] . "' onclick=\"return confirm('¿Seguro que querés eliminar esto?')\">Eliminar</a>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>No hay publicaciones aún 🥲</p>";
    }

    $conn->close();
    ?>
</section>
