<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>AjoutEnseignant</title>
    </head>

    <body>
    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    


    $bdd->query('INSERT INTO enseignementpolytech1.cours (type,datecours,heure) VALUES ('.'"'.$_POST['type'].'"'.','.'"'.$_POST['Date'].'"'.','."'".(float)$_POST['heure']."'".')');
    echo("Le cours a bien été ajouté à la base de données");
    ?>
    </body>
</html>