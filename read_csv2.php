<?php
$start_row = 2; //define start row
$i = 1; //define row count flag
$file = fopen("./csv/Ejemplar3.csv", "r");
while (($row = fgetcsv($file)) !== FALSE) {
    if($i >= $start_row) {
        //print_r($row);
        echo $row[0]."\n";
        //do your stuff
    }
    $i++;
}

// close file
fclose($file);
?>