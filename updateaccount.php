<?php include "navbar.php";
$id = $_GET['id'];
$req = $db->prepare("SELECT * FROM `user` WHERE id=:id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$user = $req->fetch();
if (!$user || $_SESSION['admin'] == 0) { //Vérification de la présence du compte dans la BDD et du status admin de l'utilisateur
    header("Location:index.php");
}
?>
<div class="container align-items-center d-flex flex-column">
    <h2><?= $user['login'] ?></h2>
    <a class="colonne mt-2" href="./passwordchange.php?id=<?= $user['id'] ?>">Modifier mot de passe</a>
    <a class="colonne mt-2" href="./listaccess.php?id=<?= $user['id'] ?>">Changer accès</a>
</div>