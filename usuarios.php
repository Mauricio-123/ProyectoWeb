<?php

require_once('DBAbstract.php');

class usuarios extends DBAbstract 
{

    private $clave;
    private $nombre;
    private $apellidop;
    private $apellidom;
    private $tipo;
    private $id_usuario;

    public function __construct()
    {
        $this->clave=0;
        $this->nombre='';
        $this->apellidop='';
        $this->apellidom='';
        
    }
    public function __destruct()
    {
        
    }
    public function get_id_usuario(){

		return $this->id_usuario;
	}
	public function set_id_usuario($id_usuario){

		$this->id_usuario=$id_usuario;
	}
    public function get_clave(){
        return $this->clave;
    }
    public function set_clave($clave){
        $this->clave=$clave;
    }

    public function get_nombre(){
        return $this->nombre;
    }

    public function set_nombre($nombre){
        $this->nombre=$nombre;
    }

    public function get_apellidop(){
        return $this->apellidop;
    }

    public function set_apellidop($apellidop){
            $this->apellidop=$apellidop;
    }
    
    public function get_tipo(){
        return $this->tipo;
    }
    public function set_tipo($tipo){
       $this->tipo=$tipo;   
    }

    public function get_validar_usuario($nom,$clave){
		$sql="SELECT nombre,clave
                            FROM usuarios
                            WHERE nombre='$nom' AND clave='$clave'";
	$res=false;
	$result=$this->get_results_from_query2($sql);
	while ($filas = $result->fetch_assoc()){

        $res=true;
        }
        return $res;
    }
    public function get_by_name_clave($nombre='',$clave='') {
        if($nombre != ''):
            
            $this->query = "select * from usuarios
            where nombre ='$nombre' and clave ='$clave'";
            $this->get_results_from_query();
        endif;
	if(count($this->rows) == 1):
		foreach ($this->rows[0] as $propiedad=>$valor):
		$this->$propiedad = $valor;
		endforeach;
	endif;
    }
    
}



?>