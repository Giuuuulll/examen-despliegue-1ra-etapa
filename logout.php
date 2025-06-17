<?php
session_start();
session_destroy();
header("Location: inicioed.php");
exit;
?>
