<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieCours</title>
    </head>

    <body>
    <?php 
    if ($_POST['choix']==='cours')
        header("Location: http://localhost/AppliWebGestion/SaisieListeCours.html");
    if ($_POST['choix']==='etudiants')
        header("Location: http://localhost/AppliWebGestion/SaisieListeEtudiant.html"); ?>
        
    
    </body>
</html>