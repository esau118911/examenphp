<?php
class Calculos
{   //Declaracion de variables
    private $principal=0;
    private $tasa_anual=0.0;
    private $periodos=0;
    private $monto_total=0.0;
     
     //METODO PARA CALCULAR LOS INTERESES COMPUESTO M = P(1 + r/n)^(nt)
     public function calcular_intereses_compuestos($method){
      if($method=="POST"){ 
        //Recibo parametros en json para procesar 
        $valores = file_get_contents("php://input"); 
        if ( trim( $valores) == ""){   //validamos si existen valores 
            echo json_encode(array('error'=> 'No existen valores para procesar'));
            die;
          }
        if(!json_decode($valores)){ //Validamos el formato correcto
            echo json_encode(array('error'=> 'El JSON no tiene el formato correcto'));
            die;
          }
        else{
          $data = json_decode($valores); //decodifico valores
          $this->principal =  $data->principal;
          $this->tasa_anual = $data->tasa_anual;
          $this->periodos = $data->periodos;
        }
        $array = []; 
        //APLICAMOS CALCULO DE INTERESES
        try {
          $this->monto_total = $this->principal*(pow(1+($this->tasa_anual),$this->periodos));
        } catch (Exception $e) {
          echo json_encode(array('error'=> 'Los Datos no se procesaron'));
        }
       //CONSTRUIMOS EL JSON DE RESPUESTA
        $array = array('monto_total' => round($this->monto_total,2),
                       'detalles_solicitud' => array('principal' => $this->principal,
                       'tasa_anual'=>$this->tasa_anual, 'periodos'=>$this->periodos)
                      );
        echo json_encode($array);
        }
        else { 
          header('HTTP/1.1 405 Method not allowed');} 
     }
    
}
?>