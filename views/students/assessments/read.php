<?php
    require_once __DIR__ . '/vendor/autoload.php';


	$mpdf = new \Mpdf\Mpdf();

    $mpdf->WriteHTML($body);

	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0; 

	//call watermark content and image
	$mpdf->SetWatermarkText('etutorialspoint');
	$mpdf->showWatermarkText = true;
	$mpdf->watermarkTextAlpha = 0.1;

	//output in browser
	$mpdf->Output();	
?>