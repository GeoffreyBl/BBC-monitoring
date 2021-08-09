<?php
include "navbar.php";

$req = $db->query("SELECT * FROM `log_serveur2` GROUP BY nom");
$serveurs = $req->fetchAll();
?>
<div class="container p-1 d-flex flex-column align-items-center">
    <div class="colonne web">
        <?php
        $ret = check_servers($db);
        foreach ($serveurs as $serveur) {
            if (in_array($serveur['nom'], $ret)) {
                echo "<a href='./readserver.php?id=" . $serveur['id'] . "'><p class='redresult'>" . $serveur['nom'] . "</p></a>";
            }
        }
        foreach ($serveurs as $serveur) {
            if (!(in_array($serveur['nom'], $ret))) {
                echo "<a href='./readserver.php?id=" . $serveur['id'] . "'><p class='greenresult'>" . $serveur['nom'] . "</p></a>";
            }
        }
        if ($_SESSION['admin']) {
            echo "<p class='m-1'><a class='text-decoration-underline' href='addserver.php'>Ajout d'un serveur<i class='fas fa-arrow-right'></i></a></p>";
        } ?>
    </div>
</div>