<?php

require_once('DBAbstract.php');

class inventario extends DBAbstract
{

    private $id_inventario;
    private $realizo;
   

    public function __contruct()
    {

        $this->id_inventario = 0;
        $this->realizo = '';

    }

    public function __destruct()
    { }

    //Obtencion de datos

    public function get_id_inventario()
    {
        return $this->id_inventario;
    }
    public function set_id_inventario($id_inventario)
    {
        $this->id_inventario->$id_inventario;
    }

    public function get_realizo()
    {
        return $this->realizado;
    }
    public function set_realizo($realizo)
    {
        $this->realizo = $realizo;
    }

    public function get_by_id_inventario($id_inventario=''){
        if($id_inventario!=''):
            $this->query="SELECT idinventario,realizo  
            FROM inventario 
            where idinventario='$id_inventario';";
            $this->get_results_from_query();
        endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif; 
    }
    public function insert(){
        $this->query="INSERT INTO inventario(realizo)
        VALUES('$this->realizo');";

$this->execute_single_query();
    }

public function get_datos_inventario($_P){
       
        $this->realizo=$_P['realizo'];

        $this->insert();

    }

public function form_nuevo_inventario(){

        $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='registrar_inventario' 
        action='handler_inventario.php?pag=registrar_inventario'
        method='POST'>
		<fieldset>
		<legend>Registrar Inventario</legend>
    
    <div>
        <label for='predi'>Realizo</label>
        <input type='text' class='form-control' id='realizo' name='realizo'  required autofocus 
        placeholder='ingrese Realizo' /> 
    </div>
    <div>
        <br/>
        <input type='submit' class='btn btn-success' name='registrar_inventario' value='Registrar inventario' />
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
public function get_valores(){
    $sql="SELECT u.realizo
    FROM inventario u;";

 return $this->get_results_from_query2($sql);		   
}
public function get_tabla(){

    $sql="SELECT u.idinventario ,u.realizo
    FROM inventario u;";
    $cab="
    <h1>Administrador de Inventario</h1>
    <a href='handler_inventario.php?pag=form_nuevo_inventario'
    class='btn btn-success'>
    <span class='glyphicon glyphicon-plus'
     aria-hidden='true'></span> Nuevo Inventario</a>
     <br/>
    <table class='table'>
           <tr><th>I.D Inventario</th>
           <th>Realizo</th>
           
           <th></th>
           <th></th></tr>
    ";
        $cuerpo="";
        
        $result=$this->get_results_from_query2($sql);
        while ($filas = $result->fetch_assoc()){
            $id_inventario=$filas['idinventario'];
            $realizo=$filas['realizo'];
            $cuerpo=$cuerpo."<tr>
      
    <td>$id_inventario</td>
    <td>$realizo</td>

    <td><a class='btn btn-warning'
    href='handler_inventario.php?pag=form_modificar_inventario&idinventario=$id_inventario'>
    <span class='glyphicon glyphicon-pencil'
     aria-hidden='true'></span> 
    MODIFICAR</a></td>
    <td><a class='btn btn-danger'
    href='handler_inventario.php?pag=form_eliminar_inventario&idinventario=$id_inventario'>
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
        fileName: 'ListaArboles',    //Nombre del archivo 
    });
    </script>";
    
            echo $cab.$cuerpo.$pie;
}
public function update(){
   
    $this->query="update inventario set               
            realizo='$this->realizo'
            where idinventario='$this->id_inventario';";

            $this->execute_single_query();
}
public function get_datos_modificar_inventario($_P){


        $this->id_inventario=$_P['idinventario'];
        $this->realizo=$_P['realizo'];
    $this->update();
}
public function form_modificar_inventario()
{
   
  
    $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='modificar_inventario' 
        action='handler_inventario.php?pag=modificar_inventario'
        method='POST'>
		<fieldset>
		<legend>Modificar Inventario</legend>
    <div>
        <label for='inv'>Realizo</label>
        <input type='text' class='form-control' value='$this->idinventario' id='idinventario' name='idinventario'  required autofocus readonly='readonly' 
        placeholder='' /> 
    </div>
    <div>
        <label for='inv'>Realizo</label>
        <input type='text' class='form-control' value='$this->realizo' id='realizo' name='realizo'  required autofocus 
        placeholder='ingrese Realizo' /> 
    </div>
    <div>
        <br/>
        <input type='submit' class='btn btn-success' name='modificar_inventario' value='Modificar inventario' />
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
    public function get_datos_eliminar_inventario($_P){

        $this->id_inventario=$_P['idinventario'];
        $this->delete();
    }
    
    public function form_eliminar_inventario(){
       
          
    $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='eliminar_inventario' 
        action='handler_inventario.php?pag=eliminar_inventario'
        method='POST'>
		<fieldset>
		<legend>Eliminar Inventario</legend>

    <div>
        <label for='inv'>Realizo</label>
        <input type='text' class='form-control' value='$this->realizo' id='realizo' name='realizo'  required autofocus 
        placeholder='ingrese Realizo' /> 
    </div>    
    <div>
    <br/>
    
    </div>

    <div>
    <input type='hidden' name='idinventario' id='idinvetario' value='$this->idinventario'/>
    <input type='submit' name='eliminar_inventario' value='Eliminar Inventario' />
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
    public function delete(){
    
        $this->query="delete  from inventario
            where idinventario='$this->id_inventario';  
        ";
        $this->execute_single_query();
    }
    
}//end class arbole 
