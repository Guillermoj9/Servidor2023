<?php

//Datos de prueba para pintar en el pdf
$proyectos = array(
	array("Nombre" => "Proyecto1", "Descripcion" => "Pedazo Proyecto", "Importancia" => 3, "Porcentaje" => "90%"),
	array("Nombre" => "Proyecto2", "Descripcion" => "Pedazo Proyecto", "Importancia" => 1, "Porcentaje" => "80%"),
	array("Nombre" => "Proyecto3", "Descripcion" => "Pedazo Proyecto", "Importancia" => 5, "Porcentaje" => "100%"),
	array("Nombre" => "Proyecto4", "Descripcion" => "Pedazo Proyecto", "Importancia" => 2, "Porcentaje" => "50%"),
	array("Nombre" => "Proyecto5", "Descripcion" => "Pedazo Proyecto", "Importancia" => 3, "Porcentaje" => "20%"),
);


//Load Composer's autoloader
require './vendor/autoload.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Javi Profe');
$pdf->setTitle('Proyectos de mi empresa');
$pdf->setSubject('Proyectos');
$pdf->setKeywords('PHP, PDF, proyectos');

// set default header data
//$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = "
<h1>PROYECTOS</h1>
<i>Todos los proyectos de mi empresa</i><br><br>";
$html .= "<table border='1'>";
$html .= "<tr><td>Nombre</td><td>Descripción</td><td>Importancia</td><td>Porcentaje</td></tr>";

foreach($proyectos as $proyecto) {
	$html .= "<tr>";
	$html .= "<td>".$proyecto['Nombre']."</td>";
	$html .= "<td>".$proyecto['Descripcion']."</td>";
	$html .= "<td>".$proyecto['Importancia']."</td>";
	$html .= "<td>".$proyecto['Porcentaje']."</td>";

	$html .= "</tr>";
}

$html .= "</table>";

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

echo "Generando ...";

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$flujo = $pdf->Output('ejemplo.pdf', 'S');
file_put_contents("ejemplo.pdf", $flujo);

echo "Generado."
//============================================================+
// END OF FILE
//============================================================+
?>