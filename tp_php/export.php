<?php
/*
Auteur : benrahma Anas
Objectif : Exporter les résultats en JSON et comparer les sérialisations
Date : 18/10/2026
*/
require_once "config.php";
$fichier_csv = __DIR__ . "/data/notes.csv";
$resultats = [];
if (file_exists($fichier_csv)) {
    $handle = fopen($fichier_csv, "r");
    if ($handle === false) exit("Impossible d'ouvrir le CSV.");
    while (($ligne = fgetcsv($handle, 0, ";")) !== false) {
        if (count($ligne) < 3) continue;
        $resultats[] = ["nom" => $ligne[0], "note_info" => (float) $ligne[1], "note_math" => (float) $ligne[2],
            "moyenne" => ((float) $ligne[1] + (float) $ligne[2]) / 2];
    }
    fclose($handle);
}
$json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if ($json === false || file_put_contents(__DIR__ . "/data/notes.json", $json) === false) exit("Impossible d'écrire le JSON.");
$relue = json_decode((string) file_get_contents(__DIR__ . "/data/notes.json"), true, 512, JSON_THROW_ON_ERROR);
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Export</title></head><body>
<h1>Export JSON</h1><pre><?= htmlspecialchars(print_r($relue, true), ENT_QUOTES, "UTF-8") ?></pre>
<h2>Comparaison</h2><pre><?= htmlspecialchars(serialize($resultats), ENT_QUOTES, "UTF-8") ?></pre>
<pre><?= htmlspecialchars((string) $json, ENT_QUOTES, "UTF-8") ?></pre>
<p>JSON est directement exploitable par JavaScript ; serialize() est spécifique à PHP.</p>
</body></html>