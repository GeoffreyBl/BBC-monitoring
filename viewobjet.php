<?php include "navbar.php";
if (!$_SESSION['admin']) {
    header("Location:index.php");
}
$id = $_GET['id'];
$req = $db->prepare("SELECT * FROM `objet` where id = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$objet = $req->fetch();
$req = $db->prepare("SELECT * FROM `carac` where id_objet = :id");
$req->bindValue(':id', $id, PDO::PARAM_INT);
$carac = $req->fetchAll();
?>
<h3><?=$objet['nom']?></h3>
<p>
    Caractéristiques surveillées : 
</p>
<?php
    var_dump($carac);
    foreach ($carac as $c){
        echo $c['nom'] . " Type de mesure : " . $c['type_mesure'] . " Seuil : " . $c['seuil'];
    }