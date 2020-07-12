<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>AjoutModule</title>
    </head>

    <body>
    <?php
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$donnees = $_POST;

    //$idenseignant = NULL;
    $idprof = $_POST['idprof'];

    if ($idprof==0)
        $bdd->query('INSERT INTO enseignementpolytech1.module (nom,semestre,heurescm,heurestd,heurestp) VALUES ('.'"'.$_POST['Nom'].'"'.','.'"'.$_POST['semestre'].'"'.','."'".$_POST['heurescm']."'".','.'"'.$_POST['heurestd'].'"'.','.'"'.$_POST['heurestp'].'"'.')');
    else{
        $bdd->query('INSERT INTO enseignementpolytech1.module (nom,semestre,heurescm,heurestd,heurestp,idenseignant) VALUES ('.'"'.$_POST['Nom'].'"'.','.'"'.$_POST['semestre'].'"'.','."'".$_POST['heurescm']."'".','.'"'.$_POST['heurestd'].'"'.','.'"'.$_POST['heurestp'].'"'.','.'"'.$idprof.'"'.')');
    }
    echo("Le module a bien été ajouté à la base de données");
    ?>
    </body>
</html>