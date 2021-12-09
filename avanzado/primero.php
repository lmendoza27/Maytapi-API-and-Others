<?php

/**
 * Realice un script en que el usuario elija de una caja de selecci�n "ni�o", "ni�a", "se�orita", "se�ora" y "se�or" y escriba su 
 * nombre y devuelva por ejemplo: "hola ni�a Mar�a, su sexo es femenino" u "hola se�or Juan, su sexo es masculino".
 **/


?>
<form method="post" action="">
        <select class="form-control" name="concepto" id="consulCliente" required>
            <option value="" selected disabled><p>Seleccione su concepto...</p></option>
            <option value="niño" data-info="niño">Niño</option>
            <option value="niña" data-info="niña">Niña</option>
            <option value="señorita" data-info="señorita">Señorita</option>
            <option value="señora" data-info="señora">Señora</option>
            <option value="señor" data-info="señor">Señor</option>
        </select> 

        <input type="text" value="" name="nombre" required>

    <button type="submit" name="">Consultar</button> 

</form>

<?php


$concepto = $_POST['concepto']; 
$nombre = $_POST['nombre'];

if(empty($nombre) && empty($concepto)) {
    
}else {
    echo "Muy buenos días: ".$concepto." ".$nombre;
}


?>