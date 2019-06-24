<?php
session_start();
include_once('model/factura.php');
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$per = new Factura();

$template = new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_factura':
         echo $per->get_tabla();	
	break;
	case 'registrar_factura':
		$per->get_datos_factura($_POST);
		echo $per->get_tabla();
	break;
	case 'form_nuevo_factura':
         $per->form_nuevo_factura();
	break;
	case 'modificar_factura':
		$per->get_datos_modificar_factura($_POST);
		echo $per->get_tabla();
	break;
	case 'form_modificar_factura':
	    $per->get_by_id_factura($_GET['id_factura']);
		$per->form_modificar_factura();
	break;
	case 'eliminar_factura':
		 $per->get_datos_eliminar_r($_POST);
		echo $per->get_tabla();


	break;
	case 'form_eliminar_factura':
		$per->get_by_id_factura($_GET['id_factura']);
		$per->form_eliminar_factura();

	break;
	case 'exportar_pdf':
		$per->exportar_pdf();
	break;
	case 'exportar_excel':
		$per->exportar_excel();
	break;
	case 'exportar_word':
		$per->exportar_word();
	break;
	case 'buscar_per':

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