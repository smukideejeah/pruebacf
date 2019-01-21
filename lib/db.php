<?php
class db{
    public static function conexion($h,$u,$p,$d){
        $conexion=new mysqli($h, $u, $p, $d);
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>
