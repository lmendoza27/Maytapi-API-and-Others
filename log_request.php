<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/


require_once('./vendor/autoload.php');

$client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';

$response = $client->request('GET', 'https://api.maytapi.com/api/'.$product_id.'/logs');

//echo $response->getStatusCode(); 
//echo $response->getHeaderLine('content-type'); 
//echo $response->getBody();
//echo "\n";

$data = json_decode($response->getBody());
//echo $data->data->count; // La cantidad de registros de Maytapi en el teléfono
//echo $data->data->list[0]->id; // Obtiene el id del último registro que se dio en el Log del Maytapi  
//echo $data->data->list[0]->data->body->type; // Obtiene el estado del mensaje del último registro que se dio en el log del Maytapi

// Ahora lo que haré será una búsqueda a través de un "msgID" específico para que me dé el útimo registro en base al msgId establecido previamente
// El "ackCode": 1 con "ackType": delivered informa que el mensaje ha sido entregado.
// El "ackCode": 2 con "ackType": reached informa que el mensaje ha sido alcanzado.
// El "ackCode": 3 con "ackType": seen informa que el mensaje ha sido visto por el receptor.
// Por otra parte, cuando el número no existe y no es válido el "type" es "error".

//echo $data->data->list[0]->data->body->data->id; // Obtiene el msgId del último registro que se dio en el log del Maytapi
//$identificator = $data->data->list[19]->data->body->data->id;
//echo $identificator;

// Entonces haré la búsqueda de entre todos esos tramos del Json a partir del msgId para que busque el último y me confirme...

// 8c938f00-5445-11ec-b344-513c75b7ae34 // Este es de uno que está mal - con error
// 3c76a630-5448-11ec-b529-9bd0082426e4 // Este tiene mi número de teléfono

// Tal parece que al guardar el mensaje en error lo almacena en el body con "id", pero cuando lo realiza con 


$valor_buscado = "7db8c460-56ab-11ec-9c8e-5b1a8925a186";

// validar solo Mensajes con Error
//$valor_buscado = "f01f7f50-5447-11ec-bc08-89ed64237f41";

foreach ($data->data->list as $item) {
  if($item->data->body->data->id == $valor_buscado) {
    echo $item->data->body->type;
  }
}

// validar solo Mensajes correctamente enviados 

// Por lo visto aquí solo recoge si es que el valor está en estado de error...
// Y sí, solo "type": "error" de momento está logrando buscar de manera más que satisfactoria

//$valor_buscado = "3c76a630-5448-11ec-b529-9bd0082426e4";

error_reporting(0);  // Este comando desactiva cualquier notificación de error

foreach ($data->data->list as $item) {
  if($item->data->body->data[0]->msgId == $valor_buscado) {
    echo $item->data->body->type;
  }
}


///// RECORDAR QUE EL LOG DE MAYTAPI SOLO MUESTRA REGISTROS AL DÍA, POR LO QUE EL REGISTRO MARCADO COMO MSGID DEL DIA VIERNES YA NO SE MUESTRA MÁS


//$valor_buscado = "3c76a630-5448-11ec-b529-9bd0082426e4";

/*error_reporting(0);  // Este comando desactiva cualquier notificación de error


foreach ($data->data->list as $item) {
  if($item->data->body->data[0]->msgId == $valor_buscado) {
    echo $item->data->body->type;
  }elseif($item->data->body->data->id == $valor_buscado) {
    echo $item->data->body->type;
  }
}*/

// Debo buscar la manera de que la solicitud se procese correctamente al igual que Curl, en este caso con GuzzleHttp
// Tal parece que olvidé el /api/ :c y por eso no salía ...
/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.maytapi.com/api/7b0c5675-5c38-4701-8cb3-d3deef3a79f7/logs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-maytapi-key: 6415a291-2670-4d09-8e1a-c41460e04743'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/



?>