<?php

echo PHP_VERSION;

function conversation() {
    echo "\n";
    echo "Estamos en una conversación...";
}

conversation();

function operadores($num1,$num2) {
    echo "\n";
    echo "---- Ahora empezaremos realizando una serie de operaciones gracias a los dos parámetros dados ----";
    echo "\n";
    echo "La primera opeación será la Suma: ".($num1+$num2);
}

operadores(5,6);

?>