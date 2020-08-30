<?php
//Paramètres global pour le serveur :
$bdName = 'enseignementpolytech1'; //Nom de la base de données MySQL
$bdUser = 'root';// Identifiant pour se connecter a la base de données (par PDO)
$bdUserPasswd = '';// Mot de passe pour se connecter à la base de données (par PDO)
$bdServer = 'localhost:3308';// Adresse de localisation de la base de données MySQL
$webServer = '';// ???




//Paramètres pour AjouterExcel.php
$LiEleve1er = 7; // Première ligne sur le fichier Excel sur lequel se trouve les données sur le 1er étudiant de la liste.
$ColTP = 'A'; // Numéro de colonne ou se trouve le nom du groupe de TP de l'étudiant
$Colnom = 'E'; // Numéro de colonne ou se trouve le nom de l'étudiant 
$Colprenom = 'F'; // Numéro de colonne ou se trouve le prénom de l'étudiant
$ColTD = 'I'; // Numéro de colonne ou se trouve le nom du groupe de TD de l'édutiant
$LiEleveDer = 40; // Limite maximale de la ligne ou peut se trouver les informations d'un dernier étudiant de la liste.

//Paramètres pour AjouteriCal.php
$EPU = array('EBE','IAI','IDU','ITII','ITII-CM','ITII-MP','MM'); //EPU est une chaîne de caractères que l'on peut trouver dans le fichier iCal, il représente toutes les fillières.
$typecours='TP';//Par défaut, le cours est considéré comme un TP.


//Paramètres pour Impression.php
// Les paramètres ci-dessous permettent de localiser et placer chaque information du cours sur la fiche d'absence.
$CellIDFICHE = 'A1';//Emplacement de l'ID de la fiche d'absence
$CellDate = 'E2'; //Emplacement de la date
$ColNom = 'D'; //Emplacement du nom de chaque étudiant
$ColPrenom = 'E'; //Emplacement du prénom de chaque étudiant
$FirstLigneEtu1 = 5; //Ligne correspondant au premier étudiant de la liste, sur la 1ère feuille
$LastLigneEtu1 = 24; //Ligne correspondant au dernier étudiant de la liste, sur la 1ère feuille
$FirstLigneEtu2 = 29; //Ligne correspondant au premier étudiant de la liste, sur la 2ère feuille
$Etudiantparpage = 20;//Ligne correspondant au dernier étudiant de la liste, sur la 2ère feuille

//Informations pour le 1er cours
$CellFiliereCours1 ='F2'; //Emplacement de la filière concernée
$CellAnneeCours1 ='G2'; //Emplacement de l'année d'étude de la classe concernée
$CellModuleCours1 ='F3'; //Emplacement du module concerné
$CellHeureCours1 ='G3'; //Emplacement du début de l'heure du cours
$CellTypeCours1 ='H3'; //Emplacement du type de cours (CM, TD, TP)
$CellEnseignantCours1 ='F4'; //Emplacement du nom de l'enseignant concerné.

//Informations pour le 2ème cours
$CellFiliereCours2 ='J2';
$CellAnneeCours2 ='K2';
$CellModuleCours2 ='J3';
$CellHeureCours2 ='K3';
$CellTypeCours2 ='L3';
$CellEnseignantCours2 ='J4';

//Informations pour le 3ème cours
$CellFiliereCours3 ='N2';
$CellAnneeCours3 ='O2';
$CellModuleCours3 ='N3';
$CellHeureCours3 ='O3';
$CellTypeCours3 ='P3';
$CellEnseignantCours3 ='N4';

//Informations pour le 4ème cours
$CellFiliereCours4 ='R2';
$CellAnneeCours4 ='S2';
$CellModuleCours4 ='R3';
$CellHeureCours4 ='S3';
$CellTypeCours4 ='T3';
$CellEnseignantCours4 ='R4';

//Informations pour le 5ème cours
$CellFiliereCours5 ='V2';
$CellAnneeCours5 ='W2';
$CellModuleCours5 ='V3';
$CellHeureCours5 ='W3';
$CellTypeCours5 ='X3';
$CellEnseignantCours5 ='V4';


?>