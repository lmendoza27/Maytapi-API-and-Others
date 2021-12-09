<?php

// Request con Método POST
// Utilizando Maytapi para enviar mensaje

/* Formato 3 columnas con sus correspondientes valores:
 */

$row = 1;
if (($handle = fopen("./csv/Ejemplar.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num campos en la fila $row: <br /></p>\n";
        $row++;

        for ($c=2; $c < 3; $c++) {
            require_once('./vendor/autoload.php');

            $client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';
$phone_id = 17323;
$response = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [
    'form_params' => [
        'to_number' => '51'.$data[$c],
        'type' => 'text',
        'message' => 'Buen día!. Saludos '.$data[0]
    ]
]);

echo $response->getStatusCode(); 
echo $response->getHeaderLine('content-type'); 
echo $response->getBody();


        }
    }
    fclose($handle);
}


?>