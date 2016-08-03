<?php
require_once('tcpdf_include.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', '', 9);
$pdf->AddPage();
$html = '<html>
<head></head>
<body><table width="100%">
<tr>
<th  height="50%" align="center">*** NO RECORD FOUND ***</th>
</tr>
</table>
</body>
</html>';
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->lastPage();
$pdf->Output('htmlout.pdf', 'I');
?>