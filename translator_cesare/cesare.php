 <!DOCTYPE html>
<html>
<head>
	<title> CIFRARIO DI CESARE  </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
	background-color: lightblue;
}

h2{
color: white;
text-align: center;
}
.contenitore {
   text-align: center;
    margin-top: 50px;
}
input[type="text"] {
	width: 300px; 
    padding: 10px;
}
		
</style>

</head>

<body>

<h2>CIFRARIO DI CESARE</h2>

<?php

$tradotto = array(
'a' => 'd',
'b' => 'e', 
'c' => 'f',
'd' => 'g',
'e' => 'h',
'f' => 'i',
'g' => 'l',
'h' => 'm',
'i' => 'n',
'l' => 'o',
'm' => 'p',
'n' => 'q',
'o' => 'r',
'p' => 's',
'q' => 't',
'r' => 'u',
's' => 'v',
't' => 'z',
'u' => 'a',
'v' => 'b',
'z' => 'c',
'x' => 'h',
'h' => 'x',
'w' => 'y',
'y' => 'w',
);



function Testo_To_Cesare ($testo, $mappa) {
    $cesare = '';
	$testo = strtolower($testo); // converte tutto in minuscolo cosi che se l'utente scrive grande funziona lo stesso
    $chiavi = array_keys($mappa); // Otteniamo le chiavi (le lettere)
    $valori = array_values($mappa); // Otteniamo i valori (codice cesare)

    for ($i = 0; $i < strlen($testo); $i++) {
        $carattere = $testo[$i];
        $trovato = false;

        // Scorriamo la mappa con un for
        for ($j = 0; $j < count($chiavi); $j++) {
            if ($carattere === (string)$chiavi[$j]) { // ho messo string perche i numeri me li converte in intero
                $cesare = $cesare . $valori[$j] . ' ';
                $trovato = true;
                break;
            }
        }
    }

    return $cesare;
}

function Cesare_To_Testo($cesare, $mappa) {
    $testo = '';
    $chiavi = array_keys($mappa);   // Lettere e numeri
    $valori = array_values($mappa); // Codici cesare
    
    // Separiamo i codici cesare
    $caratteri = explode(' ', $cesare);
    
    for ($j = 0; $j < count($caratteri); $j++) {
        $codice = trim($caratteri[$j]); // rimuove gli spazi da una lettera all'altra che si sono creati con explode
		//in modo che quando vado a confrontarli con la mia mappa chiave-valore siano identici
        
        $trovato = false;
        
        // Scorriamo i codici cesare per trovare la corrispondenza
        for ($k = 0; $k < count($valori); $k++) {
            if ($codice === $valori[$k]) {
                $testo = $testo . $chiavi[$k];
                $trovato = true;
                break;
            }
        }
    }
    return $testo; 
}


$val = '';
$risultato = '';

if(isset($_POST['cod']) && $_POST['cod'] != '' ){
	 $val = $_POST['cod'];
	$risultato= Testo_To_Cesare($val,$tradotto);
}else if(isset($_POST['cesare']) && $_POST['cesare'] != ''  ){
	  $risultato = $_POST['cesare'];
	$val= Cesare_To_Testo($risultato, $tradotto);
}

?>
<div class="contenitore"> <!-- mette al centro dello schermo tutto cio che si trova nel form --!>
<form action = "/translator_cesare/cesare.php" method = "post" >
	TESTO: <input type= "text"  name= "cod" value= "<?php echo $val; ?>" placeholder = "testo"> <br> <br>
	CESARE: <input type= "text" name= "cesare" value= "<?php echo $risultato; ?>" placeholder = "testo tradotto"> <br><br>
	<input type = "Submit" name= "Submit">
	
	
</form >
</div>
<br>
<a href= "cesare.php">Torna indietro </a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
