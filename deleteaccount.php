<?php include "navbar.php"; 
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$id = $_GET['id'];
$req = $db->prepare("DELETE FROM `user` WHERE id=:id");
$req->bindParam(':id', $id, PDO::PARAM_INT);
$req->execute();
if(!$_SESSION['admin']){
    session_destroy();
} else if ($_SESSION['admin'] && $id == $_SESSION['id']){
    session_destroy();
}
header('Location:index.php');