<?php

include 'calculos.php';
include 'chuck-norris.php';
include 'token.php';
class Controller
{   private $calculo;
    public function __construct() {
      $calculo = new Calculos(); 
      $chuck_norris = new ChuckNorris();
      $token = new Token();
      $token->inicializarToken(); 
      $method = $_SERVER['REQUEST_METHOD']; // OBTIENE EL TIPO DE METODO
      $url = $_SERVER['REQUEST_URI'];   // TOMAMOS LA URL Y LO COLOCAMOS EN UN ARRAY 
      $request_uri = explode ("/", $_SERVER['REQUEST_URI']);  
     
      //CONTROLADOR DE RUTAS
      if (isset( $request_uri[1])) {
        $tag = ucfirst( $request_uri[1]); //Tomamos la posicion uno para controlar la URL
        switch($tag){
            case 'Home':  include 'home.php'; break;
            case 'Calcular-intereses':
                  //VALIDAMOS EL TOKEN DE Authorization DE  LA SOLICITUD
                  $json =json_decode($token->validarToken());
                  if(isset($json->accessToken)) $calculo->calcular_intereses_compuestos($method); break; 
            case 'Chuck-norris':
                $json =json_decode($token->validarToken());
                if(isset($json->accessToken)) $chuck_norris->obtener($method); break; 
               
            default:
            header("HTTP/1.0 404 Not Found"); 
            break;
          }
      }
      else{
        header("HTTP/1.0 404 Not Found");
      }
     }
}

$controller = new Controller();

?>