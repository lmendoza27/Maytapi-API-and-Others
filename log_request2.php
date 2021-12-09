<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

require_once('./vendor/autoload.php');

$client = new \GuzzleHttp\Client(['headers' => ['x-maytapi-key' => '6415a291-2670-4d09-8e1a-c41460e04743']]);

$product_id = '7b0c5675-5c38-4701-8cb3-d3deef3a79f7';

$response = $client->request('GET', 'https://api.maytapi.com/api/'.$product_id.'/logs');

$data = json_decode($response->getBody());

// 8a49a100-56a0-11ec-b344-513c75b7ae34  -- Uno de los registros del Log de hoy (Recordemos que solo almacena los de hoy)

// De lo que estoy pudiendo notar, los logs no van según tan solo del día, sino que va de 50 en 50, si un registro que quiero consultar sobrepasa los últimos 50 registros
// y por ende se pasa a la segunda página no va a buscarse ya ...
// Voy a obviarlo por el simple hecho de que mi consulta en request9.php busca en 25 segundos después... lo cual amerita una probabilidad nula de que hayan aparecido unos 50 registros
// sobre el mismo a buscar luego de ese lapso de tiempo... por lo que buscar la manera de que esa solicitud API del log de Maytapi pueda hacer paginación hacia las siguientes se podría
// realizar en un futuro...

// 7db8c460-56ab-11ec-9c8e-5b1a8925a186  -- Uno de los registros del log con error de hoy
// b860e670-56aa-11ec-9d4d-256365bb6fbc

$valor_buscado = "d9320d30-56b8-11ec-a964-3128c0e9a837";


/*$keepers = array();
foreach ($data->data->list as $item) {
    if($item->data->body->data[0]->msgId == $valor_buscado) {
        $keepers[] = $item;
    }
}*/

// ERROR

foreach ($data->data->list as $item) {
    if($item->data->body->data->id == $valor_buscado) {
      echo $item->data->body->type;
      echo 'Hola';
    }
  }

error_reporting(0);
// ACK

foreach ($data->data->list as $item) {
    if($item->data->body->data[0]->msgId == $valor_buscado) {
      echo $item->data->body->type;
      echo 'hola';
    }
  }

  


?>