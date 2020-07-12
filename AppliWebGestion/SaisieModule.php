<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieModule</title>
    </head>

    <body>
    	<h1> Saisie du module à ajouter</h1>
    	<h4> 
    		<form method="post" action="AjouterModule.php">
    		Nom : <input type="text" name="Nom" />
    		Semestre : <input type="int" name="semestre" />
    		heurescm : <input type="int" name="heurescm" />
    		heurestd  : <input type="int" name="heurestd" />
    		heurestp  : <input type="int" name="heurestp" />
    		<?php
    		$bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$dataprof = $bdd->query('SELECT * FROM enseignementpolytech1.enseignant ');
    		$ListeEnseignants = $dataprof->fetchAll();
    		echo'Enseignant responsable  :';
    		echo'<select name="idprof" id="idprof">';
    		echo'<option value='.'0'.'>'.'non défini'.'</option>';
    		for($i=0; $i<count($ListeEnseignants); $i++){
    			echo'<option value='.($i+1).'>'.$ListeEnseignants[$i]['nom'].' '.$ListeEnseignants[$i]['prenom'].'</option>';
    		}
    		echo'</select>';?>
    	<input type="submit" value="Enregistrer"/>
    	</form>
    	 </h4>
    </body>
</html>