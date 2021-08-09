<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$objets = $db->query("SELECT * FROM `objet`");
?>
<div class="container d-flex justify-content-center">
    <div class="colonne web">
        <?php
        foreach ($objets as $objet) {
            if ($objet['type'] == 'serveur') {
        ?><p> <a href="readobjets.php?id=<?= $objet['id']; ?>"><?= $objet['nom'] . " (" . $objet['type'] . ") " ?></a> <a href="addserver.php?id=<?= $objet['id'] ?>"> <i class="far fa-edit"></i></a><a href="deleteobjet.php?id=<?= $objet['id'] ?>"><i class="far fa-trash-alt"></i></a></p>
            <?php
            }
        }
        $objets = $db->query("SELECT * FROM `objet`");
        foreach ($objets as $objet) {
            if ($objet['type'] == 'boutique') {
            ?><p><a href="readobjets.php?id=<?= $objet['id']; ?>"><?= $objet['nom'] . " (" . $objet['type'] . ") " ?></a><a href="ajoutboutique.php?id=<?= $objet['id'] ?>"> <i class="far fa-edit"></i></a><a href="deleteobjet.php?id=<?= $objet['id'] ?>"><i class="far fa-trash-alt"></i></a></p>
        <?php
            }
        }
        ?>
    </div>
</div>