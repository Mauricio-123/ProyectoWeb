<?php

require_once('DBAbstract.php');

class orden extends DBAbstract
{

    private $id_orden;
    private $anoplanta;
    private $superficie;
    private $bloque;
    private $codigocontrato;

    public function __construct()
    {
        $this->id_orden = 0;
        $this->anoplanta = 0;
        $this->superficie = 0;
        $this->bloque = 0;
        $this->codigocontrato = 0;
    }

    public function __destruct()
    { }

    public function get_id_orden()
    {

        return $this->id_orden;
    }

    public function set_id_orden($id_orden)
    {
        $this->id_orden = $id_orden;
    }

    public function get_anoplanta()
    {
        return $this->anoplanta;
    }
    public function set_anoplanta($anoplanta)
    {
        $this->anoplanta = $anoplanta;
    }

    public function get_superficie()
    {
        return $this->superficie;
    }
    public function set_superficie($superficie)
    {
        $this->superficie = $superficie;
    }

    public function get_bloque()
    {
        return $this->bloque;
    }
    public function set_bloque($bloque)
    {
        $this->bloque = $bloque;
    }

    public function get_codigocontrato()
    {
        return $this->codigocontrato;
    }

    public function set_codigocontrato($codigocontrato)
    {
        $this->codigocontrato = $codigocontrato;
    }

    public function get_by_id_orden($id_orden='')
    {
        if($id_orden!=''):
            $this->query="SELECT idorden,anoplanta,
                                superficie,bloque,codigocontrato
                          FROM orden
                          where idorden='$id_orden';";
               $this->get_results_from_query();
        endif;
        if(count($this->rows)==1):
            foreach($this->rows[0] as
            $propiedad=>$valor):
            $this->$propiedad=$valor;
        endforeach;
        endif;
        
    }

