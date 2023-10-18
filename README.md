# examen
Presentacion de Examen Resuelve tu Deduda  Esau Hernandez Narvaez


## CALCULOS DE INTERESES COMPUESTOS 

SERVICIO API REST 

[REQUISITOS]

Esta clase es soportada por versiones de PHP 5.6, 7, 8 o superiores

SE PUEDE DESPLEGAR BAJO CUALQUIER SERVIDOR WEB COMO (APACHE, NGINX ...)

SE REQUIERE LA SIGUIENTE CONFIGURACION PARA LA FUNCIONALIDAD EN LAS RUTAS

mod_rewrite Activado en el servidor

Creacion del Fichero .htaccess en la raiz del proyecto y pega las siguientes lineas

RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([a-zA-Z0-9-/]+)$ index.php

URL API REST
http://localhost/calcular-intereses

[METODO HTTP CON CURL]
curl -X POST -H 'Content-Type: application/json' -d '{"principal":1000,"tasa_anual":0.05,"periodos":3}' http://localhost/calcular-intereses

RESULTADO

{"monto_total":1157.63,"detalles_solicitud":{"principal":1000,"tasa_anual":0.05,"periodos":3}}

## Prueba de ingeniería intermedia

URL API
http://localhost/chuck-norris
TOKEN : 7c985b51b09d1b3f3816c12dc7b3a791

[METODO HTTP CON CURL]
curl -X GET -H 'Authorization: 7c985b51b09d1b3f3816c12dc7b3a791'  http://localhost/chuck-norris


## ## Prueba de ingeniería AVANZADA
URL
http://localhost/home

INTERFAZ WEB CON HTML5 Y JAVASCRIPT DISEÑO SENCILLO EN bootstrap SE CONSUMEN LOS SERVICIOS REST




