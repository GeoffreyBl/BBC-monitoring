<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$id = $_GET['id'];
$req = $db->prepare("SELECT * FROM `caracteristiques` where id = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$carac = $req->fetch();
$req = $db->prepare("DELETE FROM `caracteristiques` where id = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
header("location:readobjets.php?id=" . $carac['id_objet'] . ".php");
