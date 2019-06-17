<?php
session_start();
include_once('model/arboles.php');    
include_once('model/Templete.php');

function handler() {
$pag= helper_pag_data();
$arb= new arboles();
$template= new Template();//activacion de los diseños de bostrap//
$template->head();
switch ($pag) {
	case 'listar_arbol':
         echo $arb->get_tabla();
	break;
	case 'registrar_arbol':
		$arb->get_datos_arbol($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_nuevo_arbol':
         $arb->form_nuevo_arbol();
	break;
	case 'modificar_arbol':
		$arb->get_datos_modificar_arbol($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_modificar_arbol':
	    $arb->get_by_id_arbol($_GET['idarbol']);
		$arb->form_modificar_arbol();
	break;
	case 'eliminar_arbol':
		$arb->get_datos_eliminar_arbol($_POST);
		echo $arb->get_tabla();
	break;
	case 'form_eliminar_arbol':
		$arb->get_by_id_arbol($_GET['idarbol']);
		$arb->form_eliminar_arbol();

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