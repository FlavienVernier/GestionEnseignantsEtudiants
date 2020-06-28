<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieCours</title>
    </head>

    <body>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    
    //$requete = $bdd->query('INSERT INTO enseignementpolytech1.etudiant (nom,prenom,promo,filiere,groupetd,groupetp) VALUES ("tiery","henry",2020,"IAI","D1","D")');

    //$requete2 = $bdd->query('CREATE TABLE `test`.`etudiant` ( `id` INT NOT NULL )');

    

    $root = $_SERVER['DOCUMENT_ROOT'];
    $inputFileName = $_FILES["userfile"]["tmp_name"];
    //$inputFileName = 'Liste_IAI3_Annecy.xls';

    require($root.'/AppliWebGestion/lib/PhpSpreadsheet-master/vendor/autoload.php');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Reader\Xls;


    //$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($inputFileName);
    //$reader->setReadDataOnly(true);
    //$reader->load($inputFileName);

    //$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xls");
    //$spreadsheet = $reader->load($inputFileName);

    //$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //$reader->setReadDataOnly(true);
    //$spreadsheet = $reader->load('Liste_IAI3_Annecy.xls');

//Celui ci-dessous fonctionne mais ne lit que la première feuille
    //$spreadsheet = IOFactory::load($inputFileName);
    //$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //var_dump($sheetData);


// Important d'utiliser la fonctioner "identify"  si on veut utiliser $reader   
    $inputFileType = IOFactory::identify($inputFileName);
    $reader = IOFactory::createReader($inputFileType);
    $reader->setLoadAllSheets();
    $spreadsheet = $reader->load($inputFileName);
    

    $loadedSheetNames = $spreadsheet->getSheetNames();

   
    foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
        print_r($loadedSheetName);
        print_r($sheetIndex);
        $spreadsheet->setActiveSheetIndexByName($loadedSheetName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        //var_dump($sheetData);
        //print_r($sheetData);
        if ($sheetIndex==0 or $sheetIndex==1)
            for ($i = 7; $i <= 40; $i++){
                print_r($sheetData[$i]['A']."\n");
                print_r($sheetData[$i]['E']."\n");
                print_r($sheetData[$i]['F']."\n");
                print_r($sheetData[$i]['I']."\n");
                echo('<br/>');
        }
        


    }

    

//IMPORTANT :
//Organisation de $sheetData pour les fichiers xls : sélection de la ligne (1,2,..) puis de la colone pour extraire les données.
// Exemple : $sheetData['7']['A']  correspond à la valeur dans la cellule A7

    //$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    //var_dump($sheetData);
    //print_r($sheetData)


    //$reader = new Xls();
    //$spreadsheet = $reader->load($inputFileName);
    //var_dump($sheetData);
    //print_r($sheetData)


    //$spreadsheet = IOFactory::load($inputFileName);

    ?>
    </body>
</html>