<?php
include "navbar.php";
$userexists = $db->query("SELECT * FROM `user`");
$usercount = 0;
foreach ($userexists as $user) {
    ++$usercount;
}
if ($usercount == 0) {
    header("Location:rootsetup.php");
} else if (key_exists("login", $_SESSION)) {
    header("Location:index.php");
}
if ($_POST && key_exists("login", $_POST) && key_exists("password", $_POST)) {
    $login = $_POST['login'];
    $req = $db->prepare("SELECT * FROM `user` WHERE login=:login");
    $req->bindValue(':login', $login, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();
    if ($user && $user['password'] == $_POST['password']) { // Si l'utilisateur est trouvé en BDD et que les pwd correspondent, alors lancement des params en $_SESSION et redirect
        $_SESSION['login'] = $user['login'];
        $_SESSION['admin'] = $user['isAdmin'];
        $_SESSION['id'] = $user['id'];
        header('Location:index.php');
    } else {
        echo "<p class='softred p-2 text-center'>Login ou mot de passe incorrect.</p>";
    }
}
// mail("gblairvacq@bigben-connected.com", "test", "message");
?>
<div class="container align-items-center text-center d-flex flex-column">
    <form method="POST">
        <div class="form-group">
            <label for="login">Adresse e-mail</label>
            <input type="text" class="form-control inputs" name="login" id="login" aria-describedby="emailHelp" required placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control inputs" id="password" name="password" placeholder="Mot de passe" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
    <a href="sendnewpassword.php" class="text-primary mt-2">Mot de passe oublié ?</a>
    <br>
</div>