<?php
session_start();
class Token
{    private $cantidad_solicitudes = 50; // CANTIDAD DE PETICIONES POR HORA
     private  $token = "7c985b51b09d1b3f3816c12dc7b3a791"; // TOKEN DE AUTORIZACION
     private $segundos = 3600; // TIEMPO DE REINCIO 1 HORA
   
     public function inicializarToken(){
      //SE INICIALIZA VARIABLES DE SESION  Y TOKEN AUTORIZACION Y REINICIO DE CANTIDAD DE SOLICITUDES 
      if(!isset($_SESSION['Authorization']))
       { $_SESSION['Authorization'] =  $this->token;
         $_SESSION['cantidad_solicitudes'] =  1;
         $_SESSION['LAST_ACTIVITY']=time();
       }
     }
     //VALIDA TOKEN CON EL ENCABEZADO CON EL TOKEN DEL SERVIDOR
     public function validarToken(){
   
      $difx = time() - $_SESSION['LAST_ACTIVITY']; //DIFERENCIA ENTRE HORA ACTUAL Y HORA INICIAL
       //VALIDAMOS ENCABEZADOS EXISTENTES
       $headers = getallheaders();
         if (!array_key_exists('Authorization', $headers)) {
            header("HTTP/1.0 401 Unauthorized"); 
            exit;
         }
         else{
            $this->token = trim($headers['Authorization']);
            if(isset($_SESSION['Authorization'])){       
               if($_SESSION['Authorization'] == $this->token){
                     // SE VALIDA LA CANTIDAD DE SOLICITUDES Y EL TIEMPO EN REINICIAR LA CONDICION DE NUMEROS DE SOLICITUDES
                     if($_SESSION['cantidad_solicitudes'] <= $this->cantidad_solicitudes && $difx <= $this->segundos) 
                     {
                        $_SESSION['cantidad_solicitudes'] = $_SESSION['cantidad_solicitudes']+1;
                        return json_encode(array('accessToken' => $this->token));
                     }
                     else 
                     {  if($difx>=$this->segundos){
                        session_unset();
                        session_destroy();
                        }
                        header("HTTP/1.0 429 (Demasiadas solicitudes)"); 
                     }         
                }
               else {
                  echo  json_encode(array("error" =>"Token incorrecto"));
               }
            }
            else {
               header("HTTP/1.0 429 (Demasiadas solicitudes)"); 
             }
         }
     }
       //METODO OBTINE UN TOKEN  NUEVO ALEATORIO E INICIALIZA CANTIDAD DE SOLICITUDES
       public function obtenerToken(){
         $token = array("accessToken"=>md5(uniqid(rand(), true)));
         $_SESSION['Authorization'] =  $token;
         $_SESSION['cantidad_solicitudes'] =  1;
         echo  json_encode(array("accessToken" => $_SESSION['Authorization']));
       }
}