<?php

session_start();
$db = new PDO("mysql:host=ns6121283.ip-51-68-68.eu;dbname=monitor;port=3306", "geoffrey", "Wzpass1234!"); // Connexion à la BDD.

$req = $db->query("SELECT max(lastupdate) FROM `log_serveur2`");
$date = $req->fetch();
$maxdate = new DateTime($date[0]); // Obtention de la date/heure de la dernière mise à jour de la table pingboutique
$maxdate->modify("+2 hours");
function check_servers($db)
{
    $req = $db->query("SELECT * FROM `log_serveur2`");
    $ret = [];
    $t = 0;
    foreach ($req as $entry) {
        if (!$entry['valeur']) {
            $ret[] = $entry['nom'];
        } else if ((100 - intval($entry['valeur'])) > $entry['seuil'] && $entry['seuil']) { // Gestion d'une valeur plus haute que le seuil
            $ret[] = $entry['nom'];
        } else if ($entry['type_mesure'] == "Service" && $entry['valeur'] != "OK") {
            $ret[] = $entry['nom'];
        }
    }
    return $ret;
}
function cutlogin($str)
{
    for ($i = 0; $i != strlen($str) - 1; $i++) {
        if ($str[$i] == "@") {
            return substr($str, 0, $i);
        }
    }
    return $str;
}
?>
<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bigben</title>
</head>

<body>
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <a href="./index.php" class="logo flex">
                <i class="fas fa-home"></i>
            </a>
            <a href="./index.php" class="bannerdiv flex flex-column">
                <img src="./Bigben-interactive-logo-1864x1123_neu-1864x1123.jpg" alt="banniere" class="banner">
                <br>
                <p class="lastUpdate">Dernière MAJ : <?= $maxdate->format('H:i') ?></p>
            </a>
            <?php if (key_exists('login', $_SESSION)) {
                if ($_SESSION['admin']) {
            ?><a class="logo flex admin" href="./admin.php"><i class="fas fa-cogs"></i></a>
            <?php }
            } ?>
            <a href="./profil.php" class="flex logo profil"><i class="fas fa-user-circle"></i><?= key_exists('login', $_SESSION) ? cutlogin($_SESSION['login']) : ""; ?></a>
        </div>
    </header>
    <script src="./script.js"></script>