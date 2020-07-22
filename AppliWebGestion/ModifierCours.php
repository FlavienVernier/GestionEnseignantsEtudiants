<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>ModifierUnCours</title>
    </head>

    <body>
        <h1>Cours à Modifier</h1>
        <h4>Rappel : seul les cours incomplets sont affichés
        <br/>

        
    <?php
    require_once('Config.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //MODIFICATION ICI, avant de réafficher tous les cours incomplets

    $idprofA = $bdd->query('SELECT idenseignant FROM enseignementpolytech1.enseignant WHERE (nom = "'.$_POST['nomenseignant'].'")');
    $idprof2A = $idprofA->fetchAll();
    $idmoduleA = $bdd->query('SELECT idmodule FROM enseignementpolytech1.module WHERE (nom = "'.$_POST['nommodule'].'")');
    $idmodule2A = $idmoduleA->fetchAll();
    
    $idduprofA = $idprof2A[0]['idenseignant'];
    $iddumoduleA = $idmodule2A[0]['idmodule'];

    $bdd->query('UPDATE enseignementpolytech1.cours SET idmodule = '.$iddumoduleA.', idenseignant = '.$idduprofA.' WHERE enseignementpolytech1.cours.idcours = '.$_POST['idcours'].'');


    // FIN DE MODIFICATION ICI

//REMARQUE : Un champ de caractère laissé vide est transformé comme un caractère "/" dans le $_POST : ajout de cette spécificité ici 

    if ($_POST['filiere']=='NULL' AND $_POST['Date']!='/'){
        $datacoursincomplets = $bdd->query('SELECT idcours, type, datecours, duree, idmodule, idenseignant FROM enseignementpolytech1.cours WHERE (datecours LIKE "'.$_POST['Date'].'%'.'") and ( (idmodule IS NULL) OR (idenseignant IS NULL) )');
        $coursincomplets = $datacoursincomplets->fetchall();
        //print_r($coursincomplets);
        //var_dump($coursincomplets);
    }
    if ($_POST['filiere']=='NULL' AND $_POST['Date']=='/'){
        $datacoursincomplets = $bdd->query('SELECT idcours, type, datecours, duree, idmodule, idenseignant FROM enseignementpolytech1.cours WHERE (idmodule IS NULL) OR (idenseignant IS NULL)');
        $coursincomplets = $datacoursincomplets->fetchall();
        //print_r($coursincomplets);
        //var_dump($coursincomplets);
    }

    
    echo('<h5>');
    
    for ($i=0; $i<count($coursincomplets);$i++){
        echo('<form method="post" action="ModifierCours.php">');
        echo('<input type="hidden" name="Date" value='.$_POST['Date'].' />');
        echo('<input type="hidden" name="filiere" value='.$_POST['filiere'].' />');
        echo('<input type="hidden" name="idcours" value='.$coursincomplets[$i]['idcours'].' />');
        $nomdumodule='Non renseigné, ajouter :';
        $nomduprof='Non renseigné, ajouter (nom enseignant):';
        echo('Date et heure : '.$coursincomplets[$i]['datecours'].'');
        if ($coursincomplets[$i]['idmodule'] != NULL){
            $datanommodule = $bdd->query('SELECT nom FROM enseignementpolytech1.module WHERE (idmodule='.$coursincomplets[$i]['idmodule'].')');
            $nommodule= $datanommodule->fetchall();
            $nomdumodule = $nommodule[0]['nom'];
            echo(' | Module : '.$nomdumodule.'');
            echo('<input type="hidden" name="nommodule" value='.$nomdumodule.' />');
        }
        else {
            echo(' | Module : '.$nomdumodule.'');
            echo('<input type="text" name="nommodule" />');
        }
        
        if ($coursincomplets[$i]['idenseignant'] != NULL){
            $datanomprof = $bdd->query('SELECT nom FROM enseignementpolytech1.module WHERE (idmodule='.$coursincomplets[$i]['idmodule'].')');
            $nomprof= $datanomprof->fetchall();
            $nomduprof = $nomprof[0]['idenseignant'];
            echo(' | Enseignant : '.$nomduprof.'');
            echo('<input type="hidden" name="nomenseignant" value='.$nomduprof.' />');
            
        }
        else {
            echo(' | Enseignant : '.$nomduprof.'');
            echo('<input type="text" name="nomenseignant" />');
        }
        echo('<input type="submit" value="Modifier"/>');
        echo('</form>');
        echo('<br/>');
        
        
    }

    echo('</h5>');
    echo('Tous les cours incomplets ont été affichés');
    
    
    ?>
    </h4>
    </body>
</html>