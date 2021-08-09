<?php include "navbar.php";
if ($_GET) {
    $id = $_GET['id'];
    $req = $db->prepare("SELECT * FROM `log_serveur2` where id=:id ORDER BY attribut");
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $serveur = $req->fetchAll();
    if (!$serveur) {
        header('Location:serveurs.php');
    }
} else {
    header('Location:serveurs.php');
}

?>
<!-- <a href="./serveurs.php"><i class="retourserveurs fas fa-arrow-left"></i></a> -->
<div class="container d-flex justify-content-center">
    <div class="colonne web">
        <div class="d-flex justify-content-around">
            <a href='./serveurs.php'><i class='retourserveurs fas fa-arrow-left'></i></a>
            <h5><?php
                if ($serveur) {
                    echo $serveur[0]['nom'];
                } else {
                    echo "<h5> Pas de log pour ce serveur</h5>";
                }
                ?></h5>
            <?php
            if ($_SESSION['admin']) {
                echo "<a href='./readobjets.php?id=" . $_GET['id'] . "'><i class='fas fa-sliders-h mt-1'></i></a>";
            } ?>
        </div>
        <?php
        if ($serveur) {
            foreach ($serveur as $entry) {
                if ($entry['type_mesure'] == "Service") {
                    echo "<p>" . $entry['attribut'] . " : ";
                    // Si KO = service down > alerte
                    if ($entry['valeur'] == "OK") {
                        echo "<i class='text-success fas fa-check-circle'></i></p>";
                    } else {
                        echo "<i class='text-danger fas fa-exclamation-triangle'></i></p>";
                    }
                }
            }
            foreach ($serveur as $entry) {
                if ($entry['type_mesure'] == "Pourcentage") {
                    echo "<p>" . $entry['attribut'] . " : ";
                    // Si type = pourcent et supérieur au seuil de remplissage alors affichage alerte
                    if ($entry['valeur'] == NULL) {
                        echo "Valeur introuvable <i class='text-danger fas fa-exclamation-triangle'></i></p>";
                    } else if ((100 - $entry['valeur']) > $entry['seuil']) {
                        echo (100 - $entry['valeur']) . " % <i class='text-danger fas fa-exclamation-triangle'></i></p>";
                    } else {
                        echo (100 - $entry['valeur']) . " %";
                    }
                }
            }
            foreach ($serveur as $entry) {
                if ($entry['type_mesure'] == "Millisecondes") {
                    // Si dépassement du seuil, alors alerte
                    if ($entry['valeur'] > $entry['seuil']) {
                        echo "<p>ping : " . floor(intval($entry['valeur'])) . " ms <i class='text-warning fas fa-exclamation-triangle'></i> ";
                    } else {
                        echo "<p>ping : " . floor(intval($entry['valeur'])) . " ms";
                    }
                }
            }
        }
        echo "</p>";
        $now = new DateTime('now');
        $now->modify("-2 hours");
        $date = date_create($serveur[0]['lastupdate']);
        $uptime = date_diff($date, $now);
        ?>
        <p>Uptime : <br> <span><?= $uptime->format('%d jour(s), %h heure(s) et %i minute(s).') ?></span><br>
    </div>
</div>