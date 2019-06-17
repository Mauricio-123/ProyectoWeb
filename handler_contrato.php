<?php
session_start();
include_once('model/contrato.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$cont= new contrato();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_contrato':
         echo $cont->get_tabla();
	break;
	case 'registrar_contrato':
		$cont->get_datos_contrato($_POST);
		echo $cont->get_tabla();
	break;
	case 'form_nuevo_contrato':
         $cont->form_nuevo_contrato();
	break;
	case 'modificar_contrato':
		$cont->get_datos_modificar_contrato($_POST);
		echo $cont->get_tabla();
	break;
	case 'form_modificar_contrato':
	    $cont->get_by_id_contrato($_GET['idcontrato']);
		$cont->form_modificar_contrato();
	break;
	case 'eliminar_contrato ':
		$cont->get_datos_eliminar_contrato($_POST);
		echo $cont->get_tabla();
	break;
	case 'form_eliminar_contrato':
		$cont->get_by_id_contrato($_GET['idcontrato']);
		$cont->form_eliminar_contrato();

	break;
	case 'exportar_pdf':
		$cont->exportar_pdf();
	break;
	case 'exportar_excel':
		$cont->exportar_excel();
	break;
	case 'exportar_word':
		$cont->exportar_word();
	break;
	case 'buscar_contegoria':

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