<?php
/*
Auteur : benrahma Anas
Objectif : Valider le formulaire POST et enregistrer les notes en CSV
Date : 18/10/2026
*/
require_once "config.php";

$nom_existe = isset($_POST["nom"]);
$nom = trim((string) ($_POST["nom"] ?? ""));
$info_brut = $_POST["note_info"] ?? null;
$math_brut = $_POST["note_math"] ?? null;
$erreurs = [];

if (!$nom_existe || empty($nom)) $erreurs[] = "Le nom est obligatoire.";
if (!isset($_POST["note_info"]) || empty($info_brut) && $info_brut !== "0") $erreurs[] = "La note d'information est obligatoire.";
if (!isset($_POST["note_math"]) || empty($math_brut) && $math_brut !== "0") $erreurs[] = "La note de mathématiques est obligatoire.";
$info = filter_var($info_brut, FILTER_VALIDATE_FLOAT);
$math = filter_var($math_brut, FILTER_VALIDATE_FLOAT);
if ($info === false || $info < NOTE_MIN || $info > NOTE_MAX) $erreurs[] = "La note d'information doit être entre 0 et 20.";
if ($math === false || $math < NOTE_MIN || $math > NOTE_MAX) $erreurs[] = "La note de mathématiques doit être entre 0 et 20.";

if (!$erreurs) {
    $fichier = __DIR__ . "/data/notes.csv";
    $handle = fopen($fichier, "a");
    if ($handle === false) {
        http_response_code(500);
        exit("Impossible d'ouvrir le fichier de notes.");
    }
    if (fputcsv($handle, [$nom, $info, $math], ";") === false) {
        fclose($handle);
        http_response_code(500);
        exit("Impossible d'enregistrer la note.");
    }
    fclose($handle);
}
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Traitement</title></head><body>
<?php if ($erreurs): ?>
<h1>Erreur</h1><ul><?php foreach ($erreurs as $erreur): ?><li><?= htmlspecialchars($erreur, ENT_QUOTES, "UTF-8") ?></li><?php endforeach; ?></ul>
<?php else: ?>
<h1>Enregistrement réussi</h1>
<p><?= htmlspecialchars($nom, ENT_QUOTES, "UTF-8") ?> :
information <?= htmlspecialchars((string) $info, ENT_QUOTES, "UTF-8") ?>,
mathématiques <?= htmlspecialchars((string) $math, ENT_QUOTES, "UTF-8") ?>.</p>
<p><a href="liste.php">Voir la liste</a></p>
<?php endif; ?>
<p><small>POST évite d'exposer les données dans l'URL, mais ne remplace pas HTTPS pour un mot de passe.
$_REQUEST peut contenir GET, POST et COOKIE selon la configuration PHP.</small></p>
</body></html>