<?php
//Paramètres global pour le serveur :
$bdName = 'enseignementpolytech1'; //Nom de la base de données MySQL
$bdUser = 'root';// Identifiant pour se connecter a la base de données (par PDO)
$bdUserPasswd = '';// Mot de passe pour se connecter à la base de données (par PDO)
$bdServer = 'localhost:3308';// Adresse de localisation de la base de données MySQL
$webServer = '';// ???




//Paramètres pour AjouterExcel.php
$LiEleve1er = 7;
$ColTP = 'A';
$Colnom = 'E';
$Colprenom = 'F';
$ColTD = 'I';
$LiEleveDer = 40;

//Paramètres pour AjouteriCal.php
$EPU = array('EBE','IAI','IDU','ITII','ITII-CM','ITII-MP','MM');
$typecours='TP';//Par défaut, le cours est un TP.


//Paramètres pour Impression.php
$CellDate = 'E2';
$ColNom = 'D';
$ColPrenom = 'E';
$FirstLigneEtu1 = 5;
$LastLigneEtu1 = 24;
$FirstLigneEtu2 = 29;
$Etudiantparpage = 20;

$CellFiliereCours1 ='F2';
$CellAnneeCours1 ='G2';
$CellModuleCours1 ='F3';
$CellHeureCours1 ='G3';
$CellTypeCours1 ='H3';
$CellEnseignantCours1 ='F4';

$CellFiliereCours2 ='J2';
$CellAnneeCours2 ='K2';
$CellModuleCours2 ='J3';
$CellHeureCours2 ='K3';
$CellTypeCours2 ='L3';
$CellEnseignantCours2 ='J4';

$CellFiliereCours3 ='N2';
$CellAnneeCours3 ='O2';
$CellModuleCours3 ='N3';
$CellHeureCours3 ='O3';
$CellTypeCours3 ='P3';
$CellEnseignantCours3 ='N4';

$CellFiliereCours4 ='R2';
$CellAnneeCours4 ='S2';
$CellModuleCours4 ='R3';
$CellHeureCours4 ='S3';
$CellTypeCours4 ='T3';
$CellEnseignantCours4 ='R4';

$CellFiliereCours5 ='V2';
$CellAnneeCours5 ='W2';
$CellModuleCours5 ='V3';
$CellHeureCours5 ='W3';
$CellTypeCours5 ='X3';
$CellEnseignantCours5 ='V4';


?>