
<form method="post" action="">
<input type="text" value="" name="frase" required>
<button type="submit">Procesar</button>
</form>


<?php
/**
 * Realice un script que pida al usuario una frase y muestrela toda en min�sculas, toda en mayusculas, con la primer letra en mayusculas y con 
 * la primer palabra en mayusculas y el resto en minusculas.
 */


$frase = $_POST['frase'];

if(empty($frase)) {
    echo "Escriba su frase por favor...";
}else {
    echo "Un listado de lo que podemos hacer con las palabras en PHP...";
    echo "<br>";
    echo "Básico: " . $frase;
    echo "<br>";
    echo "Minúsculas: " . strtolower($frase);
    echo "<br>";
    echo "Mayúsculas: " . strtoupper($frase);
    echo "<br>";
    echo "Primera letra en Mayúscula: " . ucfirst($frase);
    echo "<br>";
    $get_first_word = strtok($frase, ' '); 
    $remove_first_word = strstr($frase, ' ');
    echo "Primera palabra en Mayúscula: ". strtoupper($get_first_word). " ". $remove_first_word;   
}


?>