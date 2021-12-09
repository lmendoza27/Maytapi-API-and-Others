<?php
$start_row = 5;
$time = 32;
$i = 1;

// Por lo visto de mi parte, en sí el csv proporcionado no está para agregar más filas, sino tan solo un agregado en la nueva columna de estado... por lo que utilizar
// el fopen con indicador de "a" no es el apropiado para este caso, la solución dada es tratar de que mediante el indicador "w" de fopen pueda modificar o sobrescribir tan solo
// los datos a partir de los que yo asigne

// https://www.py4u.net/discuss/44632

$newCsvData = array();
$handle = fopen("./csv/Ejemplar3.csv", "r");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        ////////////////////////////////
        if($i >= $start_row) {
            $data[] = 'Testeando';
            $newCsvData[] = $data;
            $num = count($data);
            echo "<p> $num campos en la fila $data: <br/></p>\n";
            //do your stuff
        }
        $i++;
        ////////////////////////////////
      /*  $num = count($data);
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
        }*/
    }
    fclose($handle);
    // w write
    // a add
    $handle = fopen("./csv/Ejemplar3.csv", 'w');
    foreach ($newCsvData as $line) {
       fputcsv($handle, $line);
    }
    fclose($handle);


?>