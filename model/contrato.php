<?php
require_once('DBAbstract.php');

class contrato  extends DBAbstract{

    private $id_contrato;   
    private $contrato;
    private $codigopredio;

    public function __construct()
    {
        $this->id_contrato=0;
        $this->contrato='';
        $this->codigopredio=0;
        
    }
    public function __destruct()
    {
        
    }

    public function get_id_contrato(){
        return $this->id_contrato;
    }
    public function set_id_contrato($id_contrato){
        $this->id_contrato=$id_contrato;
    }

    public function get_contrato(){
        return $this->contrato;
    }
    public function set_contrato($contrato){
        $this->contrato=$contrato;
    }

    public function get_codigopredio(){
        return $this->codigopredio;
    }
    public function set_codigopredio($codigopredio){
        $this->codigopredio=$codigopredio;
    }

    public function get_by_id_contrato($id_contrato=''){

        if($id_contrato!=''):
            $this->query="SELECT idcontrato,contrato,codigopredio
            FROM contratos
            WHERE idcontrato='$id_contrato';";
            $this->get_results_from_query();
        endif;
        if (count($this->rows)==1): 
            foreach($this->rows[0]as $propiedad=>$valor):
                $this->$propiedad=$valor;
            endforeach;
        endif;
    }
    public function insert(){
        $this->query="INSERT INTO contratos(
            contrato,codigopredio)
        Values('$this->contrato','$this->codigopredio');";
        $this->execute_single_query();
    }
    public function get_datos_contrato($_P){

        $this->contrato=$_P['contrato'];
        $this->codigopredio=$_P['codigopredio'];
        $this->insert();
    }
    public function form_nuevo_contrato(){

        $sql='SELECT idpredio as codigopredio,predio
            From predios;';
        $combo=$this->get_combo_box_all($sql,"predio","codigopredio","codigopredio");  

        $form="
        
        <div class='row'>
            <div class='col-xs-4 col-md-2'>.</div>
            <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
        <form name='registrar_contrato' 
            action='handler_contrato.php?pag=registrar_contrato'
            method='POST'>
            <fieldset>
            <legend>Registrar Contrato</legend>
        
        <div>
            <label for='contra'>Contrato</label>
            <input type='text' class='form-control' id='contrato' name='contrato'  required autofocus 
            placeholder='ingrese contrato' /> 
        </div>
    
        <div>
            <label for='contra'>Codido Contrato</label>
            $combo
        </div>   
    
        <div>
            <br/>
            <input type='submit' class='btn btn-success' name='registrar_contrato' value='Registrar Contrato' />
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
      $sql="  SELECT u.idcontrato, u.contrato,
        u.codigopredio	  
    FROM contratos u,predios r
    WHERE u.idcontrato=r.idpredio;";

    }

    public function get_tabla(){


        $sql="  SELECT u.idcontrato, u.contrato,
        u.codigopredio 
        FROM contratos u
        INNER JOIN predios r
        ON(u.codigopredio=r.idpredio)
        ORDER BY idcontrato;";

$cab="
<h1>Administrador de Contrato</h1>
<a href='handler_contrato.php?pag=form_nuevo_contrato'
class='btn btn-success'>
<span class='glyphicon glyphicon-plus'
 aria-hidden='true'></span> Nuevo Contrato</a>
 <br/>
<table class='table'>
       <tr><th>I.D Contrato</th>
       <th>Contrato</th>
       <th>Codigo Predio</th>
      
       
       <th></th>
       <th></th></tr>
";
    $cuerpo="";
    
    $result=$this->get_results_from_query2($sql);
    while ($filas = $result->fetch_assoc()){
        $id_contrato=$filas['idcontrato'];
        $contrato=$filas['contrato'];
        $codigopredio=$filas['codigopredio'];
        

        $cuerpo=$cuerpo."<tr>
  
<td>$id_contrato</td>
<td>$contrato</td>
<td>$codigopredio</td>
<td><a class='btn btn-warning'
href='handler_contrato.php?pag=form_modificar_contrato&idcontrato=$id_contrato'>
<span class='glyphicon glyphicon-pencil'
 aria-hidden='true'></span> 
MODIFICAR</a></td>
<td><a class='btn btn-danger'
href='handler_contrato.php?pag=form_eliminar_contrato&idcontrato=$id_contrato'>
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

        $this->query="update contratos
        set contrato='$this->contrato',
        codigopredio='$this->codigopredio'
        where idcontrato='$this->id_contrato';";

        $this->execute_single_query();
    }

    public function get_datos_modificar_contrato($_P){
        $this->id_contrato=$_P['idcontrato'];
        $this->contrato=$_P['contrato'];
        $this->codigopredio=$_P['codigopredio'];
        $this->update();
    }
    public function form_modificar_contrato(){

        $sql='SELECT idpredio as codigopredio,predio
            From predios;';
        $combo=$this->get_combo_box_all($sql,"predio","codigopredio","codigopredio");  

        $form="
        
        <div class='row'>
            <div class='col-xs-4 col-md-2'>.</div>
            <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
        <form name='registrar_contrato' 
            action='handler_contrato.php?pag=modificar_contrato'
            method='POST'>
            <fieldset>
            <legend>Modificar Contrato</legend>
        
        <div>
            <label for='contra'>Contrato</label>
            <input type='text' class='form-control' value='$this->idcontrato'id='idcontrato' name='idcontrato'  required autofocus readonly='readonly'
            placeholder='ingrese contrato' /> 
        </div>
        <div>
            <label for='contra'>Contrato</label>
            <input type='text' class='form-control' value='$this->contrato' id='contrato' name='contrato'  required autofocus 
            placeholder='ingrese contrato' /> 
        </div>
    
        <div>
            <label for='contra'>Codido Contrato</label>
            $combo
        </div>   
    
        <div>
            <br/>
            <input type='submit' class='btn btn-success' name='modificar_contrato' value='Modificar Contrato' />
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
        $this->query="DELETE from contratos where idcontrato='$this->id_contrato';";
        $this->execute_single_query();
    }
    public function get_datos_eliminar_contrato($_P){

        $this->id_contrato=$_P['idcontrato'];
        $this->delete();
    }
    public function form_eliminar_contrato(){
     
        
        $form="
        
        <div class='row'>
            <div class='col-xs-4 col-md-2'>.</div>
            <div class='col-xs-10 col-md-8'>
            <div class='form-group'>
        <form name='eliminar_contrato' 
            action='handler_contrato.php?pag=eliminar_contrato'
            method='POST'>
            <fieldset>
            <legend>Eliminar Contrato</legend>
        
            <div>
                <label for='contra'>Contrato</label>
                <input type='text' class='form-control' value='$this->contrato' id='contrato' name='contrato'  required autofocus 
                placeholder='ingrese contrato' /> 
             </div>
       
    
        <div>
            <input type='hidden' name='idcontrato' id='idcontrato' value='$this->idcontrato'/>
            <input type='submit' name='eliminar_contrato' value='Eliminar Contrato' />
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


}//end class contrato
