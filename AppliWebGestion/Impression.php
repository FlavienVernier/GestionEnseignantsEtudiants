<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>Impression feuille d'absence</title>
    </head>

    <body>
        <h1>Liste des cours à imprimer</h1>
        <p>
        <br/>

        
    <?php
    echo("Veuillez patienter, traitement en cours");
    echo('<br/>');
    require_once('Config.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host='.$bdServer.';dbname='.$bdName.';charset=utf8', $bdUser, $bdUserPasswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    require_once('lib/PhpSpreadsheet-master/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Reader\Xls;

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("Liste_IDU3_S6FicheAbsenceUPDATED.ods");
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Ods");
    //$writer->save("Liste_IDU3_S6FicheAbsenceUPDATED.ods");



    //$inputFileType = IOFactory::identify('Liste_IDU3_S6FicheAbsenceUPDATED.ods');
    //$reader = IOFactory::createReader($inputFileType);
    //$reader->setLoadAllSheets();
    //$spreadsheet = $reader->load('Liste_IDU3_S6FicheAbsenceUPDATED.ods');

    //$sheetData = $spreadsheet->getActiveSheet()->toArray(true, true, true, true);
    //var_dump($sheetData);


    $loadedSheetNames = $spreadsheet->getSheetNames();

   
    $spreadsheet->setActiveSheetIndexByName($loadedSheetNames[0]);
    $spreadsheet->getActiveSheet()->setCellValue('F3', 'INFO942');




    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    var_dump($sheetData);    
    $writer->save("Ficheaimprimer.xls");
    

    
    
    
    
    ?>
    </p>
    </body>
</html>