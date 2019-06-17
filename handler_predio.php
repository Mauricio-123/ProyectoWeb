<?php
session_start();
include_once('model/predios.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$predi= new predio();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_predio':
         echo $predi->get_tabla();
	break;
	case 'registrar_predio':
		$predi->get_datos_predio($_POST);
		echo $predi->get_tabla();
	break;
	case 'form_nuevo_predio':
         $predi->form_nuevo_predio();
	break;
	case 'modificar_predio':
		$predi->get_datos_modificar_predio($_POST);
		echo $predi->get_tabla();
	break;
	case 'form_modificar_predio':
	    $predi->get_by_id_predio($_GET['idpredio']);
		$predi->form_modificar_predio();
	break;
	case 'eliminar_predio':
		$predi->get_datos_eliminar_predio($_POST);
		echo $predi->get_tabla();
	break;
	case 'form_eliminar_predio':
		$predi->get_by_id_predio($_GET['idpredio']);
		$predi->form_eliminar_predio();

	break;
	case 'exportar_pdf':
		$predi->exportar_pdf();
	break;
	case 'exportar_excel':
		$predi->exportar_excel();
	break;
	case 'exportar_word':
		$predi->exportar_word();
	break;
	case 'buscar_prediegoria':

		break;
}

//$template->foot();

}
function helper_pag_data() {
$pag_data=$_GET['pag'];
return $pag_data;
}

handler();

?>