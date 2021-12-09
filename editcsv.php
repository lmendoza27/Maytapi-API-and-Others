<?php
$i = 1;
$newdata = [];
$handle = fopen("./csv/Ejemplar3.csv", "r");

// Lo que se está pensando ahora es particionar los datos por cada cantidad de datos

// READ CSV

// Recordar dejar la comita
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {      

    // UPDATE 100TH ROW DATA (TO EXCLUDE, KEEP ONLY $i++ AND continue)
    if ($i >= 4) {
        if(empty($newdata[$i])) {
        $newdata[$i][] = 'hola';          
        }
        
        $newdata[$i][] = $data[1];  
        
        $newdata[$i][] = $data[2];  
        $newdata[$i][] = $data[3];
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
}    
fclose($fp);
?>