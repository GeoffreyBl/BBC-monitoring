<?php
include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$id = $_GET['id'];
$req = $db->prepare("SELECT * FROM `caracteristiques` WHERE id_objet=:id");
$req->bindValue('id', $id, PDO::PARAM_INT);
$req->execute();
$carac = $req->fetchAll();
$req = $db->prepare("SELECT * FROM `objet` where id = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$objet = $req->fetch();
if (!$objet){
    header("Location:objets.php");
}
?>

<div class='container'>
    <h2><a href="./objets.php"><i class=" fas fa-arrow-left"></i></a> <?= $objet['nom']?></h2>
        <?php
        foreach ($carac as $c) {
            if ($c['type_mesure'] == "Service") { ?>
                <p>
                    Service : <?= $c['nom'] ?>
                    <a href="addcarac.php?id=<?= $c['id'] ?>"> <i class="far fa-edit"></i></a>
                    <a href="deletecarac.php?id=<?= $c['id'] ?>"><i class="far  fa-trash-alt"></i></a>
                </p>
            <?php
            }
        }
        foreach ($carac as $c) {
            if ($c['type_mesure'] == "Pourcentage") { ?>
                <p>Chemin : <?= $c['nom'] ?> <br>Seuil de <?= $c['seuil'] ?>% de remplissage.
                    <a href="addcarac.php?id=<?= $c['id'] ?>"> <i class="far fa-edit"></i></a>
                    <a href="deletecarac.php?id=<?= $c['id'] ?>"><i class="far  fa-trash-alt"></i></a>
                </p>
            <?php
            }
        }
        foreach ($carac as $c) {
            if ($c['type_mesure'] == "Millisecondes") { ?>
                <p><?= $c['nom'] ?> <br>Seuil de <?= $c['seuil'] ?> millisecondes.
                    <a href="addcarac.php?id=<?= $c['id'] ?>"> <i class="far fa-edit"></i></a>
                    <a href="deletecarac.php?id=<?= $c['id'] ?>"><i class="far  fa-trash-alt"></i></a>
                </p>
        <?php
            }       
        }  
?> 
<p><a style="text-decoration:underline;" href="addcarac.php?idobjet=<?=$objet['id']?>">Ajouter une caracteristique   <i class="fas fa-arrow-right"></i></a></p>
</div>