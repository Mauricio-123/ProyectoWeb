<?php

require_once('DBAbstract.php');

class predio extends DBAbstract
{

    private $id_predio;
    private $predio;
    private $zona;
    private $codigoinventario;

    public function __contruct()
    {

        $this->id_predio = 0;
        $this->predio = '';
        $this->zona = '';
        $this->codigoinventario = 0;

    }

    public function __destruct()
    { }

    //Obtencion de datos

    public function get_id_predio()
    {
        return $this->id_predio;
    }
    public function set_id_predio($id_predio)
    {
        $this->id_predio->$id_predio;
    }

    public function get_predio()
    {
        return $this->predio;
    }
    public function set_predio($predio)
    {
        $this->predio = $predio;
    }

    public function get_zona()
    {
        return $this->zona;
    }
    public function set_zona($zona)
    {
        $this->zona = $zona;
    }

    public function get_codigoinventario()
    {
        return $this->codigoinventario;
    }
    public function set_codigoinventario($codigoinventario)
    {
        $this->codigoinventario = $codigoinventario;
    }


    public function get_by_id_predio($id_predio=''){
        if($id_predio!=''):
            $this->query="SELECT idpredio,predio,zona,codigoinventario
                    FROM predios 
                    where idpredio='$id_predio';";
            $this->get_results_from_query();
        endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif; 
    }
    public function insert(){
        $this->query="INSERT INTO predios(predio,zona,codigoinventario)
        VALUES('$this->predio','$this->zona','$this->codigoinventario');";

$this->execute_single_query();
    }

    public function get_datos_predio($_P){
       
        $this->predio=$_P['predio'];
        $this->zona=$_P['zona'];
        $this->codigoinventario=$_P['codigoinventario'];
        $this->insert();

    }

public function form_nuevo_predio(){

        $sql ='SELECT idinventario AS codigoinventario,realizo 	
                    FROM inventario;';
        $combo =$this->get_combo_box_all($sql,"realizo","codigoinventario","codigoinventario"); 


        $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='registrar_predio' 
        action='handler_predio.php?pag=registrar_predio'
        method='POST'>
		<fieldset>
		<legend>Registrar Predio</legend>
    
    <div>
        <label for='predi'>Predio</label>
        <input type='text' class='form-control' id='predio' name='predio'  required autofocus 
        placeholder='ingrese Predio' /> 
    </div>

    <div>
        <label for='predi'>Zona</label>
        <input type='text' class='form-control' id='zona' name='zona'  required autofocus 
        placeholder='ingrese Zona' /> 
    </div>   

    <div>

    <div>
        <label for='predi'>Codigo Inventario</label>
        $combo
    </div>

    <div>
        <br/>
        <input type='submit' class='btn btn-success' name='registrar_predio' value='Registrar Predio' />
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
    $sql="SELECT u.idpredio, u.predio,
        u.zona,
        u.codigoinventario
    FROM predios u,inventario r
    WHERE u.idpredio=r.idinventario;";

 return $this->get_results_from_query2($sql);		   
}
public function get_tabla(){

    $sql="SELECT u.idpredio, u.predio,u.zona,
    u.codigoinventario	  
    FROM predios u
    INNER JOIN inventario s
    ON(u.codigoinventario=s.idinventario)
    ORDER BY idpredio;";

    $cab="
    <h1>Administrador de Predio</h1>
    <a href='handler_predio.php?pag=form_nuevo_predio'
    class='btn btn-success'>
    <span class='glyphicon glyphicon-plus'
     aria-hidden='true'></span> Nuevo Predio</a>
     <br/>
    <table class='table'>
           <tr><th>I.D Predio</th>
           <th>Predio</th>
           <th>Zona</th>
           <th>Codigo Inventario</th>
           
           <th></th>
           <th></th></tr>
    ";
        $cuerpo="";
        
        $result=$this->get_results_from_query2($sql);
        while ($filas = $result->fetch_assoc()){
            $id_predio=$filas['idpredio'];
            $predio=$filas['predio'];
            $zona=$filas['zona'];
            $codigoinventario=$filas['codigoinventario'];
            $cuerpo=$cuerpo."<tr>
      
    <td>$id_predio</td>
    <td>$predio</td>
    <td>$zona</td>
    <td>$codigoinventario</td>

    <td><a class='btn btn-warning'
    href='handler_predio.php?pag=form_modificar_predio&idpredio=$id_predio'>
    <span class='glyphicon glyphicon-pencil'
     aria-hidden='true'></span> 
    MODIFICAR</a></td>
    <td><a class='btn btn-danger'
    href='handler_predio.php?pag=form_eliminar_predio&idpredio=$id_predio'>
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
   
    $this->query="update predios set               
            predio='$this->predio',
            zona='$this->zona',
            codigoinventario ='$this->codigoinventario'

            where idpredio='$this->id_predio';";

            $this->execute_single_query();
}
public function get_datos_modificar_predio($_P){


        $this->id_predio=$_P['idpredio'];
        $this->predio=$_P['predio'];
        $this->zona=$_P['zona'];
        $this->codigoinventario=$_P['codigoinventario'];
    $this->update();
}
public function form_modificar_predio()
{
    $sql ='SELECT idinventario AS codigoinventario,realizo 	
    FROM inventario;';
    $combo =$this->get_combo_box_all($sql,"realizo","codigoinventario","codigoinventario"); 
  
    $form="
        
    <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
    <form name='modificar_predio' 
        action='handler_predio.php?pag=modificar_predio'
        method='POST'>
		<fieldset>
        <legend>Modificar Predio</legend>
    <div>
        <label for='predi'>I.D PREDIO</label>
        <input type='text' class='form-control' readonly='readonly'
         value ='$this->idpredio' id='predio' name='idpredio'  required autofocus 
        placeholder='ingrese Predio' /> 
    </div>
    <div>
        <label for='predi'>Predio</label>
        <input type='text' class='form-control' value='$this->predio' id='predio' name='predio'  required autofocus 
        placeholder='ingrese Predio' /> 
    </div>
    


    <div>
        <label for='predi'>Zona</label>
        <input type='text' class='form-control' value='$this->zona' id='zona' name='zona'  required autofocus 
        placeholder='ingrese Zona' /> 
    </div>   

    <div>

    <div>
        <label for='predi'>Codigo Inventario</label>
        $combo
    </div>

    <div>
        <br/>
        <input type='submit' class='btn btn-success' name='modificar_predio' value='Modificar Predio' />
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
    public function get_datos_eliminar_predio($_P){

        $this->id_predio=$_P['idpredio'];
        $this->delete();
    }
    
    public function form_eliminar_predio(){
       
        $form = "
        
        <div class='row'>
    
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
            <form
                name='eliminar_predio'
                action='handler_predio.php?pag=eliminar_predio'
                method='POST'>
                <fieldset>
                <legend>Eliminar Predio</legend>
       
            <div>
                <label for='predi'>Zona</label>
                <input type='text' class='form-control' value='$this->zona' id='zona' name='zona'  required autofocus 
                placeholder='ingrese Zona' /> 
            </div>   
        
            <div>
        <div><br/></div>
        <div>
            <input type='hidden' name='idpredio' id='idpredio' value='$this->idpredio'/>
            <input type='submit' name='eliminar_arbol' value='Eliminar Predio' />
        </div>
            </fieldset>
        </form>
        </div>
        </div>
        <div class='col-xs-4 col-md-2'></div>
        </div>";
        
        echo $form;
    
    }
    public function delete(){
    
        $this->query="delete  from predios
            where idpredio='$this->id_predio';  
        ";
        $this->execute_single_query();
    }
    
}//end class arbole 
