<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>AjoutEnseignant</title>
    </head>

    <body>
    <?php
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$donnees = $_POST;
    


    $bdd->query('INSERT INTO enseignementpolytech1.enseignant (nom,prenom,type,service,heuresup) VALUES ('.'"'.$_POST['Nom'].'"'.','.'"'.$_POST['Prenom'].'"'.','."'".$_POST['type']."'".','.'"'.$_POST['service'].'"'.','.'"'.$_POST['heuresupp'].'"'.')');
    echo("L'enseignant a bien été ajouté à la base de données");
    ?>
    </body>
</html>