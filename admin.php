<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
?>
<h3 class="titleadmin">Création et modification de comptes</h3>
<div class="container">
    <a class="btn m-1 btn-primary" href="objets.php">Objets</a>
    <a class="btn m-1 btn-primary" href="inscription.php">Créer un compte</a>
    <table>
        <p class="mt-2">Modifier un compte : </p>
        <?php
        $users = $db->query("SELECT * FROM `user`");
        foreach ($users as $user) {
        ?>
            <tr>
                <td>- <a class="text-primary" href="./updateaccount.php?id=<?= $user['id'] ?>"><?= $user['login'] ?></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>