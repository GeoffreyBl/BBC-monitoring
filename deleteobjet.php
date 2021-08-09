<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$id = $_GET['id'];
$req = $db->prepare("DELETE FROM `objet` where id = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
header("Location:objets.php");
