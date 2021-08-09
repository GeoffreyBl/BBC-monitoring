<?php
$red = 0;
$green = 0;
$boutiques = $db->query("SELECT * FROM `log_boutique` ORDER BY valeur DESC");
foreach ($boutiques as $boutique) {
    if ($boutique['attribut'] == "ping") {
        if ($boutique['valeur'] == 'KO') {
            $red++;
        } else if ($boutique['valeur'] > $boutique['seuil']) {
            $red++;
        } else {
            $green++;
        }
    }
}
?>
<a href="./boutiques.php" class="navButton d-flex flex-column">
    <p>Boutiques</p>
    <div class="signaux d-flex justify-content-center">
        <span><?= $green ?> </span>
        <div class="circle green"></div>
        <span><?= $red ?> </span>
        <div class="circle red"></div>
    </div>
</a>