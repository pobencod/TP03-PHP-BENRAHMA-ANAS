<?php
/*
Auteur : benrahma Anas
Objectif : Tableaux, statistiques et tris
Date : 18/10/2026
*/
require_once "config.php";

function mention_tableau(float|int $note): string
{
    if ($note >= 16) return "Très bien";
    if ($note >= 14) return "Bien";
    if ($note >= 12) return "Assez bien";
    if ($note >= SEUIL) return "Passable";
    return "Ajourné";
}

function afficher(array $tab): void
{
    echo "<ul>";
    foreach ($tab as $nom => $note) {
        echo "<li>" . htmlspecialchars((string) $nom, ENT_QUOTES, "UTF-8") . " : $note</li>";
    }
    echo "</ul>";
}

$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ["PHP", "HTML/CSS", "Base de données"];
require "includes/entete_inc.php";
require "includes/menu_inc.php";
?>
<main>
<h2>Modules</h2>
<?php
foreach ($modules as $module) echo htmlspecialchars($module, ENT_QUOTES, "UTF-8") . "<br>";
echo "Premier module : " . htmlspecialchars($modules[0], ENT_QUOTES, "UTF-8") . "<br>";
?>
<h2>Notes</h2>
<table border="1">
<tr><th>Nom</th><th>Note</th><th>Mention</th></tr>
<?php foreach ($notes as $nom => $note): ?>
<tr<?= $note < SEUIL ? ' style="color:red"' : "" ?>>
    <td><?= htmlspecialchars($nom, ENT_QUOTES, "UTF-8") ?></td>
    <td><?= $note ?></td>
    <td><?= mention_tableau($note) ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php
$somme = 0;
$meilleure = null;
$plus_faible = null;
$effectifs = [];
foreach ($notes as $note) {
    $somme += $note;
    $meilleure = $meilleure === null ? $note : max($meilleure, $note);
    $plus_faible = $plus_faible === null ? $note : min($plus_faible, $note);
    $mention = mention_tableau($note);
    $effectifs[$mention] = ($effectifs[$mention] ?? 0) + 1;
}
$moyenne = $somme / count($notes);
?>
<h2>Statistiques</h2>
<p>Somme : <?= $somme ?>, moyenne : <?= number_format($moyenne, 2, ",", " ") ?>,
meilleure note : <?= $meilleure ?>, plus faible : <?= $plus_faible ?>.</p>
<p>Vérification : somme <?= array_sum($notes) ?>, effectif <?= count($notes) ?>,
maximum <?= max($notes) ?>, minimum <?= min($notes) ?>.</p>
<h3>Effectifs par mention</h3>
<?php afficher($effectifs); ?>
<h2>Tris</h2>
<h3>Noms croissants</h3><?php $tri = $notes; ksort($tri); afficher($tri); ?>
<h3>Notes décroissantes</h3><?php $tri = $notes; arsort($tri); afficher($tri); ?>
<h3>Noms décroissants</h3><?php $tri = $notes; krsort($tri); afficher($tri); ?>
<h3>Notes croissantes</h3><?php $tri = $notes; asort($tri); afficher($tri); ?>
<h2>Opérateurs de tableaux</h2>
<?php
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];
echo "<pre>";
var_dump($a + $b, $a == $b, $a === $b);
echo "</pre><p>+ conserve les premières valeurs par clé ; == ignore l'ordre ;
=== exige les mêmes clés, valeurs et ordre.</p>";
echo "<p>Pour un tableau indexé, utiliser sort() (ou rsort() pour l'ordre inverse).</p>";
?>
</main>
<?php require "includes/pied_inc.php"; ?>