<?php
/*
Auteur : benrahma Anas
Objectif : Lire et afficher les notes CSV
Date : 18/10/2026
*/
require_once "config.php";
$fichier = __DIR__ . "/data/notes.csv";
$lignes = [];
$somme_generale = 0;
if (file_exists($fichier)) {
    $handle = fopen($fichier, "r");
    if ($handle === false) {
        http_response_code(500);
        exit("Impossible d'ouvrir le fichier CSV.");
    }
    while (($ligne = fgetcsv($handle, 0, ";")) !== false) {
        if (count($ligne) < 3) continue;
        $moyenne = ((float) $ligne[1] + (float) $ligne[2]) / 2;
        $lignes[] = ["nom" => $ligne[0], "info" => (float) $ligne[1], "math" => (float) $ligne[2], "moyenne" => $moyenne];
        $somme_generale += $moyenne;
    }
    fclose($handle);
}
function mention_liste(float $note): string {
    if ($note >= 16) return "Très bien";
    if ($note >= 14) return "Bien";
    if ($note >= 12) return "Assez bien";
    if ($note >= SEUIL) return "Passable";
    return "Ajourné";
}
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Liste des notes</title></head><body>
<h1>Liste des notes</h1>
<?php if (!$lignes): ?>
<p>Aucune note enregistrée.</p>
<?php else: ?>
<table border="1"><tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>
<?php foreach ($lignes as $ligne): ?><tr>
<td><?= htmlspecialchars($ligne["nom"], ENT_QUOTES, "UTF-8") ?></td><td><?= $ligne["info"] ?></td><td><?= $ligne["math"] ?></td>
<td><?= number_format($ligne["moyenne"], 2, ",", " ") ?></td><td><?= mention_liste($ligne["moyenne"]) ?></td>
</tr><?php endforeach; ?></table>
<p>Moyenne générale : <?= number_format($somme_generale / count($lignes), 2, ",", " ") ?></p>
<?php endif; ?>
<h2>Lecture bas niveau</h2>
<?php
if (file_exists($fichier)) {
    $bas_niveau = fopen($fichier, "r");
    if ($bas_niveau === false) exit("Impossible de relire le CSV.");
    while (!feof($bas_niveau)) {
        $ligne_texte = fgets($bas_niveau);
        if ($ligne_texte !== false) {
            $champs = explode(";", trim($ligne_texte));
            echo "<div>" . htmlspecialchars(implode(" | ", $champs), ENT_QUOTES, "UTF-8") . "</div>";
        }
    }
    fclose($bas_niveau);
}
?>
<p>fgetcsv gère correctement les guillemets et séparateurs contenus dans une valeur ;
fgets/explode est simple mais ne gère pas ces cas CSV complexes.</p>
<p><a href="saisie.html">Ajouter une note</a> | <a href="export.php">Exporter en JSON</a></p>
</body></html>