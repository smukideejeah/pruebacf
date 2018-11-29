<?php
    class principal{
        private $url = array();
        function inicio(){
            $uri = $_SERVER['REQUEST_URI'];
            /*$tri = trim($uri);
            $this->url = explode("/",$tri);
            $this->selecturl();*/
            
            $url = rtrim($uri, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $url);
            $this->selecturl();
        }
        
        function selecturl(){
            require_once('controller/clientes.php');
            $controla = new clientes();
            $opc = count($this->url);
            switch($opc){
                case 1:
                    $controla->inicio();
                    break;
                case 2:
                    if(method_exists($controla,$this->url[1])){
                        $metodo = $this->url[1];
                        $controla->{$metodo}();
                    }else{
                        $controla->error();
                    }
                    
                    break;
                case 3:
                     if(method_exists($controla,$this->url[1])){
                        $metodo = $this->url[1];
                        $controla->{$metodo}($this->url[2]);
                    }else{
                        $controla->error();
                    }
                    break;
                default:
                    $controla->error();
            }
        }
    }
?>