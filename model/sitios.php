<?php
require_once('DBAbstract.php');

class sitios extends DBAbstract
{

    private $id_sitio;
    private $sitio;
    private $codigoorden;

    public function __construct()
    {

        $this->id_sitio = 0;
        $this->sitio = '';
        $this->codigoorden = 0;
    }

    public function __destruct()
    { }

    public function get_id_sitio()
    {
        return $this->id_sitio;
    }
    public function set_id_sitio($id_sitio)
    {
        $this->id_sitio = $id_sitio;
    }

    public function get_sitio(){
        return $this->sitio;
    }
    public function set_sitio($sitio){
        $this->sitio=$sitio;
    }

    public function get_codigoorden(){
        return $this->codigoorden;
    }
    public function set_codigoorden($codigoorden){
        $this->codigoorden=$codigoorden;
    }

    public function get_by_id_sitio($id_sitio='')
    {
        if($id_sitio!=''):
            $this->query="SELECT idsitio,sitio,codigoorden
                            FROM SITIOS
                          WHERE idsitio='$id_sitio';";
            $this->get_results_from_query();
        endif;
		if(count($this->rows) == 1):
			foreach ($this->rows[0] as $propiedad=>$valor):
			$this->$propiedad = $valor;
			endforeach;
		endif;      
    }
    public function insert(){
        $this->query="INSERT INTO sitios(
                    sitio,codigoorden)
                    values('$this->sitio','$this->codigoorden');";
        $this->execute_single_query();

    }
    public function get_datos_sitio($_P){
        $this->sitio=$_P['sitio'];
        $this->codigoorden=$_P['codigoorden'];
        $this->insert();
    }
    public function form_nuevo_sitio(){

        $sql='SELECT idorden AS codigoorden,anoplanta 
                from orden;';
        $combo=$this->get_combo_box_all($sql,"anoplanta","codigoorden","codigoorden");

    $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_sitio' 
    action='handler_sitios.php?pag=registrar_sitio'
        method='POST'>
        <fieldset>   
        <legend>Registrar Sitio</legend>
    

    <div>
        <label for='for_sitios'>Sitio</label>
        <input type='text' class='form-control' id='sitios' name='sitio' required autofocus 
        placeholder='ingrese Sitio' /> 
    </div>

    <div>
    <label for='for_sitios'>Codigo Orden</label>
             $combo
    </div>
    <div>
    <br/>
    
    <input type='submit' class='btn btn-success' name='registrar_sitio' value='Registrar Sitio' />
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
        $sql="SELECT u.idsitio,u.sitio,
        r.anoplanta as codigoorden
        FROM sitios u
        INNER JOIN orden r
        ON(u.codigoorden=r.idorden)
        ORDER BY idsitio;";
     return $this->get_results_from_query2($sql);	

    }

    public function get_tabla(){
        $sql="SELECT u.idsitio,u.sitio,
        r.anoplanta as codigoorden
        FROM sitios u
        INNER JOIN orden r
        ON(u.codigoorden=r.idorden)
        ORDER BY idsitio;";

       $cab="
       <h1>Administrador de Sitios</h1>
    <a href='handler_sitios.php?pag=form_nuevo_sitio'
    class='btn btn-success'>
    <span class='glyphicon glyphicon-plus'
     aria-hidden='true'></span>Nuevo Sitio</a>
     <br/>
    <table class='table'>
           <tr><th>I.D Sitio</th>
           <th>SITIO</th>
           <th>CODIGOORDEN</th>
           
           <th></th>
           <th></th></tr>
    ";
        $cuerpo="";
        
    $result=$this->get_results_from_query2($sql);
    while ($filas = $result->fetch_assoc()){
        $id_sitio=$filas['idsitio'];
        $sitio=$filas['sitio'];
        $codigoorden=$filas['codigoorden'];
       

        $cuerpo=$cuerpo."<tr>
      
        <td>$id_sitio</td>
        <td>$sitio</td>
        <td>$codigoorden</td>

        <td><a class='btn btn-warning'
        href='handler_sitios.php?pag=form_modificar_sitio&idsitio=$id_sitio'>
        <span class='glyphicon glyphicon-pencil'
            aria-hidden='true'></span> 
        MODIFICAR</a></td>
        <td><a class='btn btn-danger'
        href='handler_sitios.php?pag=form_eliminar_sitio&idsitio=$id_sitio'>
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
   
        $this->query="update sitios set               
                sitio='$this->sitio',
                codigoorden='$this->codigoorden'
                where idsitio='$this->id_sitio';";
    
             $this->execute_single_query();
    }
    public function get_datos_modificar_sitio($_P){
    
    
        $this->id_sitio=$_P['idsitio'];
        $this->sitio=$_P['sitio'];
        $this->codigoorden=$_P['codigoorden'];
        $this->update();
    }
    public function form_modificar_sitio()
    {
        $sql='SELECT idorden AS codigoorden,anoplanta 
        from orden;';
         $combo=$this->get_combo_box_all($sql,"anoplanta","codigoorden","codigoorden");

        $form="
            <div class='row'>
            <div class='col-xs-4 col-md-2'>.</div>
            <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
            <form name='modificar_sitio' 
            action='handler_sitios.php?pag=modificar_sitio'
            method='POST'>
            <fieldset>   
            <legend>Modificar Sitio</legend>


    <div>
        <label for='for_sitios'>ID. SitioL</label>
        <input type='text' class='form-control' value='$this->idsitio' id='idsitio' readonly='readonly' name='idsitio'  required autofocus 
        placeholder='ingrese I.D SITIO' /> 
    </div>
        <div>
        <label for='for_sitios'>Sitio</label>
        <input type='text' class='form-control' id='sitios' name='sitio' required autofocus value='$this->sitio'
        placeholder='ingrese Sitio' /> 
        </div>

        <div>
        <label for='for_sitios'>Codigo Orden</label>
            $combo
        </div>
        <div>
        <br/>

        <input type='submit' class='btn btn-success' name='modificar_sitio' value='Modificar Sitio' />
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
        $this->query="DELETE from sitios 
                where idsitio='$this->id_sitio';
        ";
        $this->execute_single_query();
    }
    public function get_datos_eliminar_sitio($_P){

            $this->id_sitio=$_P['idsitio'];
            $this->delete();
    }
    public function form_eliminar_sitio(){
       
        $form = "
        
        <div class='row'>
    
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
            <form
                name='eliminar_sitio'
                action='handler_sitios.php?pag=eliminar_sitio'
                method='POST'>
                <fieldset>
                <legend>Eliminar Sitio</legend>
       
                <div>
                    <label for='for_sitios'>Sitio</label>
                    <input type='text' class='form-control' id='sitios' name='sitio' required autofocus value='$this->sitio'
                    placeholder='ingrese Sitio' /> 
                </div>
                <div>
                <br/>
                
                </div>
            <div>
                <input type='hidden' name='idsitio' id='idsitio' value='$this->idsitio'/>
                <input type='submit' name='eliminar_sitio' value='Eliminar Sitio' />
            </div>
            </fieldset>
        </form>
        </div>
        </div>
        <div class='col-xs-4 col-md-2'></div>
        </div>";
        
        echo $form;
    
    }



}//end classs sitios
