<?php 
$string = 'El 2 está genial';
$int = (int) filter_var($string, FILTER_SANITIZE_NUMBER_INT);  
echo("El número incontrado fue el 2: $int \n"); 

if($int == 1) {
    echo "Escogiste el kit 1 - básico";
}else if ($int == 2) {
    echo "Escogiste el kit 2 - premium";
}else {
    echo "Por favor, vuelve a escoger un número";
}

?> 