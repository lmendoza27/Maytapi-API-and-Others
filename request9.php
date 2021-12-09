<?php

// Para esta novena versión se va a utilizar este mismo proceso del request9.php agregándole la log_request.php 
// Recordaré darle un sleep de 25 segundos una vez haga la segunda consulta se procese 

/*
The basic difference between require and require_once is require_once will check whether the file is already included or not if it is already included
then it won't include the file whereas the require function will include the file irrespective of whether file is already included or not.
*/

$i = 1;
$newdata = [];
$handle = fopen("./csv/Ejemplar3.csv", "r");
$random_time = rand(5,30);
// Lo que se está pensando ahora es particionar los datos por cada cantidad de datos

// READ CSV

// Recordar dejar la comita
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {      

    // UPDATE 100TH ROW DATA (TO EXCLUDE, KEEP ONLY $i++ AND continue)
    if ($i >= 9) {


        require_once('./vendor/autoload.php');

        $client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';
$phone_id = 17323;
$response = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [
'form_params' => [
    'to_number' => $data[1].$data[2],
    'type' => 'text',
    'message' => 'Buenos días!. Saludos '.$data[0]
]
]);

echo $response->getStatusCode(); 
echo $response->getHeaderLine('content-type'); 
echo $response->getBody();
//echo "el tiempo estimado a esperar fue de: ".$random_time;

sleep(25);

$response2 = $client->request('GET', 'https://api.maytapi.com/api/'.$product_id.'/logs');
$data2 = json_decode($response2->getBody(),true);

$valor_buscado = json_decode($response->getBody());
$msgId = $valor_buscado->data->msgId;
$found = false;

foreach ($data2['data']['list'] as $d) {
    // En caso el msgId sea error
    if($d['data']['body']['data']['id'] == $msgId) {
        $found= 'Error';
        break;
    // En caso el msgId sea correcto
    }elseif($d['data']['body']['data'][0]['msgId'] == $msgId) {
        $found= 'Correcto';
        break;
    // En caso el msgId no esté registrado en el Log
    }else{
        $found='No';
    }
}

if(empty($data[3])) {
    $newdata[$i][] = $data[0];
    $newdata[$i][] = $data[1];          
    $newdata[$i][] = $data[2]; 
    $newdata[$i][] = $found;

}else{
    $newdata[$i][] = $data[0];
    $newdata[$i][] = $data[1];          
    $newdata[$i][] = $data[2]; 
    $newdata[$i][] = $data[3];
}

// Al parecer si la 4 columna de estado está vacío rompe la ejecución...
// Quiero decir que si la data está llena sí continúa

// Todo me indica a que el foreach está causando este problema... y lo comprobaré ahora

//if(empty($data[3])) {
    //echo "Hecho";
   // Aquí pondré la lógica en caso esté vacío
   /*foreach ($data2->data->list as $item) {
    if($item->data->body->data->id == $msgId) {
        $newdata[$i][] = $data[0];
        $newdata[$i][] = $data[1];          
        $newdata[$i][] = $data[2]; 
        $newdata[$i][] = 'Número inválido';
    }
  }*/

  /*$newdata[$i][] = $data[0];
  $newdata[$i][] = $data[1];          
  $newdata[$i][] = $data[2]; 
  $newdata[$i][] = 'Enviado';

error_reporting(0);*/

/*foreach ($data2->data->list as $item) {
    if($item->data->body->data[0]->msgId == $msgId) {
      //echo $item->data->body->type;
      $newdata[$i][] = $data[0];
      $newdata[$i][] = $data[1];          
      $newdata[$i][] = $data[2]; 
      $newdata[$i][] = 'Enviado';
    }
  }   */
    /*$newdata[$i][] = $data[0];          
    $newdata[$i][] = $data[1];          
    $newdata[$i][] = $data[2];  
    $newdata[$i][] = 'texto vacio';*/
   /* }else {
$newdata[$i][] = $data[0];          
$newdata[$i][] = $data[1];          
$newdata[$i][] = $data[2];  
$newdata[$i][] = $data[3];  
    }*/


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