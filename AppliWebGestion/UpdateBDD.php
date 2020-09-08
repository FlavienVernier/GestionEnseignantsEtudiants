<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>BDD mise a jour</title>
    </head>

    <body>
    	<p>
            <?php
            require_once('Config.php');
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dataetudiants = $bdd->query('SELECT idetudiant FROM '.$bdName.'.etudiant WHERE (filiere = '.'"'.$_POST['filiere'].'"'.' AND promo = '.$_POST['promo'].')');
            $etudiants = $dataetudiants->fetchAll();

            $listedetouslescours=unserialize($_POST['iddescours']);
            //Gestion de tous les étudiants marqués absent sur le formulaire
            foreach($_POST as $k){
                $parcoureur = '';
                $idetu=0;
                $iddescours=array();
                for ($i=0; $i<strlen($k);$i++){
                    if ($k[$i]!=';'){
                        $parcoureur .=$k[$i];
                    }
                    else{
                        if ($idetu==0){
                            $idetu=(int)$parcoureur;
                        }
                        else{
                            array_push($iddescours,$parcoureur);
                        }
                        $parcoureur = '';
                    }
                    
                }
                
                if ($idetu!=0){
                    foreach($iddescours as $c){
                        $bdd->query('UPDATE presence SET presence = "absent" WHERE idetudiant='.$idetu.' and idcours='.$c.' and presence is NULL');
                    } 
                }
              
            }
            
            //Gestion des autres étudiants non marqués absent sur le formulaire, qui sont donc tous présents
            for($i=0;$i<count($etudiants);$i++){
                
                foreach($listedetouslescours as $cc){
                    $bdd->query('UPDATE presence SET presence = "present" WHERE idetudiant='.$etudiants[$i]['idetudiant'].' and idcours='.$cc.' and presence is NULL');
                }
                
                
            }
            
            echo('La présence des étudiants à bien été mise a jour sur le serveur');
            ?>
    		
    	</p>
    </body>
</html>