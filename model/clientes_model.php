<?php
class clientes_model{
    private $db;
 
    public function __construct(){
        $this->db=db::conexion("pruebacyberfuel.ml","pruebacf","Am.12345678","cf");
        $this->personas=array();
    }
    public function clientes(){
        $personas=array();
        $consulta=$this->db->query("select id,nombre,apellido from cliente;");
        while($filas=$consulta->fetch_assoc()){
            $personas[]=$filas;
        }
        return $personas;
    }
    public function nombres($id){
        
        $consulta = $this->db->query("select concat(c.nombre,' ',c.apellido) n from cliente c where id = $id;");
        return $consulta->fetch_assoc();
    }
    public function tels($id){
        $personas = array();
        $consulta = $this->db->query("select dc.num num from cliente c inner join num_cliente dc on dc.idc = c.id where id = $id");
        while($filas=$consulta->fetch_assoc()){
            $personas[]=$filas;
        }
        return $personas;
    }
    public function dirs($id){
        $personas = array();
        $consulta = $this->db->query("select dc.dir dir from cliente c inner join dir_cliente dc on dc.idc = c.id where id = $id;");
         while($filas=$consulta->fetch_assoc()){
            $personas[]=$filas;
        }
        return $personas;
        
    }
    public function inombre($nom,$ape){
        $this->db->query("insert into cliente (nombre, apellido) values ('".$nom."','".$ape."');");
        //return $this->db->error;
    }
    public function adddir($id, $dir){
        $this->db->query("insert into dir_cliente (idc, dir) values (".$id.",'".$dir."');");
    }
    public function addtel($id, $tel){
        $this->db->query("insert into num_cliente (idc, num) values (".$id.",'".$tel."');");
    }
}
?>
