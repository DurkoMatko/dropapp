<?php
require('../library/core.php');

ini_set('display_errors',1);
error_reporting(E_ALL);

require('pdf.php');

define('PDFSCRIPT',true);
define('FPDF_FONTPATH','fonts/');

$pdf=new PDF();

$pdf->SetLineWidth(0.1);

$pdf->AddFont('helvetica','','helvetica.php');
$pdf->AddFont('helvetica','B','helveticab.php');
$pdf->AddFont('helvetica','I','helveticai.php');
$pdf->AddFont('helvetica','BI','helveticabi.php');

$pdf->SetFont('helvetica','',9);
$pdf->SetAutoPageBreak(false);

if($_GET['label']) {
	$labels = explode(',',$_GET['label']);
	$_GET['count'] = count($labels);
}

for($i=0;$i<intval($_GET['count']);$i++) {
	if(!($i%2)) {
		$pdf->AddPage();
		$y = 0;
	} else {
		#$pdf->Line(0,148.5,210,148.5);
		$y = 148.5;
	}

	if($labels[$i]) {
		$box = db_row('SELECT s.box_id, p.name AS product, s.items, s2.label AS size, g.label AS gender, s.qr_id, qr.code FROM stock AS s LEFT OUTER JOIN products AS p ON s.product_id = p.id LEFT OUTER JOIN sizes AS s2 ON s.size_id = s2.id LEFT OUTER JOIN genders AS g ON p.gender_id = g.id LEFT OUTER JOIN qr ON s.qr_id = qr.id WHERE s.id = :id',array('id'=>$labels[$i]));
		$hash = $box['code'];
	} else {
		$id = db_value('SELECT id FROM qr ORDER BY id DESC LIMIT 1')+1;
		$hash = md5($id);
		db_query('INSERT INTO qr (id, code, created) VALUES ('.$id.',"'.$hash.'",NOW())');
	}
	
	$url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://market.drapenihavet.no/'.$settings['rootdir'].'/mobile.php?barcode='.$hash;
	$valid = remoteFileExists($url);
	if(!$valid) die('The service that we use to create QR-codes seem to be offline. Try again in a few minutes!');
	$pdf->Image($url, 88, 12+$y, 34, 34, 'png');

	$pdf->Image('logo.png', 92, 107+$y, 26, 31);

	$pdf->SetFont('helvetica','',9);

	$pdf->Line(140,$y+30,200,$y+30);
	$pdf->Text(140,$y+34,'Box Number');
	
	$pdf->Line(40,$y+80,180,$y+80);
	$pdf->Text(40,$y+84,'Contents');

	$pdf->Line(10,$y+30,70,$y+30);
	$pdf->Text(10,$y+34,'Number of items');

	$pdf->Line(10,$y+130,70,$y+130);
	$pdf->Text(10,$y+134,'Gender');

	$pdf->Line(140,$y+130,200,$y+130);
	$pdf->Text(140,$y+134,'Size');
	
	if($box) {
		$pdf->SetFont('helvetica','B',42);

		$pdf->Text(140,$y+27,$box['box_id']);
		$pdf->Text(10,$y+27,$box['items']);

		$pdf->SetFont('helvetica','B',32);


		$pdf->SetXY(38,$y+72);
		$pdf->CellFit(140,0,$box['product'],0,0,'L',false,'',true,false);

		$pdf->SetXY(8,$y+122);
		$pdf->CellFit(60,0,$box['gender'],0,0,'L',false,'',true,false);

		$pdf->SetXY(138,$y+122);
		$pdf->CellFit(60,0,$box['size'],0,0,'L',false,'',true,false);

		#$pdf->Text(40,$y+77,);
		#$pdf->Text(10,$y+127,$box['gender']);
		#$pdf->Text(140,$y+127,$box['size']);
	}

}

$pdf->Output('I');

function remoteFileExists($url) {
    $curl = curl_init($url);

    //don't fetch the actual page, you only want to check the connection is ok
    curl_setopt($curl, CURLOPT_NOBODY, true);

    //do request
    $result = curl_exec($curl);

    $ret = false;

    //if request did not fail
    if ($result !== false) {
        //if request was ok, check response code
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  

        if ($statusCode == 200) {
            $ret = true;   
        }
    }

    curl_close($curl);

    return $ret;
}