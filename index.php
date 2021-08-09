<?php include "navbar.php";
if (!$_SESSION['login']) {
    header("Location:login.php");
}
?>
<div class="nav">
    <?php
    $user_id = $_SESSION['id'];
    $req = $db->prepare("SELECT * FROM `user_view` WHERE user_id=:user_id");
    $req->bindValue('user_id', $user_id, PDO::PARAM_INT);
    $req->execute();
    $access = $req->fetchAll();
    $req = $db->prepare("SELECT * FROM `view`");
    $req->execute();
    $views = $req->fetchAll();
    $tab = [];
    foreach ($access as $value) {
        $tab[] = $value['view_id'];
    }
    foreach ($views as $view) {
        foreach ($tab as $view_id) {
            if ($view_id == $view['id']) {
                include "./menubutton/" . $view['link'];
            }
        }
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>