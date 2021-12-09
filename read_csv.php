<?php
/*$file = fopen('./csv/data_rump.csv', 'r');
while (($line = fgetcsv($file)) !== FALSE) {
   print_r($line);
}
fclose($file);
*/


/*$fila = 1;
if (($gestor = fopen('./csv/data_rump.csv', "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
        echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            echo $datos[$c] . "<br />\n";
        }
    }
    fclose($gestor);
}*/


/*$start_row = 5; //define start row
$i = 1; //define row count flag
$file = fopen("./csv/data_rump.csv", "r");
while (($row = fgetcsv($file)) !== FALSE) {
    if($i >= $start_row) {
        print_r($row);
        //do your stuff
    }
    $i++;
}

// close file
fclose($file);*/


/*$csv = array_map("str_getcsv", file("./csv/data_rump.csv", "r")); 
$header = array_shift($csv); 
// Seperate the header from data

$col = array_search("Value", $header); 
 foreach ($csv as $row) {      
 $array[] = $row[$col]; 
}*/


/*$file = fopen('./csv/data_rump.csv', 'r');
$data = array();
while($row = fgetcsv($file)) {
   $data[$row[0]] = $row[1];
}*/

//  https://webdiretto.it/to-extract-single-column-values-from-csv-file-php/

//FGETCSV Basic Usage (Extracts all columns results line by line):

/*$row = 1;
if (($handle = fopen("./csv/data_rump.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}*/

//FGETCSV COLUMN “1” EXTRACTION (Extracts just first column results):

$row = 1;
if (($handle = fopen("./csv/data_rump.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num campos en la fila $row: <br /></p>\n";
        $row++;
        for ($c=2; $c < 3; $c++) {
            echo 'La mascota en esta fila es: '.$data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}


?>