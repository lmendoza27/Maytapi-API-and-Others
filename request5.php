<?php

// @TODO: Nueva columna para verificar si el estado de mensaje fue enviado o si fallo
// @TODO: Establecer nuevos puntos de inicio

// Esta variable establece la fila con el que comenzará la ejecución
$row = 2;

//$time = rand(30,60);
$time = 30;

$newColumnData = array();
if (($handle = fopen("./csv/Ejemplar3.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        ////////////////////////////////

        ////////////////////////////////
        $num = count($data);
        echo "<p> $num campos en la fila $row: <br /></p>\n";
        $data[] = 'Estado';
        $newColumnData[] = $data;
        $row++;



        for ($c=2; $c < 3; $c++) {
            require_once('./vendor/autoload.php');

            $client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';
$phone_id = 17323;
$response = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [
    'form_params' => [
        'to_number' => $data[1].$data[$c],
        'type' => 'text',
        'message' => 'Buen día!. Saludos '.$data[0]
    ]
]);

echo $response->getStatusCode(); 
echo $response->getHeaderLine('content-type'); 
echo $response->getBody();

// sleep(10) son diez segundos
//sleep(20);


// Por lo visto sleep duerme desde abajo todo los comando que siguen en PHP...
//sleep($time);


// Queda aclarar al 100% cada cuánto tiempo Maytapi permite hacer el envío de mensajes a los usuarios sin que los considere como spammers y demás mensajes masivos

        }
    }
    fclose($handle);
}

$handle = fopen("./csv/Ejemplar3.csv", "w");

foreach ($newColumnData as $line) {
   fputcsv($handle, $line);
   sleep($time);
}

fclose($handle);


?>