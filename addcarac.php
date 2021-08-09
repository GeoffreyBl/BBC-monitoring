<?php
include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $req = $db->prepare("SELECT * FROM `caracteristiques` WHERE id= :id");
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $carac = $req->fetch();
    $id_objet = $carac['id_objet'];
    $req = $db->prepare("SELECT * FROM `objet` WHERE id= :id");
    $req->bindValue('id', $id_objet, PDO::PARAM_INT);
    $req->execute();
    $objet = $req->fetch();
} else if (isset($_GET['idobjet'])){
    $id=$_GET['idobjet'];
    $req = $db->prepare("SELECT * FROM `objet` WHERE id= :id");
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $objet = $req->fetch();
}
if ($_POST && isset($_GET['id'])) {
    $id_objet = $_POST['id_objet'];
    $nom = $_POST['nom'];
    $type_mesure = $_POST['type_mesure'];
    $seuil = $_POST['seuil'];
    $req = $db->prepare("UPDATE `caracteristiques` set id_objet=:id_objet, nom= :nom, type_mesure=:type_mesure, seuil=:seuil WHERE id=:id");
    $req->bindValue('id_objet', $id_objet, PDO::PARAM_INT);
    $req->bindValue('nom', $nom, PDO::PARAM_STR);
    $req->bindValue('type_mesure', $type_mesure, PDO::PARAM_STR);
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->bindValue('seuil', $seuil, PDO::PARAM_INT);
    $req->execute();
    header("location:readobjets.php?id=" . $objet['id'] . ".php");
} else if ($_POST && isset($_GET['idobjet'])) {
    $id_objet = $_POST['id_objet'];
    $nom = $_POST['nom'];
    $type_mesure = $_POST['type_mesure'];
    $seuil = $_POST['seuil'];
    $req = $db->prepare("INSERT INTO `caracteristiques` (id_objet, nom, type_mesure, seuil) VALUES (:id_objet, :nom, :type_mesure, :seuil)");
    $req->bindValue('id_objet', $id_objet, PDO::PARAM_INT);
    $req->bindValue('nom', $nom, PDO::PARAM_STR);
    $req->bindValue('type_mesure', $type_mesure, PDO::PARAM_STR);
    $req->bindValue('seuil', $seuil, PDO::PARAM_INT);
    $req->execute();
    header("location:readobjets.php?id=" . $objet['id'] . ".php");
}
?>
<div class="container d-flex justify-content-center">
    <form method="post">
    <div class="form-group mt-2">
        <label for="id_objet">Objet</label>
        <select class="form-control"  name="id_objet">
            <?= "<option value=" . $objet['id'] . ">" . $objet['nom'] . "</option>"; ?>
        </select>
    </div>
        <div class="form-group mt-2">
            <label for="nom">Nom de la caractéristique*</label>
            <?php 
            if (isset($_GET['id'])){
                echo "<input type='text' class='form-control' id='nom' name='nom' value='" . $carac['nom'] . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='nom' name='nom' required>";
            }?>
        </div>
        <div class="form-group mt-2">
            <label for="type_mesure">Type de caracteristique</label>
            <select class="form-control" name="type_mesure" id="type_mesure">

                <?php 
                    if (isset($_GET['id'])){
                        echo "<option value=" . $carac['type_mesure'] . ">" . $carac['type_mesure'] . "</option>";
                    } else {?>
                        <option value="Service">Service</option>
                        <option value="Pourcentage">Espace disque</option>
                        <option value="Millisecondes">Ping</option>
                    <?php }?>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="seuil">Seuil</label>
            <?php if(isset($_GET['id']) && $carac['seuil']){
                echo "<input type='text' class='form-control' value=" . $carac['seuil'] . " id='seuil' name='seuil'>";
            } else {
                echo "<input type='text' class='form-control' id='seuil' name='seuil'>";
            }?>
        </div>
        <button type="submit" class="btn btn-primary mt-2"><?= isset($_GET['id']) ? "Modifier" : "Ajouter" ?></button>
        <p>* Attention le nom de la caractéristique doit correspondre exactement à l'entrée dans le log.</p>
    </form>
</div>