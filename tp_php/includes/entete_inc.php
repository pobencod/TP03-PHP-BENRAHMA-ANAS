<?php
/*
Auteur : benrahma Anas
Objectif : En-tête HTML partagé
Date : 18/10/2026
*/
require_once __DIR__ . "/../config.php";
?>
<!doctype html>
<html lang="fr">
<head><meta charset="UTF-8"><title><?= htmlspecialchars(ETABLISSEMENT, ENT_QUOTES, "UTF-8") ?></title></head>
<body>
<header><h1><?= htmlspecialchars(ETABLISSEMENT, ENT_QUOTES, "UTF-8") ?></h1></header>