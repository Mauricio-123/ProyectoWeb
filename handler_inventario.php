<?php
session_start();
include_once('model/inventario.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$arb= new inventario();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_inventario':
         echo $arb->get_tabla();
	break;
	case 'registrar_inventario':
		$arb->get_datos_inventario($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_nuevo_inventario':
         $arb->form_nuevo_inventario();
	break;
	case 'modificar_inventario':
		$arb->get_datos_modificar_inventario($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_modificar_inventario':
	    $arb->get_by_id_inventario($_GET['idinventario']);
		$arb->form_modificar_inventario();
	break;
	case 'eliminar_inventario':
		$arb->get_datos_eliminar_inventario($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_eliminar_inventario':
		$arb->get_by_id_inventario($_GET['idinventario']);
		$arb->form_eliminar_inventario();

	break;
	case 'exportar_pdf':
		$arb->exportar_pdf();
	break;
	case 'exportar_excel':
		$arb->exportar_excel();
	break;
	case 'exportar_word':
		$arb->exportar_word();
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