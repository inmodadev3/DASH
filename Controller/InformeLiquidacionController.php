<?php 
require "../Composer/vendor/autoload.php";
use Mpdf\Mpdf;
use Spipu\Html2Pdf\Html2Pdf;
ob_start();
require_once "../Reports/InformeLiquidacion.php";
$html = ob_get_clean();
$html2pdf = new Html2Pdf('P','Media Carta','es', true, 'UTF-8');
$html2pdf->writeHTML($html);

$html2pdf->output("Liquidacion.pdf",'I');

/**
* 
*/

 ?>