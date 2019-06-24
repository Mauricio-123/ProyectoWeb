<?php
session_start();
include_once('model/sitios.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$sit= new sitios    ();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_sitio':
         echo $sit->get_tabla();
	break;
	case 'registrar_sitio':
		$sit->get_datos_sitio($_POST);
		echo $sit->get_tabla();
	break;
	case 'form_nuevo_sitio':
         $sit->form_nuevo_sitio();
	break;
	case 'modificar_sitio':
		$sit->get_datos_modificar_sitio($_POST);
		echo $sit->get_tabla();
	break;
	case 'form_modificar_sitio':
	    $sit->get_by_id_sitio($_GET['idsitio']);
		$sit->form_modificar_sitio();
	break;
	case 'eliminar_sitio':
		$sit->get_datos_eliminar_sitio($_POST);
		echo $sit->get_tabla();
	break;
	case 'form_eliminar_sitio':
		$sit->get_by_id_sitio($_GET['idsitio']);
		$sit->form_eliminar_sitio();

	break;
	case 'exportar_pdf':
		$sit->exportar_pdf();
	break;
	case 'exportar_excel':
		$sit->exportar_excel();
	break;
	case 'exportar_word':
		$sit->exportar_word();
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