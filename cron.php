<?php
include "navbar.php";
$boutiques = $db->query("SELECT * FROM `log_boutique`");
foreach ($boutiques as $boutique) {
    if ($boutique['attribut'] == "ping") {
        $nom = $boutique['nom'];
        if ($boutique['valeur'] == 'KO') {
            echo "<p> $nom n'a pas répondu</p>";
        } else if (intval($boutique['valeur']) > intval($boutique['seuil'])) {
            echo "<p> $nom depasse le seuil, " . $boutique['valeur'] . " ms</p>";
        }
    }
}
$req = $db->query("SELECT * FROM `log_serveur2`");
foreach ($req as $entry) {
    if ((100 - intval($entry['valeur'])) > $entry['seuil'] && $entry['seuil'] && $entry['valeur']) { // Gestion d'une valeur plus haute que le seuil et si pas de seuil (service)
        echo "<p> " . $entry['nom'] . " :<br> " . $entry['attribut'] . " : " . $entry['valeur'] . " (seuil : " . $entry['seuil'] . ").</p>";
    } else if ($entry['type_mesure'] == "Service" && $entry['valeur'] != "OK") {
        echo "<p> " . $entry['nom'] . " : service " . $entry['attribut'] . " KO.</p>";
    }
}
