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

            $dataetudiants = $bdd->query('SELECT idetudiant, nom, prenom FROM '.$bdName.'.etudiant WHERE (filiere = '.'"'.$_POST['filiere'].'"'.' AND promo = '.$_POST['promo'].')');
            $etudiants = $dataetudiants->fetchAll();

            print_r($_POST);
            for ($i=0;$i<count($_POST);$i++){
                if ($_POST[$i]==1){
                    echo('Je passe par la');

                }
            }
            echo('La présence des étudiants à bien été mise a jour sur le serveur');
            ?>
    		
    	</p>
    </body>
</html>