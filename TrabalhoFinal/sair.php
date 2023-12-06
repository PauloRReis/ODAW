<?php
    session_destroy();
    session_start();
    $_SESSION["login"] = false;
    header("location: pagina_inicial.php");
    exit;
?>