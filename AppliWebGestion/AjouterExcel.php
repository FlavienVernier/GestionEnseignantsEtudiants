<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>SaisieCours</title>
    </head>

    <body>
    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $bdd = new PDO('mysql:host=localhost:3308;dbname=enseignementpolytech1;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    
    //$bdd->query('INSERT INTO enseignementpolytech1.etudiant (nom,prenom,promo,filiere,groupetd,groupetp) VALUES ("tiery","henry",2020,"IAI","D1","D")');

    //$requete2 = $bdd->query('CREATE TABLE `test`.`etudiant` ( `id` INT NOT NULL )');

    

    $root = $_SERVER['DOCUMENT_ROOT'];
    
    //$inputFileName = 'Liste_IAI3_Annecy.xls';
    require($root.'/AppliWebGestion/ConfigExcel.php');
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


// Important d'utiliser la fonctioner "identify"  si on veut créer un $reader sur les fichiers .xls
    $inputFileName = $_FILES["userfile"]["tmp_name"];
    $inputFileType = IOFactory::identify($inputFileName);
    $reader = IOFactory::createReader($inputFileType);
    $reader->setLoadAllSheets();
    $spreadsheet = $reader->load($inputFileName);
    

    $loadedSheetNames = $spreadsheet->getSheetNames();

   
    foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
        //print_r($loadedSheetName);
        //print_r($sheetIndex);
        $spreadsheet->setActiveSheetIndexByName($loadedSheetName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        //var_dump($sheetData);
        //print_r($sheetData);
        $GroupeTPtemp ='';
        $GroupeTDtemp ='';
        //print_r($sheetData[1]['A']."\n");
        $spe = '';
        $annee = substr($sheetData[2]['G'], 5, 4);
        $anneescolaire = $sheetData[1]['F'];
        $promo = $annee + 5 - $anneescolaire;
        /*
        $parcoureur2 = substr($sheetData[1]['A'], 0, 2);
        $parcoureur3 = substr($sheetData[1]['A'], 0, 3);
        $parcoureur4 = substr($sheetData[1]['A'], 0, 4);
        $parcoureur5 = substr($sheetData[1]['A'], 0, 5);
        $parcoureur9 = substr($sheetData[1]['A'], 0, 9);
        for ($i = 0; $i < strlen($sheetData[1]['A']); $i++){
            if ($parcoureur3 == 'IAI')
                $spe = 'IAI';
            if ($parcoureur4 == '3ème' or $parcoureur4 =='3eme')
                $promo = 2;
            if ($parcoureur9 == '2019-2020')
                $promo = 2020 + $promo;
            

            //print_r($parcoureur2);
            $parcoureur2 = substr($sheetData[1]['A'], $i+1, 2);
            $parcoureur3 = substr($sheetData[1]['A'], $i+1, 3);
            $parcoureur4 = substr($sheetData[1]['A'], $i+1, 4);
            $parcoureur5 = substr($sheetData[1]['A'], $i+1, 5);
            $parcoureur9 = substr($sheetData[1]['A'], $i+1, 9);

            //print_r($sheetData[1]['A'][$i]);
        }
        */
        $spe = $sheetData[1]['E'];
        if ($sheetIndex==0 or $sheetIndex==1)
            for ($i = $LiEleve1er; $i <= $LiEleveDer; $i++){
                if ($sheetData[$i][$ColTP] != NULL and $sheetData[$i][$ColTP] != '')
                    $GroupeTPtemp = $sheetData[$i][$ColTP];
                if ($sheetData[$i][$ColTD] != NULL and $sheetData[$i][$ColTD] != '')
                    $GroupeTDtemp = $sheetData[$i][$ColTD];

                //if ($GroupeTPtemp == 'Groupe de TP D1')
                  //  $GroupeTPtemp = 'D1';
                //if ($GroupeTPtemp == 'Groupe de TP D2')
                 //   $GroupeTPtemp = 'D2';
                //if ($GroupeTDtemp == 'Groupe de TD D')
                
                //$GroupeTDtemp = 'D';
                

                if($sheetData[$i][$Colnom] != NULL and $sheetData[$i][$Colprenom] != NULL and $sheetData[$i][$Colnom] !='' and $sheetData[$i][$Colprenom] !='')
                    $bdd->query('INSERT INTO enseignementpolytech1.etudiant (nom,prenom,promo,filiere,groupetd,groupetp) VALUES ('.'"'.$sheetData[$i][$Colnom].'"'.','.'"'.$sheetData[$i][$Colprenom].'"'.','.$promo.','.'"'.$spe.'"'.','.'"'.$GroupeTDtemp.'"'.','.'"'.$GroupeTPtemp.'"'.')');

                //$bdd->query('INSERT INTO enseignementpolytech1.etudiant (nom,prenom,promo,filiere,groupetd,groupetp) VALUES (".'$sheetData[$i][$Colnom]'."',"."$sheetData[$i][$Colprenom]".",.$promo.,"."$spe".","."$GroupeTDtemp".","."$GroupeTPtemp".")');
            }
        
    }
    echo("Tous les élèves ont bien été ajoutés à la base de données")

    

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