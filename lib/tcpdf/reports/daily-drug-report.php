<?php

session_start();

require_once '../../../includes/constants.php';
require_once '../../../includes/database-config.php'; /* Database Settings */
require_once '../../../includes/util.php';

$error = 'false';
$dt = $_GET['dat'];
$sql = "SELECT pd.p_id,pd.drug_id,pd.addedQuantity,d.drugs_id,d.drugs_name,d.drugs_quantity,p.p_id,p.p_date
            FROM prescription_drugs pd, drugs d, prescription p
            WHERE pd.drug_id=d.drugs_id AND pd.p_id=p.p_id AND DATE(p.p_date)='$dt'";
$arRes = $mysqli->query($sql);
if (!$arRes) {
    throw new Exception($mysqli->error);
} else {
    

     
    require_once('tcpdf_include.php');
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->SetFont('helvetica', '', 9);
    $pdf->AddPage();
    $html = '<html>
                 <head>
                 
                 </head>
                 <body><table border="1px">
                 <tr>
                 <th align="center">Drug Name</th>
                 <th align="center">Date of Issue</th>
                 <th align="center">Total Stock</th>
                 <th align="center">Stock in Hand</th>
                 </tr>';
    while($row = $arRes->fetch_assoc()){
        $html .= '<tr>
                 <td>'.$row['drugs_name'].'</td>
                 <td>'.$row['p_date'].'</td> 
                 <td>'.$row['drugs_quantity'].'</td>
                 <td>'.$row['drugs_quantity'].'</td>       
                 </tr>';
    }
    $html .= '</table>
                 </body>
                 </html>';
    $pdf->writeHTML($html, true, 0, true, 0);
    $pdf->lastPage();
    $pdf->Output('htmlout.pdf', 'I');
    //echo $row->e_name;
}
?>