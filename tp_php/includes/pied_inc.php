<!--
Auteur : benrahma Anas
Objectif : Pied de page partagé et affichage des dates
Date : 18/10/2026
-->
<footer>
    <p>Date : <?= date("d/m/Y") ?></p>
    <?php
    $fin_semestre = new DateTime("2027-01-31");
    $aujourd_hui = new DateTime("today");
    $jours = max(0, (int) $aujourd_hui->diff($fin_semestre)->format("%r%a"));
    ?>
    <p>Jours restants avant la fin du semestre : <?= $jours ?></p>
</footer>
</body>
</html>