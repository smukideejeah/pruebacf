<?php
//Llamada al modelo
class clientes{
    function inicio(){
        require_once("view/inicio_view.phtml");
        
    }
    function error(){
        echo "Error 404 NO Encontrado";
    }
    function muestra(){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        $cl = $cliente->clientes();
        $dat = new stdClass();
        $dat->data = $cl;
        echo json_encode($dat);
        
    }
    function nombre(){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        $nom = $_POST['nom'];
        $ape = $_POST['ape'];
        echo $cliente->inombre($nom,$ape);
        echo "Listo";
    }
    function ver($id){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        
        $data = new stdClass();
        $data->nom = $cliente->nombres($id);
        $data->di = $cliente->dirs($id);
        $data->te = $cliente->tels($id);
        
        echo json_encode($data);
    }
    function itel(){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        $id = $_POST['id'];
        $tel = $_POST['tel'];
        $cliente->addtel($id,$tel);
        
    }
    function idir(){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        $id = $_POST['id'];
        $dir = $_POST['dir'];
        $cliente->adddir($id,$dir);
    }
    
    function crear(){
        require_once("model/clientes_model.php");
        $cliente = new clientes_model();
        $xml = new DomDocument('1.0', 'UTF-8');
        
        $clientes = $xml->createElement('Clientes');
        $clientes = $xml->appendChild($clientes);
        
        $arrc = $cliente->clientes();
        foreach($arrc as $data){
            $cli = $xml->createElement('Cliente');
            $clientes->appendChild($cli);
            $id = $xml->createElement('id',$data['id']);
            $cli->appendChild($id);
            $nombre = $xml->createElement('Nombre',$data['nombre']);
            $cli->appendChild($nombre);
            $apellido = $xml->createElement('Apellido',$data['apellido']);
            $cli->appendChild($apellido);
            $dir = $xml->createElement('Direcciones');
            $cli->appendChild($dir);
            
            $dire = $cliente->dirs($data['id']);
            
            foreach($dire as $datad){
                $direc = $xml->createElement('dirección',$datad['dir']);
                $dir->appendChild($direc);
            }
            
            $tels = $xml->createElement('Teléfonos');
            $cli->appendChild($tels);
            $tel = $cliente->tels($data['id']);
            
            foreach($tel as $datat){
                $te = $xml->createElement('Teléfono',$datat['num']);
                $tels->appendChild($te);
            }
        }
     
        $xml->formatOutput = true;
        $el_xml = $xml->saveXML();
        $xml->save("public/file.xml");
    

    }
}
?>
