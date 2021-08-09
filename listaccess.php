<?php 
include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$views = $db->query("SELECT * FROM `view`");
if($_POST){
    $user_id = $_GET['id'];
    $req = $db->prepare("DELETE FROM user_view WHERE user_id=:id");
    $req->bindValue('id', $user_id, PDO::PARAM_INT);
    $req->execute();
    $ids = [];
    foreach($_POST as $test => $data){
        $ids[] = $test;
    }
    foreach($ids as $id){
        $db->query("INSERT INTO user_view (`user_id`, `view_id`) VALUES ($user_id, $id)");
    }
    header("Location:./admin.php");
}

?>
<form method='post'>
    <div class="container">
        <?php foreach($views as $view) { ?>
            <div class="container">
                <tr>
                    <td><input type="checkbox" name="<?=$view['id'] ?>" id=""> <?=$view['name'] ?> </td>
                </tr>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary">Changer accès</button>
    </form>
</div>