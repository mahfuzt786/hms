<?php

session_start();

require_once '../../../includes/constants.php';
require_once '../../../includes/database-config.php'; /* Database Settings */
require_once '../../../includes/util.php';

$error = 'false';
$dt = $_GET['dat'];
$sql = "SELECT pd.p_id,pd.drugs_id,pd.addedQuantity,d.drugs_id,d.drugs_name,d.drugs_quantity,p.p_id,p.p_date
            FROM prescription_drugs pd, drugs d, prescription p
            WHERE pd.drugs_id=d.drugs_id AND pd.p_id=p.p_id AND DATE(p.p_date)='$dt'";
$arRes = $mysqli->query($sql);
if (!$arRes) {
    throw new Exception($mysqli->error);
} else {



    require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        public function Header() {
            $html = '<table cellspacing="0" cellpadding="1" style="border-bottom:1px solid lightgrey;">
                <tr>
                <td colspan="5" align="center">Borsillah Tea Estate</td>
                </tr>
                <tr>
                <td colspan="5" align="center">Daily Report</td>
                </tr>
                </table>';
            $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
        }

    }

    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->SetFont('helvetica', '', 9);
    $pdf->AddPage();
    $html = '<html>
                 <head></head>
                 <body>
                 <table cellspacing="0" cellpadding="2">
                 <tr>
                 <th align="center">sl. No.</th>
                 <th align="center">Drug Name</th>
                 <th align="center">Date of Issue</th>
                 <th align="center">Total Stock</th>
                 <th align="center">Stock in Hand</th>
                 </tr>';
    $count = 0;
    while ($row = $arRes->fetch_assoc()) {
        $pDate = new DateTime($row['p_date']);
        $date = $pDate->format('Y-m-j');
        $count = $count + 1;
        $html .= '<tr>
                 <td align="center" >' . $count . '</td> 
                 <td>' . $row['drugs_name'] . '</td>
                 <td align="center">' . $date . '</td> 
                 <td align="center">' . $row['drugs_quantity'] . '</td>
                 <td align="center">' . $row['drugs_quantity'] . '</td>       
                 </tr>';
    }
    $html .= '</table>
                 </body>
                 </html>';
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();
    $pdf->Output($dt . '.pdf', 'I');
    //echo $row->e_name;
}
?>