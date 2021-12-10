<?php
date_default_timezone_set('America/Lima');
//echo date('d-m-Y');
$year = date('Y');
?>

<form method="post" action="">
    <p>¿Cuándo cumples?</p>
<!--<input type="date" value="" name="cumple" min="<?php echo $year.'-01-01';?>" max="<?php echo $year.'-12-31';?>" required>-->
<select class="form-control" name="dia" required>
            <option value="" selected disabled><p>Seleccione su día</p></option>
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
            <option value="6" >6</option>
            <option value="7" >7</option>
            <option value="8" >8</option>
            <option value="9" >9</option>
            <option value="10" >10</option>
            <option value="11" >11</option>
            <option value="12" >12</option>
            <option value="13" >13</option>
            <option value="14" >14</option>
            <option value="15" >15</option>
            <option value="16" >16</option>
            <option value="17" >17</option>
            <option value="18" >18</option>
            <option value="19" >19</option>
            <option value="20" >20</option>
            <option value="21" >21</option>
            <option value="22" >22</option>
            <option value="23" >23</option>
            <option value="24" >24</option>
            <option value="25" >25</option>
            <option value="26" >26</option>
            <option value="27" >27</option>
            <option value="28" >28</option>
            <option value="29" >29</option>
            <option value="30" >30</option>
            <option value="31" >31</option>
        </select> 


        <select class="form-control" name="mes" required>
            <option value="" selected disabled><p>Seleccione su mes</p></option>
            <option value="1" >Enero</option>
            <option value="2" >Febrero</option>
            <option value="3" >Marzo</option>
            <option value="4" >Abril</option>
            <option value="5" >Mayo</option>
            <option value="6">Junio</option>
            <option value="7" >Julio</option>
            <option value="8" >Agosto</option>
            <option value="9" >Setiembre</option>
            <option value="10" >Octubre</option>
            <option value="11" >Noviembre</option>
            <option value="12" >Diciembre</option>
        </select> 

<button type="submit">Procesar</button>
</form>

<?php
/**
 * Realice un script que solicite la fecha de su pr�ximo cumplea�os y responda cuantos d�as faltan.
 * 
 */

$dia = $_POST['dia'];
$mes = $_POST['mes'];

if(empty($dia) && empty($mes)) {
   // echo "Establece una fecha de cumpleaños por favor";
}else {
    // Comprobé que este no funciona bien del todo... 
    /*$birthday = $dia.' '.$mes;
    $days = round(abs(strtotime($birthday)-time()) / 86400);
    echo "Quedan ".$days." para tu cumpleaños"; */

   /* $hoy = time();
    $birthday = strtotime($year.'-'.$mes.'-'.$dia);
    $datediff = $hoy - $birthday;
    echo round($datediff / (60 * 60 * 24));*/

    $now = time(); // or your date as well
//$your_date = strtotime("2021-12-27");



//$your_date = strtotime($year.'-'.$mes.'-'.$dia);

if(strtotime($year.'-'.$mes.'-'.$dia) < time()) {
   
    //$your_date = strtotime(($year+1).'-'.$mes.'-'.($dia));
    $your_date = strtotime(($year+1).'-'.$mes.'-'.$dia);
}else{
    $your_date = strtotime($year.'-'.$mes.'-'.$dia);
}


//echo $your_date;
$datediff = $your_date - $now;
echo '<br>';
//$calculo = (round($datediff / (60 * 60 * 24))+1);
$calculo = (round($datediff / (60 * 60 * 24))+1);

echo 'La fecha establecida fue: '.$dia.' del '.$mes;

echo '<br>';
if($calculo == 1) {
    echo 'Queda: '.$calculo." día para tu cumpleaños";
}else if($calculo == 365) {
    echo "Hoy es tu cumpleaños";
}else if($calculo >=2) {
    echo 'Quedan: '.$calculo." días para tu cumpleaños";
}


//echo 'Quedan: '.(round($datediff / (60 * 60 * 24))+1)." días para tu cumpleaños";
}
/*$birthday = "27 December";
$days = round(abs(strtotime($birthday)-time()) / 86400);
echo "Quedan ".$days." para tu cumpleaños";*/
?>