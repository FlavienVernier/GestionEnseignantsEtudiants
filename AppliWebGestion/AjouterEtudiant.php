<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>AjoutEtudiant</title>
    </head>

    <body>
    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    

    
    


    $bdd->query('INSERT INTO enseignementpolytech1.etudiant (nom,prenom,promo,filiere,groupetd,groupetp) VALUES ('.'"'.$_POST['Nom'].'"'.','.'"'.$_POST['Prenom'].'"'.','."'".$_POST['promotion']."'".','.'"'.$_POST['filiere'].'"'.','.'"'.$_POST['groupetd'].'"'.','.'"'.$_POST['groupetp'].'"'.')');



    $datasameetudiant = $bdd->query('SELECT MIN(idetudiant) FROM enseignementpolytech1.etudiant WHERE (promo='.$_POST['promotion'].' AND filiere='."'".$_POST['filiere']."'".' AND groupetd='."'".$_POST['groupetd']."'".' AND groupetp='."'".$_POST['groupetp']."'".')');
    $sameetudiant = $datasameetudiant->fetchall();
    

    $datadernieridetudiant = $bdd->query('SELECT MAX(idetudiant) FROM enseignementpolytech1.etudiant');
    $dernieridetudiant = $datadernieridetudiant->fetchAll();
    


    $datasamecours = $bdd->query('SELECT idcours FROM enseignementpolytech1.presence WHERE (idetudiant='.$sameetudiant[0]['MIN(idetudiant)'].')');
    $samecours = $datasamecours->fetchall();
    

    for($i=0; $i<count($samecours);$i++){
        $bdd->query('INSERT INTO enseignementpolytech1.presence (idetudiant,idcours) VALUES ('.$dernieridetudiant[0]['MAX(idetudiant)'].','.$samecours[$i]['idcours'].')');
    }

    echo("L'étudiant a bien été ajouté à la base de données");
    ?>
    </body>
</html>