    public function insert(){
        $this->query="INSERT INTO orden(anoplanta,superficie
                        ,bloque,codigocontrato)
                    VALUES('$this->anoplanta','$this->superficie','$this->bloque','$this->codigocontrato');";
        $this->execute_single_query();
    }

    public function get_datos_orden($_P){
        $this->anoplanta=$_P['anoplanta'];
        $this->superficie=$_P['superficie'];
        $this->bloque=$_P['bloque'];
        $this->codigocontrato=$_P['codigocontrato'];
        $this->insert();
    }
    public function form_nuevo_orden(){

        $sql='SELECT idcontrato as codigocontrato,contrato
              FROM contratos;';
        $combo=$this->get_combo_box_all($sql,"contrato","codigocontrato","codigocontrato");


        $form="
    <div class='row'>
    <div class='col-xs-4 col-md-2'>.</div>
    <div class='col-xs-10 col-md-8'>
    <div class='form-group'>
    <form name='registrar_orden' 
    action='handler_orden.php?pag=registrar_orden'
        method='POST'>
        <fieldset>   
        <legend>Registrar Orden</legend>
    

    <div>
        <label for='for_orden'>Anoplanta</label>
        <input type='text' class='form-control' id='anoplanta' name='anoplanta' required autofocus 
        placeholder='ingrese anoplanta' /> 
    </div>
    <div>
        <label for='for_orden'>Superficie</label>
        <input type='text' class='form-control' id='superficie' name='superficie' required autofocus 
        placeholder='ingrese Superficie' /> 
    </div>
    <div>
        <label for='for_orden'>Bloque</label>
        <input type='text' class='form-control' id='bloque' name='bloque' required autofocus 
        placeholder='ingrese Bloque' /> 
    </div>
    <div>
    <label for='for_orden'>Codigo Contrato</label>
             $combo
    </div>
    <div>
    <br/>
    
    <input type='submit' class='btn btn-success' name='registrar_orden' value='Registrar Orden' />
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
        $sql="SELECT o.idorden,o.anoplanta,
        o.superficie,o.bloque,o.codigocontrato
        FROM orden o,contratos c
        where o.idorden=c.idcontrato;";
     return $this->get_results_from_query2($sql);	

    }

    public function get_tabla(){
        $sql="SELECT o.idorden,
        o.anoplanta,
            o.superficie,
        o.bloque,
        c.idcontrato AS codigocontrato
            FROM orden o
            INNER JOIN contratos c
            ON(o.codigocontrato=c.idcontrato)
            ORDER BY idorden;";

       $cab="
       <h1>Administrador de Orden</h1>
    <a href='handler_orden.php?pag=form_nuevo_orden'
    class='btn btn-success'>
    <span class='glyphicon glyphicon-plus'
     aria-hidden='true'></span>Nuevo Orden</a>
     <br/>
    <table class='table'>
           <tr><th>I.D Orden</th>
           <th>Anoplanta</th>
           <th>Superficie</th>
           <th>Bloque</th>
           <th>Codigo Contrato</th>
           
           <th></th>
           <th></th></tr>
    ";
        $cuerpo="";
        
    $result=$this->get_results_from_query2($sql);
    while ($filas = $result->fetch_assoc()){
        $id_orden=$filas['idorden'];
        $anoplanta=$filas['anoplanta'];
        $superficie=$filas['superficie'];
        $bloque=$filas['bloque'];
        $codigocontrato=$filas['codigocontrato'];
     

        $cuerpo=$cuerpo."<tr>
      
        <td>$id_orden</td>
        <td>$anoplanta</td>
        <td>$superficie</td>
        <td>$bloque</td>
        <td>$codigocontrato</td>

        <td><a class='btn btn-warning'
        href='handler_orden.php?pag=form_modificar_orden&idorden=$id_orden'>
        <span class='glyphicon glyphicon-pencil'
            aria-hidden='true'></span> 
        MODIFICAR</a></td>
        <td><a class='btn btn-danger'
        href='handler_orden.php?pag=form_eliminar_orden&idorden=$id_orden'>
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

        $this->query="UPDATE orden set
                anoplanta='$this->anoplanta',
                superficie='$this->superficie',
                bloque='$this->bloque',
                codigocontrato='$this->codigocontrato'
                where idorden='$this->id_orden';";
        $this->execute_single_query();
    }
    public function get_datos_modificar_orden($_P){
        $this->id_orden=$_P['idorden'];
        $this->anoplanta=$_P['anoplanta'];
        $this->superficie=$_P['superficie'];
        $this->bloque=$_P['bloque'];
        $this->codigocontrato=$_P['codigocontrato'];
        $this->update();
    }
    public function form_modificar_orden(){

        $sql='SELECT idcontrato as codigocontrato,contrato
        FROM contratos;';
        $combo=$this->get_combo_box_all($sql,"contrato","codigocontrato","codigocontrato");

        $form="
          <div class='row'>
          <div class='col-xs-4 col-md-2'>.</div>
          <div class='col-xs-10 col-md-8'>
          <div class='form-group'>
          <form name='modificar_orden' 
          action='handler_orden.php?pag=modificar_orden'
              method='POST'>
              <fieldset>   
              <legend>Modificar Orden</legend>
        <div>
            <label for='for_sitios'>ID. Orden</label>
            <input type='text' class='form-control' value='$this->idorden' id='idorden' readonly='readonly' name='idorden'  required autofocus 
            placeholder='ingrese I.D SITIO' /> 
        </div>
      
          <div>
              <label for='for_orden'>Anoplanta</label>
              <input type='text' class='form-control' value='$this->anoplanta'id='anoplanta' name='anoplanta' required autofocus 
              placeholder='ingrese anoplanta' /> 
          </div>
          <div>
              <label for='for_orden'>Superficie</label>
              <input type='text' class='form-control'
              value='$this->superficie' id='superficie' name='superficie' required autofocus 
              placeholder='ingrese Superficie' /> 
          </div>
          <div>
              <label for='for_orden'>Bloque</label>
              <input type='text' class='form-control' 
              value='$this->bloque'id='bloque' name='bloque' required autofocus 
              placeholder='ingrese Bloque' /> 
          </div>
          <div>
          <label for='for_orden'>Codigo Contrato</label>
                   $combo
          </div>
          <div>
          <br />
            <input type='submit' class='btn btn-success'
            name='modificar_orden'
            value='Modificar arbol'
          />
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
    public function get_datos_eliminar_orden($_P){
        $this->id_orden=$_P['idorden'];
        $this->delete();
    }
    public function delete(){
        $this->query="delete from orden
            where idorden='$this->id_orden';";
        $this->execute_single_query();
    }
    public function form_eliminar_orden(){

        $form="
        <div class='row'>
        <div class='col-xs-4 col-md-2'>.</div>
        <div class='col-xs-10 col-md-8'>
        <div class='form-group'>
        <form name='eliminar_orden' 
        action='handler_orden.php?pag=eliminar_orden'
            method='POST'>
            <fieldset>   
            <legend>Eliminar Orden</legend>

        <div>
            <label for='for_orden'>Anoplanta</label>
            <input type='text' class='form-control' value='$this->anoplanta'id='anoplanta' name='anoplanta' required autofocus 
            placeholder='ingrese anoplanta' /> 
        </div>
        <div>
        <br />
            <input type='hidden' name='idorden' id='idorden' value='$this->idorden'/>
            <input type='submit' name='eliminar_orden' value='Eliminar Arbol' />
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




}//end class orden
