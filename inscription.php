<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
if ($_POST && $_POST['password'] != $_POST['password2']) {
    echo "<p class='softred p-2 text-center'>Merci de saisir des mots de passe identiques.</p>";
}
if ($_POST && key_exists("login", $_POST) && key_exists("password", $_POST) && $_POST['password'] == $_POST['password2']) {
    //Vérification d'un eventuel doublon dans la BDD
    $login = $_POST['login'];
    $req = $db->prepare("SELECT * FROM `user` WHERE login=:login");
    $req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();
    if ($user) {
        echo "Login déjà utilisé.";
    } else { //Insertion du compte en BDD si le login n'est pas déjà connu
        $login = $_POST['login'];
        $password = $_POST['password'];
        $req = $db->prepare("INSERT INTO `user` (login, password, isAdmin) VALUES(:login, :password, 0)");
        $req->bindValue(':login', $login, PDO::PARAM_STR);
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->execute();
        header("Location:admin.php");
    }
}
?>

<div class="container align-items-center d-flex flex-column">
    <h1>Inscription</h1>
    <form class="text-center" method="POST">
        <div class="form-group">
            <label for="login">Adresse e-mail</label>
            <input type="email" class="form-control inputs" name="login" id="login" aria-describedby="emailHelp" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control inputs" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Confirmer le mot de passe</label>
            <input type="password" class="form-control inputs" id="password2" name="password2" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
    <br>
</div>