<?php

session_start();

require_once '../../../includes/constants.php';
require_once '../../../includes/database-config.php'; /* Database Settings */
require_once '../../../includes/util.php';

$error = 'false';
$dt = $_GET['dat'];
$sql = "SELECT s.*, d.*,e.e_name,e.pf_id
            FROM sick_leave s, dependent d, employee e
            WHERE s.s_id=d.sid AND e.e_emp_id=s.emp_id AND ('$dt' BETWEEN s.startDate AND s.endDate)
            ORDER BY s.sid DESC";
$arRes = $mysqli->query($sql);
if (!$arRes) {
    throw new Exception($mysqli->error);
} else {



    require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {

        public function Header() {

            $dt_c = new DateTime($_GET['dat']);
            $dt_r = $dt_c->format('j/m/Y');
            $html = '<table cellspacing="0" cellpadding="6">
                <tr>
                <td colspan="6" align="center"><h2>Borsillah Tea Estate</h2></td>
                </tr>
                <tr>
                <td colspan="6" align="center"><b>Employees on Leave on ' . $dt_r . '</b></td>
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
                 <head>
                 </head>
                 <body>
                 <table cellspacing="0" cellpadding="5" border="1">
                 <tr>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">SL ID.</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">Emp ID</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">Emp Name</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">PF ID</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">Patient</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">Start Date</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">End Date</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">Rate</th>
                 <th align="center" style="background-color:lightgrey; font-weight:bold;">No. of Days</th>
                 </tr>';
    $count = 0;
    while ($row = $arRes->fetch_assoc()) {
        $s = new DateTime($row['startDate']);
        $e = new DateTime($row['endDate']);
        $start = $s->format('j-M-Y');
        $end = $e->format('j-M-Y');
        $days = $e->diff($s)->format("%a");
        $days = $days + 1;
        if ($row['patientType'] == 'DEPENDENT') {
            $ptype = strtoupper($row['relation'] . ' (' . $row['gender'] . ')');
        } else {
            $ptype = $row['patientType'];
        }
        //$count = $count + 1;
        $html .= '<tr>
                 <td align="center" >' . $row['s_id'] . '</td> 
                 <td align="center">' . $row['emp_id'] . '</td>
                 <td>' . $row['e_name'] . '</td>
                 <td align="center">' . $row['pf_id'] . '</td>
                 <td align="center">' . $ptype . '</td> 
                 <td align="center">' . $start . '</td>  
                 <td align="center">' . $end . '</td>
                 <td align="center">' . $row['rate'] . '</td>   
                 <td align="center">' . $days . '</td>  
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