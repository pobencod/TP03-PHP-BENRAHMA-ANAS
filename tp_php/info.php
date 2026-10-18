<?php
/*
Auteur : benrahma Anas
Objectif : Traiter le formulaire GET d'informations
Date : 18/10/2026
*/
$nom = trim((string) ($_GET["nom"] ?? ""));
$prenom = trim((string) ($_GET["prenom"] ?? ""));
$sexe = $_GET["sexe"] ?? "";
$civilite = $sexe === "F" ? "Madame" : ($sexe === "M" ? "Monsieur" : "");
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Résultat</title></head><body>
<?php if ($civilite !== "" && $nom !== "" && $prenom !== ""): ?>
<p>Bonjour <?= $civilite ?> <?= htmlspecialchars($prenom . " " . $nom, ENT_QUOTES, "UTF-8") ?>.</p>
<?php else: ?><p>Veuillez renseigner tous les champs.</p><?php endif; ?>
</body></html>