<?php
include 'navbar.php';
if ($_POST) {
    $password = uniqid();
    $message = "Bonjour, voici le mot de passe généré :  $password. Merci de vous connecter avec ce dernierafin de le changer.";
    //ici hash du pwd later
    if (mail($_POST['email'], "Votre nouveau mot de passe", $message)) {
        $email = $_POST['email'];
        $sql = "UPDATE users SET password :pwd WHERE email = :email";
        $req = $db->prepare($sql);
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        // echo "<script>alert('Un email vous a été envoyé avec votre nouveau mot de passe.')</script>";
        header('Location:login.php');
    }
}
?>
<div class="container align-items-center text-center d-flex flex-column">
    <form method="post">
        <div class="form-group">
            <p>Envoi d'un nouveau mot de passe</p>
            <label for="login">Adresse e-mail</label>
            <input type="text" class="form-control inputs" name="email" id="email" aria-describedby="emailHelp" required placeholder="E-mail">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>