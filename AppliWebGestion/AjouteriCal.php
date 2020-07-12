<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieCours</title>
    </head>

    <body>
    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $datafiliere = $bdd->query('SELECT DISTINCT filiere FROM enseignementpolytech1.etudiant ');
    $dataprof = $bdd->query('SELECT * FROM enseignementpolytech1.enseignant ');
    $Listefiliere = $datafiliere->fetchAll();
    $ListeEnseignants = $dataprof->fetchAll();

    //print_r($ListeEnseignants);

    $root = $_SERVER['DOCUMENT_ROOT'];

    require($root.'/AppliWebGestion/iCalEasyReader.php');

    $ical = new iCalEasyReader();
    $lines = $ical->load(file_get_contents($_FILES["userfile"]["tmp_name"]));
    //var_dump($lines);
    //print_r($lines);

    //Les éléments importants à reprendre dans le fichier iCal se trouvent aux endroits suivants :

    //print_r($lines['VEVENT'][0]['DTSTART']);
    //echo('<br/>');
    //print_r($lines['VEVENT'][0]['SUMMARY']);
    //echo('<br/>');
    //print_r($lines['VEVENT'][0]['DESCRIPTION']);
    //echo('<br/>');

    

    //$format = "d/m/Y H:i:s";
    //$date = DateTime::createFromFormat($format, $external);
    //PAROUCRIR CHAQUE COURS DU FICHIER ICAL
    for ($i = 0; $i < count($lines['VEVENT']); $i++){
        $StringDateStart = $lines['VEVENT'][$i]['DTSTART'];
        $StringLeCours = $lines['VEVENT'][$i]['SUMMARY'];
        $StringClasseProf = $lines['VEVENT'][$i]['DESCRIPTION'];


        //$date = DateTime::createFromFormat($format, substr($lines['VEVENT'][$i]['DTSTART'], 6, 2).'/'.substr($lines['VEVENT'][$i]['DTSTART'], 4, 2).'/'.substr($lines['VEVENT'][$i]['DTSTART'], 0, 4).' '.substr($lines['VEVENT'][$i]['DTSTART'], 9, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 11, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 13, 2));
        $date= substr($lines['VEVENT'][$i]['DTSTART'], 0, 4).'-'.substr($lines['VEVENT'][$i]['DTSTART'], 4, 2).'-'.substr($lines['VEVENT'][$i]['DTSTART'], 6, 2).' '.substr($lines['VEVENT'][$i]['DTSTART'], 9, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 11, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 13, 2);


        //print_r($date);

        $heuredebut = (int)substr($lines['VEVENT'][$i]['DTSTART'], 9, 2);
        $mindebut = (int)substr($lines['VEVENT'][$i]['DTSTART'], 11, 2);

        $heurefin = (int)substr($lines['VEVENT'][$i]['DTEND'], 9, 2);
        $minfin = (int)substr($lines['VEVENT'][$i]['DTEND'], 11, 2);

        $dureeh=$heurefin-$heuredebut;
        $dureem=$minfin-$mindebut;
        

        


        $dureecours =$dureeh + $dureem/60;
        //print_r($dureecours);
        //echo('<br/>');
        $parcoureur='';
        $annee='';
        $l = 0;
        $j = 0;
        $filiere = '';
        $nomprof = '';
        $prenomprof = '';
        //PARCOURIR LE STRING CLASSE PROF
        for($l; $l < strlen($StringClasseProf); $l++){
            if($parcoureur == 'TPA' or $parcoureur=='TPB'){//ATTENTION, si certain string apparaissent juste avant le nom d'un enseignant, ajouter l'exception ici.
                $parcoureur='';
            }
            if($StringClasseProf[$l]=='1' or $StringClasseProf[$l]=='2' or $StringClasseProf[$l]=='3' or $StringClasseProf[$l]=='4' or $StringClasseProf[$l]=='5'){
                continue;
            }
            if($StringClasseProf[$l]!=' ' and $StringClasseProf[$l]!='-' and $StringClasseProf[$l]!='(' and $StringClasseProf[$l]!="\n"){
                $parcoureur.=$StringClasseProf[$l];
                //print_r($parcoureur);
                //echo('<br/>');
            }

            if($StringClasseProf[$l]=='-'){
                if($StringClasseProf[$l+1]=='S')
                    continue;
                $annee=$StringClasseProf[$l+1];
                //print_r($parcoureur);
                //echo('<br/>');
                //print_r($annee);
                //echo('<br/>');
                for ($j = 0; $j < count($Listefiliere); $j++){
                    if ($parcoureur==$Listefiliere[$j]['filiere']){
                        $filiere = $parcoureur;
                        //print_r($filiere);
                        //echo('<br/>');
                    }
                $parcoureur='';
                //print_r($parcoureur);
                }
            }
            if($StringClasseProf[$l]==' '){
                //print_r($parcoureur);
                //echo('<br/>');
                for ($j = 0; $j < count($ListeEnseignants); $j++){
                    if (strtoupper($parcoureur)==strtoupper($ListeEnseignants[$j]['nom'])){
                        $nomprof = $parcoureur;
                        //print_r($nomprof);
                        //echo('<br/>');
                    }
                    if (strtoupper($parcoureur)==strtoupper($ListeEnseignants[$j]['prenom'])){
                        $prenomprof = $parcoureur;
                        //print_r($prenomprof);
                        //echo('<br/>');
                    }
                }
                $parcoureur='';
                
            }
            if ($StringClasseProf[$l]=='('){
                //print_r($parcoureur);
                //echo('<br/>');
                for ($j = 0; $j < count($ListeEnseignants); $j++){
                    if (strtoupper($parcoureur)==strtoupper($ListeEnseignants[$j]['nom'])){
                        $nomprof = $parcoureur;
                        //print_r($nomprof);
                        //echo('<br/>');
                    }
                    if (strtoupper($parcoureur)==strtoupper($ListeEnseignants[$j]['prenom'])){
                        $prenomprof = $parcoureur;
                        //print_r($prenomprof);
                        //echo('<br/>');
                    }

                }
                $parcoureur='';
                break;
            }
        }
        //PARCOURIR LE STRING SUMMARY AVEC LE NOM DU COURS
        $parcoureur='';
        $nomcours='';
        $typecours='CM';//Par défaut, le cours est un CM.
        $l=0;
        for($l; $l<strlen($StringLeCours); $l++){
            if($StringLeCours[$l]!="_"){
                $parcoureur.=$StringLeCours[$l];
            }
            if($StringLeCours[$l]=='_'){
                $nomcours=$parcoureur;
                $parcoureur='';
            }
            if($parcoureur=='CM'){
                $typecours='CM';
                break;
            }
            if($parcoureur=='TD'){
                $typecours='TD';
                break;
            }
            if($parcoureur=='TP'){
                $typecours='TP';
                break;
            }
        }
        //print_r($nomcours);
        //echo('<br/>');
        //print_r($typecours);
        //echo('<br/>');

        $idduprof =0;
        $idmodule =0;
        //print_r($nomprof);
        //print_r($prenomprof);
        $idprof = $bdd->query('SELECT idenseignant FROM enseignementpolytech1.enseignant WHERE (nom = "'.$nomprof.'") and (prenom ="'.$prenomprof.'")');
        $idprof2 = $idprof->fetchAll();

        //print_r($idprof2[0]['idenseignant']);
    
        $idduprof = $idprof2[0]['idenseignant'];
        

        if ($idduprof!=0 and $idmodule!=0)
            $bdd->query('INSERT INTO enseignementpolytech1.cours (type,datecours,heure,idmodule,idenseignant) VALUES ('.'"'.$typecours.'"'.','."'".$date."'".','.$dureecours.','.$idmodule.','.$idduprof.')');
        if ($idmodule!=0 and $idduprof==0)
            $bdd->query('INSERT INTO enseignementpolytech1.cours (type,datecours,heure,idmodule) VALUES ('.'"'.$typecours.'"'.','."'".$date."'".','.$dureecours.','.$idmodule.')');
        if ($idmodule==0 and $idduprof!=0)
            $bdd->query('INSERT INTO enseignementpolytech1.cours (type,datecours,heure,idenseignant) VALUES ('.'"'.$typecours.'"'.','."'".$date."'".','.$dureecours.','.$idduprof.')');
        if ($idmodule==0 and $idduprof==0)
            $bdd->query('INSERT INTO enseignementpolytech1.cours (type,datecours,heure) VALUES ('.'"'.$typecours.'"'.','."'".$date."'".','.$dureecours.')');


    }

    echo("Tous les cours ont bien été ajoutés à la base de données")

    ?>
    </body>
</html>