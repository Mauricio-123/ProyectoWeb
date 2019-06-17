<?php

    session_start();

    $_SESSION["clave"]=NULL;
    $_SESSION["nombre"]=NULL;

    session_destroy();
    header("status:301 Moved Permanently");
        header("Location: http://localhost/examen2/index.html");
        
        exit;
?>
