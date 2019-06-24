<?php

include_once('usuarios.php');
$nom=$_POST['txt_nombre'];
$clave=$_POST['txt_clave'];

echo $nom;

echo "  ";
echo $clave;

$user = new usuarios();
$res=$user->get_validar_usuario($nom,$clave);

if($res==true){

    $user->get_by_name_clave($nom,$clave);

    session_start();

    $_SESSION["id_usuario"]=$user->get_id_usuario();
    $_SESSION["nombre"]=$user->get_nombre();
    $_SESSION["tipo"]=$user->get_tipo();

    header("status:301 Moved Permanently");
    header("location:../handler_arboles.php?pag=listar_arbol");
    exit;
}
else{
    header("status:301 Moved Permanently");
    header("Location: http://localhost/examen2/index.html");
        exit;
}


?>