<?php
/*
Auteur : benrahma Anas
Objectif : Détruire la session et rediriger vers la connexion
Date : 18/10/2026
*/
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;