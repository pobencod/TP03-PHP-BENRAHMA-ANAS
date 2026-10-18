<?php
/*
Auteur : benrahma Anas
Objectif : Authentifier un apprenant avec une session et un cookie
Date : 18/10/2026
*/
session_start();
$erreur = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim((string) ($_POST["login"] ?? ""));
    if ($login === "") {
        $erreur = "Le login est obligatoire.";
    } else {
        $_SESSION["login"] = $login;
        setcookie("dernier_login", $login, time() + 86400, "/");
        setcookie("connexion_info", json_encode(["login" => $login, "date" => date("c")]), time() + 86400, "/");
        header("Location: profil.php");
        exit;
    }
} else {
    $login = (string) ($_COOKIE["dernier_login"] ?? "");
}
?>
<!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Connexion</title></head><body>
<h1>Connexion</h1>
<?php if ($erreur): ?><p><?= htmlspecialchars($erreur, ENT_QUOTES, "UTF-8") ?></p><?php endif; ?>
<form method="post" action="login.php">
    <label>Login <input type="text" name="login" value="<?= htmlspecialchars($login, ENT_QUOTES, "UTF-8") ?>" required></label>
    <button type="submit">Se connecter</button>
</form>
</body></html>