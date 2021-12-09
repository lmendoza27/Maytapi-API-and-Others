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
        'message' => 'Hola, buen día'
    ]
]);

// Otra solicitud de prueba : https://jsonplaceholder.typicode.com/posts
// https://api.github.com/repos/guzzle/guzzle




echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
// Send an asynchronous request.
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});

$promise->wait();

?>