<?php include "navbar.php";
if (!$_GET['id']) {
    header('location:index.php');
} else if ($_SESSION['id'] == $_GET['id']){
    header('passwordchangeuser.php');
} else if ($_SESSION['admin'] == 0 && $_SESSION['id'] != $_GET['id']) {
    header('location:index.php');
}
if ($_POST && $_GET['id']) {
    if ($_POST['newpassword'] != $_POST['newpassword2']) {
        echo "<p class='softred p-2 text-center'>Les mots de passe ne correspondent pas.</p>";
    } else {
        $id = $_GET['id'];
        $password = $_POST['newpassword'];
        $req = $db->prepare("UPDATE `user` SET password=:password WHERE id=:id");
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        header("Location:admin.php");
    }
}

?>
<div class="form-group text-center">
    <form method="POST" class="">
        <div class="form-group">
            <span>Nouveau mot de passe</span>
            <input type="password" name="newpassword" required>
        </div>
        <div class="form-group">
            <span> Confirmez nouveau mot de passe </span>
            <input type="password" name="newpassword2" required>
        </div>
        <button type="submit" class="btn mt-2 btn-primary">Modifier</button>
    </form>
</div>