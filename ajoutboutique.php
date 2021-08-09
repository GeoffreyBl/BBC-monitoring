<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = $db->prepare("SELECT * FROM `objet` WHERE id= :id");
    $req->bindValue('id', $id, PDO::PARAM_INT);
    $req->execute();
    $boutique = $req->fetch();
    $boutique_id = $boutique['id'];
    $seuil = $db->query("SELECT seuil FROM caracteristiques WHERE id_objet = $boutique_id");
    $test = $seuil->fetchColumn();
}
if ($_POST && isset($_GET['id'])) {
    $url = $_POST['url'];
    $boutique_id = $boutique['id'];
    $name = $_POST['name'];
    $code_boutique = $_POST['code_boutique'];
    $seuil = intval($_POST['seuil']);
    $req = $db->prepare("UPDATE `objet` SET url=:url, nom=:name, code_boutique=:code_boutique WHERE id=$boutique_id");
    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('url', $url, PDO::PARAM_STR);
    $req->bindValue('code_boutique', $code_boutique, PDO::PARAM_STR);
    $req->execute();
    $boutique_id = $boutique['id'];
    $req = $db->prepare("UPDATE caracteristiques SET seuil=:seuil WHERE id_objet = $boutique_id");
    $req->bindValue('seuil', $seuil, PDO::PARAM_STR);
    $req->execute();
    header('location:objets.php');
}
if ($_POST && isset($_GET['id']) == NULL) {
    $url = $_POST['url'];
    $name = $_POST['name'];
    $code = $_POST['code_boutique'];
    $seuil = $_POST['seuil'];
    $req = $db->prepare("INSERT INTO `objet` (nom, url, type, code_boutique) VALUES (:name, :url, 'boutique', :code)");
    $req->bindValue('name', $name, PDO::PARAM_STR);
    $req->bindValue('url', $url, PDO::PARAM_STR);
    $req->bindValue('code', $code, PDO::PARAM_STR);
    $req->execute();
    $req = $db->prepare("SELECT id from objet where url=:url");
    $req->bindValue('url', $url, PDO::PARAM_STR);
    $req->execute();
    $id = $req->fetch();
    $req = $db->prepare("INSERT INTO `caracteristiques` (id_objet, nom, type_mesure, seuil) VALUES (:id, 'ping', 'Millisecondes', :seuil)");
    $req->bindValue('id', $id['id'], PDO::PARAM_INT);
    $req->bindValue('seuil', $seuil, PDO::PARAM_STR);
    $req->execute();
    header('location:index.php');
}

?>
<div class="container d-flex justify-content-center">
    <form method="post">
        <div class="form-group mt-2">
            <label for="name">Nom de la boutique</label>
            <?php
            if (isset($boutique['nom'])) {
                echo "<input type='text' class='form-control' id='name' name='name' value='" . $boutique['nom'] . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='name' name='name' placeholder='Google' required>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="code">Code de la boutique</label>
            <?php
            if (isset($boutique['code_boutique'])) {
                echo "<input type='text' class='form-control' id='code_boutique' name='code_boutique' value='" . $boutique['code_boutique'] . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='code_boutique' name='code_boutique' placeholder='S186' required>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="url">Son URL</label>
            <?php
            if (isset($boutique['url'])) {
                echo "<input type='text' class='form-control' id='url' name='url' value='" . $boutique['url'] . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='url' name='url' placeholder='http://www.google.fr' required>";
            } ?>
        </div>
        <div class="form-group mt-2">
            <label for="seuil">Seuil ping maximal (ms)</label>
            <?php
            if (isset($seuil)) {
                echo "<input type='text' class='form-control' id='seuil' name='seuil' value='" . $test . "' required>";
            } else {
                echo "<input type='text' class='form-control' id='seuil' name='seuil' placeholder='7000' required>";
            } ?>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
    </form>
</div>