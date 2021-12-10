<?php

// Include the vendor/autoload file and check if it is included (Is key for to use Guzzle instead of curl)
require_once('./vendor/autoload.php');

// Row established as starting point in the CSV Test: "Ejemplar3.csv"
$row = 1;

// Array that stores all records in CSV file (at the moment in empty state)
$csv_log = [];

// Variable for to open a file - for that case in a CSV file
$csv_file = fopen("./csv/Ejemplar3.csv", "r");

// Variable to set rand time of 5 to 30 for time to send a message
$random_time = rand(5,30);

// apppe
// While for execute nested statements from the fields of the CSV file set
while (($data = fgetcsv($csv_file, 1000, ",")) !== FALSE) {      

// Condition to set in which Row of CSV file to start

// De qué punto a qué punto

// if ($row >= 10 && $row<=11)
//  if ($row >= 10)
    if ($row >= 10) {

// The first request that consist in Send Message whit POST method 
$client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

// Variable to store the product_id of Maytapi
$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';

// Variable to store the phone_id of Maytapi
$phone_id = 17323;

// Response as body request with POST method and the key params (number, type and message as content)
$send_message = $client->request('POST', 'https://api.maytapi.com/api/'.$product_id.'/'.$phone_id.'/sendMessage', [

// Body that stores params whit while-variable seting the corresponding fields to fill
// $data[] represents the position column of CSV file 
'form_params' => [
    'to_number' => $data[1].$data[2],
    'type' => 'media',
    "message" => "https://i.imgur.com/JIdidiS.png",
    "text"=> "¡Hola! $data[0].... Te invitamos a renovar el DNI de tu mascota en PEID, somos un servicio profesional de identificación de mascotas.\n\n Contamos con dos kit \n\n 1. kit básico: \n👉 DNI físico de tu mascota \n👉 Certificado físico \n👉 Llavero de tu mascota  \n👉Promociones con veterinarias \n\n💁 El costo es de s/.20.00 \n\n2. Kit premium: \n👉 DNI físico de tu mascota \n👉 Certificado físico \n👉 Llavero de tu mascota \n👉Promociones con veterinaria \n👉Taza personalizada con la foto de tu mascota. \n\n💁El costo es de s/35.00"
    ]
]);

// Responses for to show the responses to execute POST request for Send a Message
echo $send_message->getStatusCode(); 
echo $send_message->getHeaderLine('content-type'); 
echo $send_message->getBody();

// Sleep for 25 seconds the code execution up to this point (Their reason is to wait no longer than this time for the request message submission log to be submitted to the Maytapi logs)
sleep(25);

// Response whit GET method for to show the first pagination of Maytapi Log
$get_maytapi_log = $client->request('GET', 'https://api.maytapi.com/api/'.$product_id.'/logs');
$decode_maytapi_log = json_decode($get_maytapi_log->getBody(),true);

$get_msgId = json_decode($send_message->getBody());
$msgId = $get_msgId->data->msgId;
$found = false;

foreach ($decode_maytapi_log['data']['list'] as $d) {
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
    $csv_log[$row][] = $data[0];
    $csv_log[$row][] = $data[1];          
    $csv_log[$row][] = $data[2]; 
    $csv_log[$row][] = $found;

}else{
    $csv_log[$row][] = $data[0];
    $csv_log[$row][] = $data[1];          
    $csv_log[$row][] = $data[2]; 
    $csv_log[$row][] = $data[3];
}


sleep($random_time);
$row++;
continue;
}  
$csv_log[$row][] = $data[0];          
$csv_log[$row][] = $data[1];   
$csv_log[$row][] = $data[2];    
$csv_log[$row][] = $data[3];    
$row++;  

}

// EXPORT CSV
$fp = fopen("./csv/Ejemplar3.csv", 'w');    
foreach ($csv_log as $rows) {
    fputcsv($fp, $rows);
    //sleep($random_time);
}       
fclose($fp);


/*

    "message": [
    "https://depor.com/resizer/pfVziOV4X8Vu9nwknDc-oNItlB8=/1200x900/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/6Y2EDIISGFGVFANEVDCR5LCG34.jpg",
    "https://indiehoy.com/wp-content/uploads/2020/02/Dragon-Ball-Goku-1200x900.jpg"
    ], 

*/
?>