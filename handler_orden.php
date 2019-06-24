<?php
session_start();
include_once('model/orden.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$ord= new orden();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_orden':
         echo $ord->get_tabla();
	break;
	case 'registrar_orden':
		$ord->get_datos_orden($_POST);
		echo $ord->get_tabla();
	break;
	case 'form_nuevo_orden':
         $ord->form_nuevo_orden();
	break;
	case 'modificar_orden':
		$ord->get_datos_modificar_orden($_POST);
		echo $ord->get_tabla();
	break;
	case 'form_modificar_orden':
	    $ord->get_by_id_orden($_GET['idorden']);
		$ord->form_modificar_orden();
	break;
	case 'eliminar_orden':
		$ord->get_datos_eliminar_orden($_POST);
		echo $ord->get_tabla();
	break;
	case 'form_eliminar_orden':
		$ord->get_by_id_orden($_GET['idorden']);
		$ord->form_eliminar_orden();

	break;
	case 'exportar_pdf':
		$ord->exportar_pdf();
	break;
	case 'exportar_excel':
		$ord->exportar_excel();
	break;
	case 'exportar_word':
		$ord->exportar_word();
	break;
	case 'buscar_arbegoria':

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