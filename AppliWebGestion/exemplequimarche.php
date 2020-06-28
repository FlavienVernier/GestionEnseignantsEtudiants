
    <?php
    //print_r($_FILES["userfile"]["tmp_name"]);
    $root = $_SERVER['DOCUMENT_ROOT'];
    //require_once($root.'/AppliWebGestion/PHPOffice/PhpSpreadsheet/IOFactory.php');
    $inputFileName = $_FILES["userfile"]["tmp_name"];
    print_r($inputFileName);

    require($root.'/AppliWebGestion/lib/PhpSpreadsheet-master/vendor/autoload.php');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');
    $writer = new Xlsx($spreadsheet);
    $writer->save('hello world.xlsx');
    //$spreadsheet = IOFactory::load($inputFileName);
    ?>