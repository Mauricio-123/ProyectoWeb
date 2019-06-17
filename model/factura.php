<?php
require_once('DBAbstract.php');
class factura extends DBAbstract
{

	private $id_factura;
	private $id_cliente;
	private $fecha;
  private $num_pago;
    
	public function __construct(){

		$this->id_factura=0;
        $this->id_cliente=0;
        $this->fecha=0;
        $this->num_pago=0;
	}

	public function __destruct(){}

	public function get_id_factura(){

		return $this->id_factura;
	}
	public function set_id_factura($id_factura){

		$this->id_factura=$id_factura;
	}

	public function get_id_cliente(){

		return $this->id_cliente;
	}
	public function set_id_cliente($id_cliente){

		$this->id_cliente=$id_cliente;
	}

	public function get_fecha(){
		return $this->fecha;
	}
	public function set_fecha($fecha){
		$this->fecha=$fecha;
	}
	public function get_num_pago(){

		return $this->num_pago;
	}
	public function set_num_pago($num_pago){

		$this->num_pago=$num_pago;
    }
   
    public function get_by_id_factura($id_factura='') {
		if($id_factura != ''):
			$this->query = "select num_factura,id_cliente,fecha,num_pago
		   from factura
			where num_factura='$id_factura';";
			$this->get_results_from_query();
		endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif;
	}

	public function insert(){
		$this->query="insert into factura
	   (id_cliente,fecha,num_pago)
	   values
	   ('$this->id_cliente','$this->fecha'
	    ,'$this->num_pago');";
	    $this->execute_single_query();
	}
	public function get_datos_factura($_P)
	{
		 $this->id_cliente=$_P['id_cliente'];
         $this->fecha=$_P['fecha']; 
         $this->num_pago=$_P['num_pago'];
         $this->insert();
	}
	public function form_nuevo_factura()
    {
		/*ESRIVE PARA COMBO*/	
		$sql ='SELECT id_cliente,nombre
							FROM Cliente;';
		$combo =$this->get_combo_box_all($sql,"nombre","id_cliente","id_cliente");

		$sql ='SELECT num_pago,nombre
							FROM Modo_pago;';
							$combo1 =$this->get_combo_box_all($sql,"nombre","num_pago","num_pago");


    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_factura' 
    action='handler_factura.php?pag=registrar_factura'
      method='POST'>
		<fieldset>
		
    <legend>Registrar Factura</legend>


<div>
<label for='nombres'>Nº Cliente</label>
		 $combo
</div>
s
<div>
	<label for='nombres'>Fecha</label>
	<input type='text' class='form-control' id='fecha' name='fecha' 
		required autofocus 
			placeholder='ingrese Fecha' /> 
	</div>
<div>
<label for='nombres'>Nº Pago</label>
		 $combo1
</div>
<div>
<br />

<input type='submit' class='btn btn-success' name='registrar_factura' value='Registrar Factura' />
</div>
</fieldset>
</form>
</div>

</div>
  <div class='col-xs-4 col-md-2'></div>
</div>
    	";
        echo $form;
    }


