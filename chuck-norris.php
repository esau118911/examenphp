<?php
class ChuckNorris
{    private $URL_RANDOM="https://api.chucknorris.io/jokes/random"; 
    
     public function obtener($method){
      if($method=="GET"){ 
      $arrContextOptions=array(
         "ssl"=>array(
             "verify_peer"=>false,
             "verify_peer_name"=>false,
         ),
     );  
     $response = file_get_contents($this->URL_RANDOM, false, stream_context_create($arrContextOptions));
     echo $response; 
     }
     else { 
      header('HTTP/1.1 405 Method not allowed');
     } 
   
     }
}
?>