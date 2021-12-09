<?php
// Para esta segunda versión se pretende hacer lo mismo pero con la última columna y sin el agregado de coma para corroborar su eficiente funcionalidad a ver qué ocurre...

// Todo indica que el request7 está funcionando correctamente, lo que sigue ahora es realizar otra consulta en el request8 para que identifique con un loop si está
// funcionando o no a través de la consulta de los logs a través del msgId que se genera una vez se procesa el mensaje, tengo ideado hacer otro sleep para asegurar el correcto
// envío y procesamiento de la solicitud una vez se envíe a Maytapi...

$i = 1;
$newdata = [];
$handle = fopen("./csv/Ejemplar3.csv", "r");
$random_time = rand(30,60);
// Lo que se está pensando ahora es particionar los datos por cada cantidad de datos

// READ CSV

// Recordar dejar la comita
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {      

    // UPDATE 100TH ROW DATA (TO EXCLUDE, KEEP ONLY $i++ AND continue)
    if ($i >= 4) {
        if(empty($data[3])) {
            $newdata[$i][] = $data[0];          
            $newdata[$i][] = $data[1];          
            $newdata[$i][] = $data[2];  
            $newdata[$i][] = 'asdasd';
            }else {
        $newdata[$i][] = $data[0];          
        $newdata[$i][] = $data[1];          
        $newdata[$i][] = $data[2];  
        $newdata[$i][] = $data[3];  
            }
  /*      $i++;
        continue;
    }  
    $newdata[$i][] = $data[0];          
    $newdata[$i][] = $data[1];   
    $newdata[$i][] = $data[2];    
    $newdata[$i][] = $data[3];    
    $i++;    
*/
  
        require_once('./vendor/autoload.php');

        $client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';
$phone_id = 17323;
$response = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [
'form_params' => [
    'to_number' => $data[1].$data[2],
    'type' => 'text',
    'message' => 'Buen día!. Saludos '.$data[0]
]
]);

echo $response->getStatusCode(); 
echo $response->getHeaderLine('content-type'); 
echo $response->getBody();
echo "el tiempo estimado a esperar fue de:".$random_time;    
sleep($random_time);
$i++;
continue;
}  
$newdata[$i][] = $data[0];          
$newdata[$i][] = $data[1];   
$newdata[$i][] = $data[2];    
$newdata[$i][] = $data[3];    
$i++;  


    
}

// EXPORT CSV
$fp = fopen("./csv/Ejemplar3.csv", 'w');    
foreach ($newdata as $rows) {
    fputcsv($fp, $rows);
    //sleep($random_time);
}       
fclose($fp);



?>

