<?php include "navbar.php";
if(!$_SESSION['login']){
    header('Location:login.php');
} ?>
<div class="container align-items-center d-flex flex-column">
    <h1>Mon profil</h1>
    <p>Vous êtes connecté en tant que : </p>
    <span class="usernametitle"><?= $_SESSION['login'] ?></span>
    <a class="colonne" href="./passwordchangeuser.php?id=<?= $_SESSION['id'] ?>">Modifier mon mot de passe</a>
    <a class="colonne" href="disconnect.php">Se déconnecter</a>
    <br><br>
    <a class="colonne text-danger" href="./deleteaccount.php?id=<?=$_SESSION['id'] ?>">Supprimer compte</a>
</div>