	public function update(){

        $this->query="update factura set
           
			id_cliente='$this->id_cliente',
			fecha='$this->fecha',
      num_pago='$this->num_pago'
            where num_factura='$this->id_factura';
		";
		//echo $this->query;
		$this->execute_single_query();
	}
	public function get_datos_modificar_factura($_P)
	{
	//	id_factura=$id_factura
         $this->id_factura=$_P['num_factura'];
         $this->id_cliente=$_P['id_cliente'];
         $this->fecha=$_P['fecha'];
         $this->num_pago=$_P['num_pago']; 
         $this->update();
	}
	public function form_modificar_factura()
    {
			$sql ='SELECT id_cliente,nombre
							FROM Cliente;';
							$combo =$this->get_combo_box_all($sql,"nombre","id_cliente","id_cliente");

		$sql ='SELECT num_pago,nombre
							FROM Modo_pago;';
							$combo1 =$this->get_combo_box_all($sql,"nombre","num_pago","num_pago");


     $form="
  <div class='row'>
  <div class='col-xs-4 col-md-2'>.</div>
  <div class='col-xs-10 col-md-8'>

<div class='form-group'>
<form name='registrar_factura' 
    action='handler_factura.php?pag=modificar_factura'
      method='POST'>
<fieldset>
<legend>Modificar FACTURA</legend>
<div>
<label for='nombres'>Id Factura</label>
<input type='text' class='form-control' value='$this->num_factura' id='num_factura' name='num_factura' 
   required autofocus 
     placeholder='ingrese ID Factura ' /> 
</div>
<div>
<label for='nombres'>ID. CLIENTE</label>
			$combo
</div>
<div>
<label for='nombres'>Fecha</label>
<input type='text' class='form-control' value='$this->fecha' id='fecha' name='fecha' required autofocus 
     placeholder='ingrese Fecha' /> 
</div>
<div>
<label for='nombres'>I.D PAGO</label>
			$combo1
</div>
<div>
<br />
<input type='submit' class='btn btn-success' name='modificar_factura' value='Modificar Factura' />
</div>
</fieldset>
</form>
</div>

</div>
  <div class='col-xs-4 col-md-2'></div>
</div>
    	";
        echo $form;
    }
 public function get_datos_eliminar_r($_P)
    {
    	$this->id_factura=$_P['id_factura'];
    	$this->delete();
    }
public function form_eliminar_factura(){
$form="
<div>
<form name='eliminar_factura' 
    action='handler_factura.php?pag=eliminar_factura'
      method='POST'>
<fieldset>
<legend>Eliminar Factura</legend>
<div>
<label for='nombres'>I.D CLIENTE</label>
<input type='text' id='id_cliente' name='id_cliente' 
   required autofocus value='$this->id_cliente'
     placeholder='ingrese I.D CLIENTE'
     disabled /> 
</div>


<div>
<input type='hidden' name='id_factura' id='id_factura' value='$this->num_factura' />
<input type='submit' name='Eliminar_factura' value='Eliminar Factura' />
</div>
</fieldset>
</form>
</div>
    	";
        echo $form;
    }

public function delete(){
    $this->query="delete from factura 
    where num_factura='$this->id_factura';
";
$this->execute_single_query();
	} 
public function get_valores(){
		$sql="SELECT u.num_factura
				   , u.id_cliente
				   , u.fecha
				   , u.num_pago
                
				  
			  FROM Factura u,cliente r
			  WHERE u.id_cliente=r.id_cliente
			   ORDER BY id_cliente;";
     return $this->get_results_from_query2($sql);		   
}


