<?php
include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = $db->prepare("SELECT * FROM `objet` WHERE id= :id");
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $serveur = $req->fetch();
}
if ($_POST && isset($_GET['id'])) {
    $url = $_POST['url'];
    $name = $_POST['name'];
    $fournisseur = $_POST['fournisseur'];
    $ip = $_POST['ip'];
    $os = $_POST['os'];
    $id = $_GET['id'];
    $req = $db->prepare("UPDATE `objet` set url=:url, nom= :name, ip=:ip, os=:os, fournisseur=:fournisseur WHERE id=:id");
    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('url', $url, PDO::PARAM_STR);
    $req->bindValue('ip', $ip, PDO::PARAM_STR);
    $req->bindValue('os', $os, PDO::PARAM_STR);
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->bindValue('fournisseur', $fournisseur, PDO::PARAM_STR);
    $req->execute();
    header('location:objets.php');
}
if ($_POST && isset($_GET['id']) == NULL) {
    $url = $_POST['url'];
    $name = $_POST['name'];
    $fournisseur = $_POST['fournisseur'];
    $ip = $_POST['ip'];
    $os = $_POST['os'];
    $req = $db->prepare("INSERT INTO `objet` (nom, ip, url, type, fournisseur, os) VALUES (:name, :ip, :url, 'serveur', :fournisseur, :os)");
    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('url', $url, PDO::PARAM_STR);
    $req->bindValue('ip', $ip, PDO::PARAM_STR);
    $req->bindValue('os', $os, PDO::PARAM_STR);
    $req->bindValue('fournisseur', $fournisseur, PDO::PARAM_STR);
    $req->execute();
    header('location:objets.php');
}

?>
<div class="container d-flex justify-content-center">
    <form method="post">
        <div class="form-group mt-2">
            <label for="name">Nom du serveur</label>
            <?php
            if (isset($serveur['nom'])) {
                echo "<input type='text' class='form-control' id='name' name='name' value='" . $serveur['nom'] . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='name' name='name' placeholder='ns010101' required>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="ip">IP</label>
            <?php
            if (isset($serveur['ip'])) {
                echo "<input type='text' class='form-control' id='ip' name='ip' value='" . $serveur['ip'] . "'>";
            } else {
                echo "<input type='text' class='form-control' id='ip' name='ip' placeholder='127.0.0.1'>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="url">URL</label>
            <?php
            if (isset($serveur['url'])) {
                echo "<input type='text' class='form-control' id='url' name='url' value='" . $serveur['url'] . "'>";
            } else {
                echo "<input type='text' class='form-control' id='url' name='url' placeholder='http://www.google.fr'required>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="fournisseur">Fournisseur</label>
            <?php
            if (isset($serveur['fournisseur'])) {
                echo "<input type='text' class='form-control' id='fournisseur' name='fournisseur' value='" . $serveur['fournisseur'] . "'>";
            } else {
                echo "<input type='text' class='form-control' id='fournisseur' name='fournisseur'>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="os">OS</label>
            <?php
            if (isset($serveur['fournisseur'])) {
                echo "<input type='text' class='form-control' id='os' name='os' value='" . $serveur['os'] . "'>";
            } else {
                echo "<input type='text' class='form-control' id='os' name='os'>";
            } ?>
        </div>
        <button type="submit" class="btn btn-primary mt-2"><?= isset($_GET['id']) ? "Modifier" : "Ajouter" ?></button>
    </form>
</div>