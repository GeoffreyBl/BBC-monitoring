<?php
include "navbar.php";
$userexists = $db->query("SELECT * FROM `user`");
if ($userexists) {
    header('Location:login.php');
}
if ($_POST) {
    if (strlen($_POST['password']) > 1) {
        $password = $_POST['password'];
        $req = $db->prepare("INSERT INTO `user` (login, password, isAdmin) VALUES ('root', :password, 1)");
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->execute();
        header("Location:login.php");
    }
}
?>
<form class="text-center" method="POST">
    <div class="form-group">
        <p>Première connexion détéctée. Merci de saisir le mot de passe de l'utilisateur ROOT</p>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control inputs" id="password" name="password" required>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>