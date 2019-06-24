<?php

    session_start();

    $_SESSION["id_usuario"]=NULL;
    $_SESSION["nombre"]=NULL;

    session_destroy();
    header("status:301 Moved Permanently");
        header("Location: http://localhost/examen2/index.html");
        
        exit;
?>
