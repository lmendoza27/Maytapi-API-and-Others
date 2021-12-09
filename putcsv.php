<?php


$newCsvData = array();
if (($handle = fopen("./csv/Ejemplar3.csv", "r")) !== FALSE) {
    // https://www.w3schools.com/php/func_filesystem_fgetcsv.asp
    // fgetcsv(file, length, separator, enclosure)

    /*  PARAMETERS VALUES */ 
    /* file:	
    Required. Specifies the open file to return and parse a line from
    */
    /*  lenght:  
    Optional. Specifies the maximum length of a line. Must be greater than the longest line (in characters) in the CSV file.
    Omitting this parameter (or setting it to 0) the line length is not limited, which is slightly slower. 
    Note: This parameter is required in versions prior to PHP 5
    .
    . 
    .
    */
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        

     if ($data[3] == 'Failed' || $data[3] == 'Good'){
            //break;
            //return false;
            //break;
        }else {
            $valor = rand(1,2);
            if($valor == 1){
            $data[] = 'Good';
            }elseif($valor == 2) {
            $data[] = 'Failed';    
            }
        $newCsvData[] = $data;
        }
       /* if($valor == 1){
            $data[] = 'Good';
            }elseif($valor == 2) {
            $data[] = 'Failed';    
            }
        $newCsvData[] = $data;
*/
    }
    fclose($handle);
}

$handle = fopen('./csv/Ejemplar3.csv', 'w');

foreach ($newCsvData as $line) {

   fputcsv($handle, $line);
    
}

fclose($handle);

// @TODO: Hacer los estados a partir de una fila establecida


?> 