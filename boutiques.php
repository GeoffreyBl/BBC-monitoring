<?php
include "navbar.php";
$boutiques = $db->query("SELECT * FROM `log_boutique` ORDER BY code");

foreach ($boutiques as $boutique) { //Affichage des boutiques en rouge
    if ($boutique['attribut'] == "ping" && $boutique['valeur'] == 'KO') {
        echo "<a href=" . $boutique['url_objet'] . "><p class='red m-3 p-1 rounded'>" . $boutique['nom'] . " (" . $boutique['code'] . ")<br>Boutique KO</a><br>";
    }
}
$boutiques = $db->query("SELECT * FROM `log_boutique` ORDER BY code");
foreach ($boutiques as $boutique) {
    if ($boutique['attribut'] == "ping" && $boutique['valeur'] > $boutique['seuil'] && $boutique['valeur'] != 'KO') {
        echo "<a href=" . $boutique['url_objet'] . "><p class='orange m-3 p-1 rounded'>" . $boutique['nom'] . " (" . $boutique['code'] . ")<br>boutique trop lente (" . floor($boutique['valeur']) . " ms)</a><br>";
    }
}
$boutiques = $db->query("SELECT * FROM `log_boutique` ORDER BY code");
foreach ($boutiques as $boutique) {
    if ($boutique['attribut'] == "ping" && $boutique['valeur'] < $boutique['seuil'] && $boutique['valeur'] != '99998' && $boutique['valeur'] != '99999') {
        echo "<a href=" . $boutique['url_objet'] . "><p class='green m-3 p-1 rounded'>" . $boutique['nom'] . " (" . $boutique['code'] . ")<br> a répondu en : " . floor($boutique['valeur']) . " ms</a><br></p>";
    }
}
if ($_SESSION['admin']) {
    echo "<p class='p-1 m-3'><a class='text-decoration-underline' href='ajoutboutique.php'>Ajouter une boutique<i class='fas fa-arrow-right'></i></a></p>";
}
?>
</body>

</html>