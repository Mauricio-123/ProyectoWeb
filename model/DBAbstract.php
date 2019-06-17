<?php
abstract class DBAbstract {

	
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    protected $db_name = 'EXAMEN2parc';
      
	protected $query;
	protected $rows = array();
	private $conn;
# métodos abstractos para ABM de clases que hereden
# los siguientes métodos pueden definirse con exactitud
# y no son abstractos
# Conectar a la base de datos
private function open_connection() {
$this->conn = new mysqli(self::$db_host, self::$db_user,
self::$db_pass, $this->db_name);
}
# Desconectar la base de datos
private function close_connection() {
$this->conn->close();
}
# Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
protected function execute_single_query() {
$this->open_connection();
$this->conn->query($this->query);
$this->close_connection();
}
# Traer resultados de una consulta en un Array
protected function get_results_from_query() {
$this->open_connection();
$result = $this->conn->query($this->query);
//echo $this->query; 
while ($this->rows[] = $result->fetch_assoc());
$result->close();
$this->close_connection();
array_pop($this->rows);
}
protected function get_results_from_query2($sql) {
$this->open_connection();
//echo $sql;
$result = $this->conn->query($sql);
return $result;
}

public function get_combo_box($sql,$display_value,$id_value,$name,$id) {
$this->open_connection();
//echo $sql;
$result = $this->conn->query($sql);
$inicio="<select class='form-control' name=".$name." required >";
$cuerpo2="";
//echo $cabecera;
while ($filas = $result->fetch_assoc())
{
   $cuerpo="<option value ='".$filas[$id_value]."' ";
   if($filas[$id_value]==$id)
   { 
   $cuerpo=$cuerpo.'selected';
   }
   $cuerpo2=$cuerpo2.$cuerpo.">".$filas[$display_value]."</option>";
 //echo $cuerpo;   
}
$fin="</select>";
//echo $fin_tabla; 
$result->close();
$this->close_connection();
return $inicio.$cuerpo2.$fin;
}

public function get_combo_box_all($sql,$display_value,$id_value,$name,$metodo='') {
$this->open_connection();
$result = $this->conn->query($sql);
$inicio="<select class='form-control' name=".$name." required onchange='".$metodo."(this.value)' >";
$cuerpo2="";
//echo $cabecera;
while ($filas = $result->fetch_assoc())
{
   $cuerpo="<option value ='".$filas[$id_value]."' ";
   $cuerpo2=$cuerpo2.$cuerpo.">".$filas[$display_value]."</option>";
 //echo $cuerpo;   
}
$fin="</select>";
//echo $fin_tabla; 
$result->close();
$this->close_connection();
return $inicio.$cuerpo2.$fin;
}
//autocompetar
public function get_datalist($sql) {
$this->open_connection();

$result = $this->conn->query($sql);
$inicio="<datalist id='datalist'>";
$cuerpo2="";
//echo $cabecera;
while ($filas = $result->fetch_assoc())
{
   $cuerpo="<option value ='".$filas["nombre"]."'>";
   $cuerpo2=$cuerpo2.$cuerpo;  
}
$fin="</datalist>";
//echo $fin_tabla; 
$result->close();
$this->close_connection();
echo $inicio.$cuerpo2.$fin;
return $inicio.$cuerpo2.$fin;
}


public function get_max_value($sql) {
$this->open_connection();
$result = $this->conn->query($sql);
while ($filas = $result->fetch_assoc())
{
   $valor=$filas["maximo"];
}
$result->close();
$this->close_connection();
return $valor;
}
public function get_value($sql) {
$this->open_connection();
$result = $this->conn->query($sql);
//echo $sql;
while ($filas = $result->fetch_assoc())
{
   $valor=$filas["valor"];
}
$result->close();
$this->close_connection();
return $valor;
}

public function get_multiples($sql)
{
$this->open_connection();
$result = $this->conn->query($sql);

$nombre="";
while ($filas = $result->fetch_assoc())
{
   $nombre=$nombre.$filas["nom"];
}
$result->close();
$this->close_connection();
return $nombre;    
   
}

}