	public function get_tabla(){
		$sql="   SELECT u.num_factura
		,cl.nombre as id_cliente
		, u.fecha
		, u.num_pago
	FROM factura u
	INNER JOIN cliente cl
	ON(u.id_cliente = cl.id_cliente)
ORDER BY num_factura;";
$cab="
<h1>Administrador de Factura</h1>
<a href='handler_factura.php?pag=form_nuevo_factura'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo Factura</a>
 <br/>
<table class='table'>
	   <tr><th>I.D. Factura</th>
	   <th>I.D. Cliente</th>
	   <th>Fecha</th>
       <th>Num Pago</th>
       
	   <th></th>
	   <th></th></tr>
";
	$cuerpo="";
	
	$result=$this->get_results_from_query2($sql);
	while ($filas = $result->fetch_assoc()){
		$id_factura=$filas['num_factura'];
		$id_cliente=$filas['id_cliente'];
		$fecha=$filas['fecha'];
    $num_pago=$filas['num_pago'];
    $cuerpo=$cuerpo."<tr>
  
<td>$id_factura</td>
<td>$id_cliente</td>
<td>$fecha</td>
<td>$num_pago</td>
<td><a class='btn btn-warning'
href='handler_factura.php?pag=form_modificar_factura&id_factura=$id_factura'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_factura.php?pag=form_eliminar_factura&id_factura=$id_factura'>
<span class='glyphicon glyphicon-trash'
 aria-hidden='true'></span> 
ELIMINAR</a></td>
					</tr>";
		}

		$pie="</table>
		<script src='js/jquery-1.12.4.min.js'></script>
<script src='js/FileSaver.min.js'></script>
<script src='js/Blob.min.js'></script>
<script src='js/xls.core.min.js'></script>
<script src='js/tableexport.js'></script>


<script>
$('table').tableExport({
	formats: ['xlsx','txt', 'csv'], //Tipo de archivos a exportar ('xlsx','txt', 'csv', 'xls')
	position: 'button',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: false,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: 'ListadoPaises',    //Nombre del archivo 
});
</script>
		
		
		
		
		";

		echo $cab.$cuerpo.$pie;
	}
	/*	 
public function exportar_pdf(){

		$sql="SELECT u.ci
				   , u.nombres
				   , u.apellidos
				   , u.edad
				   , r.rol
			  FROM Usuarios u,roles r
			  WHERE u.id_rol=r.id_rol
			   ORDER BY nombres;";

header("Content-type: application/vnd.pdf");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.pdf");

		$cab="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Reporte de Usuarios</title>
</head>
<body>
		<table class='table'>
			   <tr><th>ID</th>
			   <th>NOMBRE</th>
			   <th>LOGIN</th>
			   <th>PASSWORD</th>
			   <th>ROL</th></tr>
		";

		$cuerpo="";
		$result=$this->get_results_from_query2($sql);
		while ($filas = $result->fetch_assoc()){

			$id=$filas['ci'];
			$nombres=$filas['nombres'];
			$apellidos=$filas['apellidos'];
			$edad=$filas['edad'];
			$id_rol=$filas['rol'];
		$cuerpo=$cuerpo."<tr>
							<td>$id</td>
							<td>$nombres</td>
							<td>$apellidos</td>
							<td>$edad</td>
							<td>$id_rol</td>
							</tr>";
		}

		$pie="</table>
</body>
</html>
		";
        $codigoHTML=$cab.$cuerpo.$pie;
		$codigoHTML=utf8_encode($codigoHTML);
		$dompdf=new DOMPDF();
		$dompdf->load_html($codigoHTML);
		ini_set("memory_limit","128M");
		$dompdf->render();
		$dompdf->stream("Reporte_Personal_usuarios.pdf");
	}
public function exportar_excel(){

		$sql="SELECT u.ci
				   , u.nombres
				   , u.apellidos
				   , u.edad
				   , r.rol
			  FROM Usuarios u,roles r
			  WHERE u.id_rol=r.id_rol
			   ORDER BY nombres;";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.xls");

		$cab="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Reporte de Usuarios</title>
</head>
<body>
		<table class='table'>
			   <tr><th>ID</th>
			   <th>NOMBRE</th>
			   <th>LOGIN</th>
			   <th>PASSWORD</th>
			   <th>ROL</th></tr>
		";

		$cuerpo="";
		$result=$this->get_results_from_query2($sql);
		while ($filas = $result->fetch_assoc()){

			$id=$filas['ci'];
			$nombres=$filas['nombres'];
			$apellidos=$filas['apellidos'];
			$edad=$filas['edad'];
			$id_rol=$filas['rol'];
		$cuerpo=$cuerpo."<tr>
							<td>$id</td>
							<td>$nombres</td>
							<td>$apellidos</td>
							<td>$edad</td>
							<td>$id_rol</td>
							</tr>";
		}

		$pie="</table>
</body>
</html>
		";
        echo $cab.$cuerpo.$pie;

	}
public function exportar_word(){

		$sql="SELECT u.ci
				   , u.nombres
				   , u.apellidos
				   , u.edad
				   , r.rol
			  FROM Usuarios u,roles r
			  WHERE u.id_rol=r.id_rol
			   ORDER BY nombres;";

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=Reporte_Personal_usuarios.doc");

		$cab="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Reporte de Usuarios</title>
</head>
<body>
		<table class='table'>
			   <tr><th>ID</th>
			   <th>NOMBRE</th>
			   <th>LOGIN</th>
			   <th>PASSWORD</th>
			   <th>ROL</th></tr>
		";

		$cuerpo="";
		$result=$this->get_results_from_query2($sql);
		while ($filas = $result->fetch_assoc()){

			$id=$filas['ci'];
			$nombres=$filas['nombres'];
			$apellidos=$filas['apellidos'];
			$edad=$filas['edad'];
			$id_rol=$filas['rol'];
		$cuerpo=$cuerpo."<tr>
							<td>$id</td>
							<td>$nombres</td>
							<td>$apellidos</td>
							<td>$edad</td>
							<td>$id_rol</td>
							</tr>";
		}

		$pie="</table>
</body>
</html>
		";
        echo $cab.$cuerpo.$pie;

	}*/

}

?>