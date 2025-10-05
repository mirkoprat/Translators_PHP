 <!DOCTYPE html>
<html>
<head>
	<title> CODICE MORSE </title>
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

<h2>CODICE MORSE</h2>

<?php

$tradotto = array(
'a' => '.-',
'b' => '-...', 
'c' => '-.-.',
'd' => '-..',
'e' => '.',
'f' => '..-.',
'g' => '--.',
'h' => '....',
'i' => '..',
'j' => '.---',
'k' => '-.-',
'l' => '.-..',
'm' => '--',
'n' => '-.',
'o' => '---',
'p' => '.--.',
'q' => '--.-',
'r' => '.-.',
's' => '...',
't' => '-',
'u' => '..-',
'v' => '...-',
'w' => '.--',
'x' => '-..-',
'y' => '-.--',
'z' => '--..',
'1' => '.----',
'2' => '..---',
'3' => '...--',
'4' => '....-',
'5' => '.....',
'6' => '-....',
'7' => '--...',
'8' => '---..',
'9' => '----.',
'0' => '-----',
);



function Testo_To_Morse($testo, $mappa) {
    $morse = '';
	$testo = strtolower($testo); // converte tutto in minuscolo cosi che se l'utente scrive grande funziona lo stesso
    $chiavi = array_keys($mappa); // Otteniamo le chiavi (le lettere)
    $valori = array_values($mappa); // Otteniamo i valori (codice Morse)

    for ($i = 0; $i < strlen($testo); $i++) {
        $carattere = $testo[$i];
        $trovato = false;

        // Scorriamo la mappa con un for
        for ($j = 0; $j < count($chiavi); $j++) {
            if ($carattere === (string)$chiavi[$j]) { // ho messo string perche i numeri me li converte in intero
                $morse = $morse . $valori[$j] . ' ';
                $trovato = true;
                break;
            }
        }
    }

    return $morse;
}

function Morse_To_Testo($morse, $mappa) {
    $testo = '';
    $chiavi = array_keys($mappa);   // Lettere e numeri
    $valori = array_values($mappa); // Codici Morse
    
    // Separiamo i codici Morse
    $caratteri = explode(' ', $morse);
    
    for ($j = 0; $j < count($caratteri); $j++) {
        $codice = trim($caratteri[$j]); // rimuove gli spazi da una lettera all'altra che si sono creati con explode
		//in modo che quando vado a confrontarli con la mia mappa chiave-valore siano identici
        
        $trovato = false;
        
        // Scorriamo i codici Morse per trovare la corrispondenza
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
	$risultato= Testo_To_Morse($val,$tradotto);
}else if(isset($_POST['morse']) && $_POST['morse'] != ''  ){
	  $risultato = $_POST['morse'];
	$val= Morse_To_Testo($risultato, $tradotto);
}

?>
<div class="contenitore"> <!-- mette al centro dello schermo tutto cio che si trova nel form --!>
<form action = "/translator_morse/morse.php" method = "post" >
	TESTO: <input type= "text"  name= "cod" value= "<?php echo $val; ?>" placeholder = "testo"> <br> <br>
	MORSE: <input type= "text" name= "morse" value= "<?php echo $risultato; ?>" placeholder = "testo tradotto"> <br><br>
	<input type = "Submit" name= "Submit">
	
	
</form >
</div>
<br>
<a href= "morse.php">Torna indietro </a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
