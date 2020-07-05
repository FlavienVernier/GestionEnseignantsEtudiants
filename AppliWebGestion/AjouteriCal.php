<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieCours</title>
    </head>

    <body>
    <?php
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $root = $_SERVER['DOCUMENT_ROOT'];

    require($root.'/AppliWebGestion/iCalEasyReader.php');

    $ical = new iCalEasyReader();
    $lines = $ical->load(file_get_contents($_FILES["userfile"]["tmp_name"]));
    //var_dump($lines);

    //Les éléments importants à reprendre dans le fichier iCal se trouvent aux endroits suivants :

    //print_r($lines['VEVENT'][0]['DTSTART']);
    //echo('<br/>');
    //print_r($lines['VEVENT'][0]['SUMMARY']);
    //echo('<br/>');
    //print_r($lines['VEVENT'][0]['DESCRIPTION']);
    //echo('<br/>');
    $format = "d/m/Y H:i:s";
    //$date = DateTime::createFromFormat($format, $external);
    for ($i = 0; $i <= count($lines['VEVENT'])-1; $i++){
        $StringDateStart = $lines['VEVENT'][$i]['DTSTART'];
        $StringLeCours = $lines['VEVENT'][$i]['SUMMARY'];
        $StringClasseProf = $lines['VEVENT'][$i]['DESCRIPTION'];
        $date = DateTime::createFromFormat($format, substr($lines['VEVENT'][$i]['DTSTART'], 6, 2).'/'.substr($lines['VEVENT'][$i]['DTSTART'], 4, 2).'/'.substr($lines['VEVENT'][$i]['DTSTART'], 0, 4).' '.substr($lines['VEVENT'][$i]['DTSTART'], 9, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 11, 2).':'.substr($lines['VEVENT'][$i]['DTSTART'], 13, 2));

        print_r($date);
        echo('<br/>');
        //print_r($date);


    }

    //print_r($lines);
    


    
    echo("Tous les cours ont bien été ajoutés à la base de données")

    


    ?>
    </body>
</html>