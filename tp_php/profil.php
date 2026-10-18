<?php
/*
Auteur : benrahma Anas
Objectif : Afficher le profil protégé par session
Date : 18/10/2026
*/
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$login = (string) $_SESSION["login"];
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Profil</title></head><body>
<h1>Profil</h1>
<p>Bienvenue <?= htmlspecialchars($login, ENT_QUOTES, "UTF-8") ?>.</p>
<a href="deconnexion.php">Se déconnecter</a>
</body></html>