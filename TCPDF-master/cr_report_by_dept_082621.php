<?php
$control_no = $_GET['control_no'];
$month 		= $_POST['txt_month'];
$year 		= $_POST['txt_year'];
$memo_type	= $_POST['txt_memo_type'];
//============================================================$
// File name   : cr_report_by_dept.php
// Begin       : 2017-02-00
// Last Update : 2017-10-12
//
// Description : PMI Charging Report Format 2
//
// Author: Nicola Asuni
//
//============================================================$
// Include the main TCPDF library (search for installation path).
require_once('./TCPDF-master/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Antonio');
$pdf->SetTitle('PMICR');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(10, PDF_MARGIN_TOP, 3);
// $pdf->SetMargins(0,0,0,true);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
// set font
$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage('L', 'A4');

require_once('./query.php');
$result		= "";
$table 	   	= 't_pmi_cr_dept';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE pcrd_control_no='".$control_no."' AND logdel=0";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$pcrd_id = $row['pcrd_id'];
	$pcrd_no = $row['pcrd_no'];
	$pcrd_control_no = $row['pcrd_control_no'];
	$pcrd_to = $row['pcrd_to'];
	$pcrd_attention = $row['pcrd_attention'];
	$pcrd_approved_by = $row['pcrd_approved_by1'];
	$pcrd_approved_by2 = $row['pcrd_approved_by2'];
	$pcrd_cc = $row['pcrd_cc'];
	$pcrd_noted_by1 = $row['pcrd_noted_by1'];
	$pcrd_noted_by2 = $row['pcrd_noted_by2'];
	$pcrd_prepared_by = $row['pcrd_prepared_by'];
	$pcrd_department = $row['pcrd_department'];
	$pcrd_adate = $row['pcrd_adate'];
	$pcrd_issued_date = $row['pcrd_issued_date'];
	$pcrd_pdi_dm = $row['pcrd_pdi_dm'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcrd_approved_by."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_approver = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcrd_approved_by2."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_approver2 = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcrd_noted_by1."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_noter1 = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcrd_prepared_by."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_prep_by = $row['ur_title'];
}

if($pcrd_noted_by2!=''&&$pcrd_noted_by2!=' '){
	$ur_title_noter2 = '';
	$table 	   	= 't_user_role';
	$array_fields = array('*');
	$joins 	   	= '';
	$sql_where 	= "WHERE ur_name='".$pcrd_noted_by2."'";
	$sql_order 	= '';
	$sql_limit 	= '';
	$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
	if($row 	= mysqli_fetch_array($result)){
		$ur_title_noter2 = $row['ur_title'];
	}
}


