<?php
/*
Auteur : benrahma Anas
Objectif : Structures conditionnelles et boucles
Date : 18/10/2026
*/
require_once "config.php";

function mention(float|int $note): string
{
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    }
    return "Ajourné";
}
?>
<h1>Structures de contrôle</h1>
<h2>Mentions</h2>
<?php
foreach ([7, 10, 12, 14, 16, 18] as $note) {
    echo $note . " : " . mention($note) . "<br>";
}

$mois = date("m");
switch ($mois) {
    case "01": $nom_mois = "janvier"; break;
    case "02": $nom_mois = "février"; break;
    case "03": $nom_mois = "mars"; break;
    case "04": $nom_mois = "avril"; break;
    case "05": $nom_mois = "mai"; break;
    case "06": $nom_mois = "juin"; break;
    case "07": $nom_mois = "juillet"; break;
    case "08": $nom_mois = "août"; break;
    case "09": $nom_mois = "septembre"; break;
    case "10": $nom_mois = "octobre"; break;
    case "11": $nom_mois = "novembre"; break;
    case "12": $nom_mois = "décembre"; break;
    default: $nom_mois = "mois inconnu";
}
echo "<h2>Mois courant</h2>$nom_mois<br>";
echo "<p>Sans break, l'exécution continue dans les cases suivantes (fall-through).</p>";

echo "<h2>Triangle</h2>";
for ($ligne = 1; $ligne <= 6; $ligne++) {
    for ($colonne = 1; $colonne <= $ligne; $colonne++) {
        echo "*";
    }
    echo "<br>";
}

echo "<h2>While</h2>";
$i = 0;
while ($i <= 20) {
    echo $i === 10 ? "<strong>$i</strong> " : "$i ";
    $i += 2;
}

echo "<h2>Pairs avec continue</h2>";
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 !== 0) {
        continue;
    }
    echo "$i ";
}

echo "<h2>break 2</h2>";
$i = 1;
while ($i <= 12) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break;
        case 10:
            echo "At 10; quitting<br>";
            break 2;
    }
    $i++;
}

echo "<h2>Do-while</h2>";
$i = 0;
do {
    echo $i === 10 ? "<strong>$i</strong> " : "$i ";
    $i += 2;
} while ($i <= 20);
echo "<p>do-while exécute le bloc au moins une fois, contrairement à while.</p>";