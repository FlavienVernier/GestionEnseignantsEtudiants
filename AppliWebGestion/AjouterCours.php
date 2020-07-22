<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>AjoutEnseignant</title>
    </head>

    <body>
    <?php
    require_once('Config.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    


    $bdd->query('INSERT INTO '.$bdName.'.cours (type,datecours,duree) VALUES ('.'"'.$_POST['type'].'"'.','.'"'.$_POST['Date'].'"'.','."'".(float)$_POST['heure']."'".')');
    echo("Le cours a bien été ajouté à la base de données");
    ?>
    </body>
</html>