if($pcrd_department=='ts'){
	$pdf->Image('dist/img/checked.png','212', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','212', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcrd_department=='cn'){
	$pdf->Image('dist/img/checked.png','234.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','234.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcrd_department=='yf'){
	$pdf->Image('dist/img/checked.png','257', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','257', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcrd_department=='pps'){
	$pdf->Image('dist/img/checked.png','278.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','278.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}


$pdf->SetFont('helvetica', 'B', 7);
$pdf->writeHTMLCell(22.5, '', '204', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TS', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '226.5', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CN', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '249', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YF', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '271.5', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PPS', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(0, '', '270.5', '30.5', 'Prepared by:', 0, 0, 0, true, 'L', false);
if($pcrd_approved_by2!=''||$pcrd_noted_by2!=''){
	if($pcrd_approved_by2!=''&&$pcrd_noted_by2==''){		
		$pdf->Rect(226.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(249, 22,22.5, 6, 'D', '');
		$pdf->Rect(271.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(204, 22,22.5, 6, 'D', '');	
		$pdf->Rect(174, 30,30, 22, 'D', '');												
		$pdf->Rect(204, 30,30, 22, 'D', '');
		$pdf->Rect(234, 30,30, 22, 'D', '');
		$pdf->Rect(264, 30,30, 22, 'D', '');
		$pdf->Line(294, 34,174.1, 34);
		$pdf->SetFont('helvetica', 'B', 7);
		$pdf->writeHTMLCell(0, '', '180.5', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
		$pdf->writeHTMLCell(0, '', '243', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
		$pdf->SetFont('helvetica', ' ', 7);
		$pdf->writeHTMLCell(32, '', '173.5', '46.5', $pcrd_approved_by2, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '173.5', '49', $ur_title_approver2, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcrd_approved_by, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '233.5', '46.5', $pcrd_noted_by1, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '233.5', '49', $ur_title_noter1, 0, 0, 0, true, 'C', false);
	}	
	if($pcrd_noted_by2!=''&&$pcrd_approved_by2==''){
		$pdf->Rect(226.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(249, 22,22.5, 6, 'D', '');
		$pdf->Rect(271.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(204, 22,22.5, 6, 'D', '');	
		$pdf->Rect(174, 30,30, 22, 'D', '');												
		$pdf->Rect(204, 30,30, 22, 'D', '');
		$pdf->Rect(234, 30,30, 22, 'D', '');
		$pdf->Rect(264, 30,30, 22, 'D', '');
		$pdf->Line(294, 34,174.1, 34);
		$pdf->SetFont('helvetica', 'B', 7);
		$pdf->writeHTMLCell(0, '', '180.5', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
		$pdf->writeHTMLCell(0, '', '212.5', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
		$pdf->SetFont('helvetica', ' ', 7);
		$pdf->writeHTMLCell(32, '', '173.5', '46.5', $pcrd_approved_by, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '173.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcrd_noted_by1, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_noter1, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '233.5', '46.5', $pcrd_noted_by2, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '233.5', '49', $ur_title_noter2, 0, 0, 0, true, 'C', false);
	}	
if($pcrd_noted_by2!=''&&$pcrd_approved_by2!=''){
		$pdf->Rect(226.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(249, 22,22.5, 6, 'D', '');
		$pdf->Rect(271.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(204, 22,22.5, 6, 'D', '');	
		$pdf->Rect(144, 30,30, 22, 'D', '');	
		$pdf->Rect(174, 30,30, 22, 'D', '');												
		$pdf->Rect(204, 30,30, 22, 'D', '');
		$pdf->Rect(234, 30,30, 22, 'D', '');
		$pdf->Rect(264, 30,30, 22, 'D', '');
		$pdf->Line(294, 34,144.1, 34);
		$pdf->SetFont('helvetica', 'B', 7);
		$pdf->writeHTMLCell(0, '', '150', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
		$pdf->writeHTMLCell(0, '', '212.5', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
		$pdf->SetFont('helvetica', ' ', 7);
		$pdf->writeHTMLCell(32, '', '143.5', '46.5', $pcrd_approved_by2, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '143.5', '49', $ur_title_approver2, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '173.5', '46.5', $pcrd_approved_by, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '173.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcrd_noted_by1, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_noter1, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '233.5', '46.5', $pcrd_noted_by2, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '233.5', '49', $ur_title_noter2, 0, 0, 0, true, 'C', false);
	}	
}
else{
		$pdf->Rect(226.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(249, 22,22.5, 6, 'D', '');
		$pdf->Rect(271.5, 22,22.5, 6, 'D', '');
		$pdf->Rect(204, 22,22.5, 6, 'D', '');													
		$pdf->Rect(204, 30,30, 22, 'D', '');
		$pdf->Rect(234, 30,30, 22, 'D', '');
		$pdf->Rect(264, 30,30, 22, 'D', '');
		$pdf->Line(294, 34,204.1, 34);
		$pdf->SetFont('helvetica', 'B', 7);
		$pdf->writeHTMLCell(0, '', '211', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
		$pdf->writeHTMLCell(0, '', '243', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
		$pdf->SetFont('helvetica', ' ', 7);
		$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcrd_approved_by, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);	
		$pdf->writeHTMLCell(32, '', '233.5', '46.5', $pcrd_noted_by1, 0, 0, 0, true, 'C', false);
		$pdf->writeHTMLCell(32, '', '233.5', '49', $ur_title_noter1, 0, 0, 0, true, 'C', false);	
}

$pdf->writeHTMLCell(32, '', '263.5', '46.5', $pcrd_prepared_by, 0, 0, 0, true, 'C', false); //CHANGE THIS IF YOU NEED
$pdf->writeHTMLCell(32, '', '263.5', '49', 'PPC Clerk', 0, 0, 0, true, 'C', false);
// $pdf->writeHTMLCell(32, '', '263.5', '46.5', $pcrd_prepared_by, 0, 0, 0, true, 'C', false);
// $pdf->writeHTMLCell(32, '', '263.5', '49', $ur_title_prep_by, 0, 0, 0, true, 'C', false);
$pdf->setPage(1, true);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->writeHTMLCell(0, '', '8', '18', 'PMI Charging Report', 0, 0, 0, true, 'L', false);
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTMLCell(0, '', '8', '30', 'To ', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '30', ': &nbsp;'.$pcrd_to, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '34', 'Attn', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '34', ': &nbsp;'.$pcrd_attention, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '38', 'Cc ', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '38', ': &nbsp;'.$pcrd_cc, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '46', 'PMI DM '.$pcrd_pdi_dm, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '50', 'Document # &nbsp;'.$pcrd_control_no, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '54', 'Issued Date &nbsp;'.date("F d, Y",strtotime($pcrd_issued_date)), 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '23', '62', 'Summary of <b>'.$memo_type.'</b> Memo for the month of '.$month.' '.$year.'', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '64', 'CREDIT', 0, 0, 0, true, 'R', false);
$pdf->writeHTMLCell(267, '', '8', '64', 'DEBIT', 0, 0, 0, true, 'R', false);
if($memo_type=='Debit'){
	$pdf->Image('dist/img/checked.png','259.4', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','259.4', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($memo_type=='Credit'){
	$pdf->Image('dist/img/checked.png','275.9', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','275.9', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
$pdf->SetFont('helvetica', '', 7);

/* 
	Edited March 14, 2017 
	Change Log:
	Replace NG Material to Material
*/

// $pdf->writeHTMLCell(0, '', '107.9', '65', 'NG Material', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '107.9', '67', 'Material', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '160.5', '67', 'Man-hour', 0, 0, 0, true, 'L', false);
$pdf->SetFont('helvetica', '', 9);
$table_content = '<table style="padding:1px;width:80%;" cellpadding="3">
		<thead >
			<tr style="font-size:8px">
				<td style="width:20px;border:1px solid black;text-align:center;"><br><br><b>No.</b></td>
				<td style="width:68px;border:1px solid black;text-align:center;"><br><b>In-Charge Section</b></td>
				<td style="width:98px;border:1px solid black;text-align:center;"><br><br><b> Material/Product Name</b></td>
				<td style="width:77px;border:1px solid black;text-align:center;"><br><br><b>Detail</b></td>
				<td style="width:62px;border:1px solid black;text-align:center;"><b>Billing Summary</b></td>
				<td style="width:49px;border:1px solid black;text-align:center;background-color:#074fc1;color:#fcfcfc;"><b>Material Unit Price</b></td>
				<td style="width:47px;border:1px solid black;text-align:center;background-color:#074fc1;color:#fcfcfc;"><b>Material Qty.</b></td>
				<td style="width:59px;border:1px solid black;text-align:center;background-color:#074fc1;color:#fcfcfc;"><b>Total Amnt.(USD)</b></td>
				<td style="width:47px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><br><b>Sorting Qty.</b></td>
				<td style="width:49px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Total<br>Manhours</b></td>
				<td style="width:49px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><br><br><b>Cost/pc.</b></td>
				<td style="width:58px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Total Amnt.(USD)</b></td>
				<td style="width:58px;border:1px solid black;text-align:center;background-color:#ff9d00;"><b>Transport Total Amnt.(USD)</b></td>
				<td style="width:58px;border:1px solid black;text-align:center;background-color:#fffa00;"><b>Total Amnt.(USD)</b></td>
				<td style="width:65px;border:1px solid black;text-align:center;"><b>Detail of Indication</b></td>
				<td style="width:56px;border:1px solid black;text-align:center;"><br><b>Supplier Name</b></td>
				<td style="width:55px;border:1px solid black;text-align:center;"><b>YEC Billing Request</b></td>
				<td style="width:56px;border:1px solid black;text-align:center;"><br><br><b>Category</b></td>	
			</tr>
		</thead>
		<tbody>';
$table 	   	= 't_pmi_cr_dept_content';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE pcrdc_control_no='$control_no' AND logdel=0";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
$ctr 		= 0;
$count		= 1;
$total_sorting_qty = 0;
$total_total_amnt_mt = 0;
$total_material_qty = 0;
$total_total_amnt_mp = 0;
$total_total_amnt_transpo = 0;
$total_total_amnt_overall = 0;
$total_manhours = 0;
$total_materials = 0;
$row_count = $result->num_rows;
$l = 0;
while($row 	= mysqli_fetch_array($result)){
	// switch ($ctr) {
	// 	case '0':
	// 		$row['pcrdc_tact_time'] = 51420;
	// 		$row['pcrdc_total_amount'] = 3342.20;
	// 		$row['pcrdc_total_amnt_mp'] = 3342.20;
	// 		break;
		
		// case '6':
		// 	$row['pcrdc_mt_unit_price'] = '';
		// 	$row['pcrdc_total_amount'] = 26.71;
		// 	$row['pcrdc_total_amount_mt'] = 26.71;
		// 	$row['pcrdc_mt_qty'] =  3002;
		// 	break;

		// case '7':
		// 	$row['pcrdc_mt_unit_price'] = '';
		// 	$row['pcrdc_total_amount'] =  1364.13;
		// 	$row['pcrdc_total_amount_mt'] = 1364.13;
		// 	$row['pcrdc_mt_qty'] =   198150;
		// 	break;
		
	// 	case '9':
	// 		$row['pcrdc_mt_unit_price'] = '';
	// 		$row['pcrdc_total_amount_mt'] = 49.79;
	// 		$row['pcrdc_total_amount'] = 49.79;
	// 		break;

	// 	default:
	// 		break;
	// }
	if($row['pcrdc_total_amnt_mp']=='0'){$row['pcrdc_total_amnt_mp']='';}
	if($row['pcrdc_total_amount_mt']=='0'){$row['pcrdc_total_amount_mt']='';}
	$table_content .='<tr style="font-size:8px;">';
	$table_content .='<td style="height:30px;width:20px;border:1px solid black;text-align:center;">'.$count.'</td>';
	$table_content .='<td style="width:68px;border:1px solid black;text-align:left;">'.$row['pcrdc_incharge_section'].'</td>';
	$table_content .='<td style="width:98px;border:1px solid black;text-align:left;">'.$row['pcrdc_material_product_name'].'</td>';
	$table_content .='<td style="width:77px;border:1px solid black;text-align:left;">'.$row['pcrdc_detail'].'</td>';
	$table_content .='<td style="width:62px;border:1px solid black;text-align:left;">'.$row['pcrdc_billing_summary'].'</td>';
	switch($ctr){
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:49px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_mt_unit_price'],4,'.',',').'</td>';
			break;
	}
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:47px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:47px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:47px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_mt_qty']).'</td>';
			break;
	}
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:59px;border:1px solid black;text-align:right;">6,309.24</td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:59px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:59px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_total_amount_mt'],2,'.',',').'</td>';
			break;
	}
	$table_content .='<td style="width:47px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_sorting_qty']).'</td>';
	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_tact_time'],2,'.',',').'</td>';
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;">2,460.32</td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:49px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_cost_mins'],4,'.',',').'</td>';
			break;
	}//example//set row value here//another switch statement if multiple columns 
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_total_amnt_mp'],2,'.',',').'</td>';
			break;
	}//example//set row value here//another switch statement if multiple columns 
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_transport_total_amnt'],2,'.',',').'</td>';
			break;
	}//example//set row value here//another switch statement if multiple columns 
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">6,309.24</td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2,460.32</td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">'.number_format($row['pcrdc_total_amount'],2,'.',',').'</td>';
			break;
	}//example//set row value here//another switch statement if multiple columns 
	$table_content .='<td style="width:65px;border:1px solid black;text-align:left;">'.$row['pcrdc_details_of_indication'].'</td>';
	$table_content .='<td style="width:56px;border:1px solid black;text-align:left;">'.$row['pcrdc_supplier_name'].'</td>';
	if($row['pcrdc_yec_billing']=='Debit'){
		$table_content .='<td style="width:55px;border:1px solid black;text-align:center;background-color:#020BED;color:#FFFDFE;">'.$row['pcrdc_yec_billing'].'</td>';
	}	
	else if($row['pcrdc_yec_billing']=='Invoice'){
		$table_content .='<td style="width:55px;border:1px solid black;text-align:center;background-color:#FB0100;color:#FFFDFE;">'.$row['pcrdc_yec_billing'].'</td>';
	}
	else{
		$table_content .='<td style="width:55px;border:1px solid black;text-align:left;">'.$row['pcrdc_yec_billing'].'</td>';
	}
	$table_content .='<td style="width:56px;border:1px solid black;text-align:left;">'.$row['pcrdc_category'].'</td>';
	$table_content .='</tr>';
	$total_sorting_qty = floatval($total_sorting_qty)+round($row['pcrdc_sorting_qty'], 2);
	$total_total_amnt_mt = floatval($total_total_amnt_mt)+round($row['pcrdc_total_amount_mt'], 2);
	$total_material_qty = floatval($total_material_qty)+round($row['pcrdc_mt_qty'], 2);
	$total_total_amnt_mp = floatval($total_total_amnt_mp)+round($row['pcrdc_total_amnt_mp'], 2);
	$total_total_amnt_transpo = floatval($total_total_amnt_transpo)+round($row['pcrdc_transport_total_amnt'], 2);
	$total_total_amnt_overall = floatval($total_total_amnt_overall)+round($row['pcrdc_total_amount'], 2);
	if($row['pcrdc_type']=='1'){$total_manhours=floatval($total_manhours)+round($row['pcrdc_total_amount'], 2);}
	if($row['pcrdc_type']=='2'){$total_materials=floatval($total_materials)+round($row['pcrdc_total_amount'], 2);}
	$count++;
	$ctr++;
}

//////////////////////////////////////////////////////////////////////////////// FOR AMOUNT ADJUSTMENT
// $total_total_amnt_mp = ($total_total_amnt_mp-(.01));
// $total_manhours = ($total_manhours-(.01));
// $total_total_amnt_mt = ($total_total_amnt_mt-(.01));
// $total_materials = ($total_materials-(.01));
// $total_total_amnt_overall = ($total_total_amnt_overall-(.01));
//////////////////////////////////////////////////////////////////////////////// FOR AMOUNT ADJUSTMENT

if($row_count==0){
	$table_content .='<tr style="font-size:9px;">';
	$table_content .='<td style="width:20px;border:1px solid black;text-align:center;"></td>';
	$table_content .='<td style="width:68px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:98px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:77px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:62px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:47px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:59px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:47px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:49px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:65px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:56px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:55px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:56px;border:1px solid black;text-align:left;"></td>';
	$table_content .='</tr>';
}
//comments below//set row column value
$table_content .= '<tr style="font-size:8px;background-color:#FEFF03;">';
$table_content .= '	<td style="border-left:1px solid black;border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;font-weight:bold;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-right:1px solid black;border-bottom:1px solid black;font-weight:bold;">TOTAL</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">'.number_format($total_material_qty).'</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ '.number_format($total_total_amnt_mt,2,'.',',').'</td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 6,309.24</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">'.number_format($total_sorting_qty).'</td>';
$table_content .= '	<td style="border:1px solid black;"></td>';
$table_content .= '	<td style="border:1px solid black;"></td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ '.number_format($total_total_amnt_mp,2,'.',',').'</td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 8,775.96</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ '.number_format($total_total_amnt_transpo,2,'.',',').'</td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 8,775.96</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ '.number_format($total_total_amnt_overall,2,'.',',').'</td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 8,769.56</td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;border-right:1px solid black;"></td>';
$table_content .= '</tr>';
$table_content .= '</tbody></table>';
$total_total = floatval($total_manhours)+floatval($total_materials);
// $total_total = ($total_total-(.01));
$pdf->SetFont('helvetica', '', 6);
$pdf->writeHTMLCell(0, '', '2', '70', $table_content.'<br>
	<table>
		<tbody>
		 <tr style="font-size:9px;white-space:nowrap;">
		  <td style="text-align:left;font-size:9px;width:694px;">
		  	<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note: Important reminders please generate debit memo on per division section in-charge <br>	
		  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Example: If the instruction is from YEC QC the content of Debit Memo should be intended only for YEC-QC <br>								
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction is from YEC Eng`g the content of Debit Memo should be intended only for YEC-Eng`g <br>	
		   <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Here`s How to distinguish the special instruction to be address of Debit Memo per section: <br>					
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction control no. start with: TSH-XXX -> It means the charging is intended only for YEC-QC section <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction control no. start with: TDI-XX-XXX -> Please confirm it first to Ms.Nakasato if what section should be charge. <br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are 4 sections using TDI control no. that`s why it is important to ask first Ms.Nakasato, send her the specific TDI data for her clarification.<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(YEC-Eng`g/YEC-Stamping/YEC-Sales/YEC-PPC)							
		  </td>
		  <td style="text-align:left;width:90px;">
		  	<br><br><br><br>
		  	Man-hours:<br>
		  	Materials:
		  	<hr><br>
		  	<b>TOTAL:</b>
		  </td>
		  <td style="text-align:left;width:78px;">
		  	<br><br><br><br>
		  	$ '.number_format($total_manhours,2,'.',',').'<br>
		  	$ '.number_format($total_materials,2,'.',',').'
		  	<hr>
		  	<b>$ '.number_format($total_total,2,'.',',').'</b>
		  </td>
		 </tr>
		</tbody>
	</table>',0, 0, 0, true, 'C', true);
$pdf->lastPage();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('cr_report_f2.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+