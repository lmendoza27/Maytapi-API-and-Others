<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require_once('./vendor/autoload.php');

$client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';

$response = $client->request('GET', 'https://api.maytapi.com/api/'.$product_id.'/logs');

$data = json_decode($response->getBody(), true);
$search = '35f710e0-56bb-11ec-9637-cb0a3e3e4fd5';
// 35f710e0-56bb-11ec-9637-cb0a3e3e4fd5
$found = false;
// Para los de tipo ERROR
foreach ($data['data']['list'] as $d) {
    // En caso el msgId sea error
    if($d['data']['body']['data']['id'] == $search) {
        $found=$d['data']['body']['type'];
        break;
    // En caso el msgId sea correcto
    }elseif($d['data']['body']['data'][0]['msgId'] == $search) {
        $found=$d['data']['body']['type'];
        break;
    // En caso el msgId no esté registrado en el Log
    }else{
        $found='No';
    }
}
//echo $found?$found:"No se encontró el código: ".$search;
echo $found;

?>