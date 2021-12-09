<?php
/* UNIQUE CELLPHONE NUMBER */

// this array will hold the results
$unique_ids = array();
// open the csv file for reading
$fd = fopen("./csv/Ejemplar3.csv", 'r');
// read the rows of the csv file, every row returned as an array
while ($row = fgetcsv($fd)) {
    // change the 3 to the column you want
    // using the keys of arrays to make final values unique since php
    // arrays cant contain duplicate keys
    $unique_ids[$row[3]] = true;
}
var_dump(array_keys($unique_ids));

// Lo otro sería crear otro archivo para que solo me dé los teléfonos únicos...

?>