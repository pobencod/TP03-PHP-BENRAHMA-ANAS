<?php
/*
Auteur : Benrahma Anas
Objectif : Variables, constantes, types et chaînes
Date : 18/10/2026
*/

require "config.php";

// $x, $_x, $Prix_HT et $état sont valides ; $2x, $x-y et $prix ht ne le sont pas.
$x = 1;
$_x = 2;
$Prix_HT = 60;
$état = "actif";
$a = "minuscule";
$A = "majuscule";

echo "<h1>Bases PHP</h1>";
echo "Hello PHP<br>";
echo "Établissement : " . ETABLISSEMENT . "<br>";
echo "Note minimale : " . NOTE_MIN . "<br>";
echo "Note maximale : " . NOTE_MAX . "<br>";
echo "Seuil de réussite : " . SEUIL . "<br>";

// Vérifier l'existence des constantes
var_dump(defined("SEUIL"));
echo "<br>";

var_dump(defined("INCONNUE"));
echo "<br>";

echo "<h2>Variables</h2>";
echo "\$a et \$A sont distinctes : ";
var_dump($a !== $A);

// Une constante inconnue produit un avertissement et une valeur null.
// const est évalué à la compilation ; define() crée une constante à l'exécution.

$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "<h2>Calcul</h2>Le prix TTC du produit est de " . $prix_ttc . " €.<br>";

$test = 42;
$test = (string) $test;
var_dump($test);
echo "<h2>Conversions booléennes</h2>";
foreach ([0, 0.0, "0", "", "abc", [], null] as $valeur) {
    var_dump((bool) $valeur);
}
echo "<h2>Conversions numériques</h2>";
var_dump((int) 3.9, (int) "12abc", (float) "1.5e3", (int) true);

$decimal = 255;
$hexadecimal = 0xFF;
$octal = 0377;
$binaire = 0b11111111;
echo "Décimal : $decimal | Hexadécimal : $hexadecimal | Octal : $octal | Binaire : $binaire<br>";

$traitees = "égales à";
$ici = 2;
echo '<h2>Chaînes</h2>';
echo "Ahmed a dit : \"J'ai réussi\"<br>";
echo "Voulez-vous supprimer C:\\*.*?<br>";
echo 'Ceci n\'affichera pas \n de nouvelle ligne<br>';
echo 'Les variables ne seront pas $traitees $ici<br>';
echo "Les variables seront $traitees $ici<br>";

$message = trim("*Bonjour les développeurs*", "*");
echo $message . "<br>";
for ($i = 0; $i < strlen($message); $i++) {
    echo htmlspecialchars($message[$i], ENT_QUOTES, "UTF-8") . "<br>";
}
?>