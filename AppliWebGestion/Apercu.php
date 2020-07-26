<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Impression feuille d'absence</title>
    </head>

    <body>
        <h1>Liste des cours à imprimer</h1>
        <h4>Vérifiez si les cours correspondent bien à ceux de la journée, puis cliquez sur "Imprimer"
        <br/>

        
    <?php
    require_once('Config.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $lesmois=['','Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];

    $anneecourante = (int)date('Y');
    $moiscourrant = (int)date('m');
    if ($moiscourrant >7){
        $anneecourante = $anneecourante + 1;
    }

    $promo = $anneecourante + 5 - $_POST['annee'];
    //print_r($promo);

    $dataidetudiant = $bdd->query('SELECT MIN(idetudiant) FROM '.$bdName.'.etudiant WHERE (filiere="'.$_POST['filiere'].'" and promo='.$promo.')');
    $idetudiant = $dataidetudiant->fetchall();

    $dataidcours = $bdd->query('SELECT idcours FROM '.$bdName.'.presence WHERE (idetudiant='.$idetudiant[0]['MIN(idetudiant)'].')');
    $idcours = $dataidcours->fetchall();

    //print_r($idetudiant[0]['MIN(idetudiant)']);      
    //substr($_POST['Date'],0,2)
    echo('<h5>');
    echo('Jour : '.substr($_POST['Date'],8,2).' '.$lesmois[(int)substr($_POST['Date'],5,2)].' '.substr($_POST['Date'],0,4));
    echo(' | Classe : '.$_POST['filiere'].' '.$_POST['annee']);
    echo('<br/>');
    echo('<form method="post" action="Impression.php">');
    $ncours=0;
    for ($i=0; $i<count($idcours);$i++){
        $datalecours = $bdd->query('SELECT type, datecours, duree, idmodule, idenseignant FROM '.$bdName.'.cours WHERE (idcours='.$idcours[$i]['idcours'].') and (datecours LIKE "'.$_POST['Date'].'%'.'")');
        $lecours = $datalecours->fetchall();
        
        if (count($lecours)!=0){
            $ncours+=1;
            $nomdumodule='Non renseigné';
            $nomduprof='Non renseigné:';
            $duration = $lecours[0]['duree']*60;
            $durationheure = intdiv($duration,60);
            $durationminutes = $duration%60;
            $finminute = $durationminutes + (int)substr($lecours[0]['datecours'],14,2);
            if ($finminute >=60){
                $finminute = $finminute-60;
                $durationheure = $durationheure + 1;
            }
            $heurefin = (int)substr($lecours[0]['datecours'],11,2) + $durationheure;
            echo(''.substr($lecours[0]['datecours'],11,2).'h'.substr($lecours[0]['datecours'],14,2).' - '.$heurefin.'h'.$finminute.'');
            if ($lecours[0]['idmodule'] != NULL){
                $datanommodule = $bdd->query('SELECT nom FROM '.$bdName.'.module WHERE (idmodule='.$lecours[0]['idmodule'].')');
                $nommodule= $datanommodule->fetchall();
                $nomdumodule = $nommodule[0]['nom'];
            }
            echo(' | Module : '.$nomdumodule.'');
        
            if ($lecours[0]['idenseignant'] != NULL){
                $datanomprof = $bdd->query('SELECT nom FROM '.$bdName.'.enseignant WHERE (idenseignant='.$lecours[0]['idenseignant'].')');
                $nomprof= $datanomprof->fetchall();
                $nomduprof = $nomprof[0]['nom'];    
            }
            echo(' | Enseignant : '.$nomduprof.'');
            echo('<br/>');
            echo('<input type="hidden" name='.'type'.$ncours.' value=n />');
            echo('<input type="hidden" name='.'module'.$ncours.' value=n />');
            echo('<input type="hidden" name='.'enseignant'.$ncours.' value=n />');
            echo('<input type="hidden" name='.'heure'.$ncours.' value=n />');

        }
        
    }
    echo('<input type="hidden" name=ncours value='.$ncours.' />');
    
    echo('</h5>');
    echo('Tous les cours pour la fiche absence ont été affichés ');
    echo('<input type="submit" value="Imprimer"/>');
    echo('</form>');
    
    
    ?>
    </h4>
    </body>
</html>