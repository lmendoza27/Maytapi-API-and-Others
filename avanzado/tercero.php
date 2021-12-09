<form method="post" action="">
    <p>Ingresa dos palabras</p>
<input type="text" value="" name="word1" required>
<input type="text" value="" name="word2" required>
<button type="submit">Procesar</button>
</form>

<?php
/**
 * Realice un script que pida al usuario 2 palabras, y diga cual esta primero alfabeticamente.
 * 
 */

$primero = $_POST['word1'];
$segundo = $_POST['word2'];

if(empty($primero) && empty($segundo)) {
    echo "LLene";
}else {
    $words = array(
        $primero,
        $segundo
    );
    
    setlocale(LC_COLLATE, 'es_ES.utf8');
    asort($words, SORT_LOCALE_STRING);
    
    //echo var_export($words);
    
    // var_export == Imprime o devuelve una representación string de una variable analizable

    //echo "La primera palabra alfabéticamente es: ".var_export($words[0])." anterior a ".var_export($words[1]);
    echo "La primera palabra alfabéticamente es: ".$words[0]." anterior a ".$words[1];
}




?>