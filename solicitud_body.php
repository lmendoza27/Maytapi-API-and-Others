<?php

// Request con Método POST
// Utilizando Maytapi para enviar mensaje

require_once('./vendor/autoload.php');

$client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';
$phone_id = 17323;

$response = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [
    'form_params' => [
        'to_number' => '51962504669',
        'type' => 'text',
        'message' => 'Hola, buenas tardes'
    ]
]);


echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
// Send an asynchronous request.
echo "\n";
$data = json_decode($response->getBody());
//echo $data->success; // entrega 1
echo $data->data->msgId; // entrega el código del mensaje, parece que se encripta... ya que al cambiar el texto del mensaje se cambia.. si el mensaje es el mismo junto al número el 
// msgId no varía....
// Hasta esta parte todo está marchando bien, ahora haré un sleep de unos 25 segundos para que logre colocarse en el Maytapi y así ejecutar la nueva solicitud
sleep(25);


?>