<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Etudiants absents</title>
    </head>

    <body>
    	<p>
            <h2>Veuillez ne cochez que les élèves absents, puis cliquer sur Valider</h2>
            <h2>L'ordre des cours est le même que sur la fiche d'absence</h2>  
            <?php
            require_once('Config.php');
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            

            $dataetudiants = $bdd->query('SELECT idetudiant, nom, prenom FROM '.$bdName.'.etudiant WHERE (filiere = '.'"'.$_POST['filiere'].'"'.' AND promo = '.$_POST['promo'].')');
            $etudiants = $dataetudiants->fetchAll();

            $iddescours = $_POST['iddescours'];
            $parcoureur = '';
            $arrayID = array();
            for ($i=0; $i<strlen($iddescours);$i++){
                if ($iddescours[$i]!=';'){
                    $parcoureur .=$iddescours[$i];
                }
                else{
                    array_push($arrayID,$parcoureur);
                    $parcoureur = '';
                }
            }

            echo('<form method="post" action="UpdateBDD.php">');
            for ($i = 0; $i < count($etudiants); $i++){
                for($j=0; $j < count($arrayID); $j++){
                    if($j==0){
                        echo(' Absent au cours '.($j+1).'');
                    }
                    else{
                        echo('au cours '.($j+1).'');
                    }
                    echo('<input type="checkbox" name="'.$etudiants[$i]['idetudiant'].';'.$arrayID[$j].'" value="1">');
                }
                echo(' Absent à tous les cours de la journée');
                echo('<input type="checkbox" name="'.$etudiants[$i]['idetudiant'].'" value="1">');
                echo(''.$etudiants[$i]['nom'].' '.$etudiants[$i]['prenom'].'');
                echo('<br/>');    
            }
            echo('<input type="hidden" name="filiere" value='.$_POST['filiere'].' />');
            echo('<input type="hidden" name="promo" value='.$_POST['promo'].' />');
            echo('<h2>');
            echo('<input type="submit" value="Valider"/>');
            echo('</h2>');
            echo('</form>');
            ?>
    		
    	</p>
    </body>
</html>