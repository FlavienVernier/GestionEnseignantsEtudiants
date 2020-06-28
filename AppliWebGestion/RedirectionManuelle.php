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
        header("Location: http://localhost/AppliWebGestion/SaisieCours.html");
    if ($_POST['choix']==='module')
        header("Location: http://localhost/AppliWebGestion/SaisieModule.html");
    if ($_POST['choix']==='enseignant')
        header("Location: http://localhost/AppliWebGestion/SaisieEnseignant.html");
    if ($_POST['choix']==='etudiant')
        header("Location: http://localhost/AppliWebGestion/SaisieEtudiant.html"); ?>
        
    
    </body>
</html>
