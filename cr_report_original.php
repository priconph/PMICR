<?php 
$pmicr_control_no = $_GET['pmicr_control_no'];
$get_a = $_GET['add_control'];
$get_b = $_GET['add_machtools'];
$get_c = $_GET['add_materials'];
$get_d = $_GET['add_othrchrges'];
$ur_eid = $_GET['p_id'];
//============================================================$
// File name   : cr_report.php
// Begin       : 2017-10-12
// Last Update : 2017-10-12
//
// Description : PMI Charging Report Format 1
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
$pdf->SetAuthor('OJT-12-16');
$pdf->SetTitle('PMICR');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(0, PDF_MARGIN_TOP, 0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
require_once('./query.php');
$result		= "";
$table 	   	= 't_pmi_charging_report';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE pcr_control_no='".$pmicr_control_no."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row = mysqli_fetch_array($result)){
	$pcrd_id = $row['pcr_id'];
	$pcr_charge_to = $row['pcr_charge_to'];
	$pcr_incharge_section = $row['pcr_incharge_section'];
	$pcr_from = $row['pcr_from'];
	$pcr_attention = $row['pcr_attention'];
	$pcr_cc = $row['pcr_cc'];
	$pcr_date = $row['pcr_date'];
	$pcr_dept = $row['pcr_dept'];
	$pcr_control_no = $row['pcr_control_no'];
	$pcr_debit_credit_no = $row['pcr_debit_credit_no'];
	$pcr_type = $row['pcr_type'];
	$pcr_copy_for = $row['pcr_copy_for'];
	$pcr_checked_by = $row['pcr_checked_by'];
	$pcr_approved_by = $row['pcr_approved_by'];
	$pcr_prepared_by = $row['pcr_prepared_by'];
	$pcr_noted_by = $row['pcr_noted_by'];
	$pcr_row_count = $row['pcr_row_count'];
	$pcr_adate = $row['pcr_adate'];
	$pcr_row_count = $row['pcr_row_count'];
	$pcr_charge_to_location = $row['pcr_charge_to_location'];
}
$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcr_checked_by."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_checker = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcr_approved_by."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_approver = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_name='".$pcr_noted_by."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_noted_by = $row['ur_title'];
}

$table 	   	= 't_user_role';
$array_fields = array('*');
$joins 	   	= '';
$sql_where 	= "WHERE ur_eid='".$ur_eid."'";
$sql_order 	= '';
$sql_limit 	= '';
$result 	= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
if($row 	= mysqli_fetch_array($result)){
	$ur_title_prepared_by = $row['ur_title'];
}

if($pcr_manpower!=''){$pcr_manpower = '$ '.number_format($pcr_manpower,2,'.',',');}
if($pcr_machine_tools!=''){$pcr_machine_tools = '$ '.number_format($pcr_machine_tools,2,'.',',');}
if($pcr_materials!=''){$pcr_materials = '$ '.number_format($pcr_materials,2,'.',',');}
if($pcr_other_charges!=''){$pcr_other_charges = '$ '.number_format($pcr_other_charges,2,'.',',');}
if($pcr_total_charges!=''){$pcr_total_charges = '$ '.number_format($pcr_total_charges,2,'.',',');}
// set font
$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage('L', 'A4');


if($pcr_dept==1){
	$pdf->Image('dist/img/checked.png','212', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','212', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcr_dept==2){
	$pdf->Image('dist/img/checked.png','234.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','234.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcr_dept==3){
	$pdf->Image('dist/img/checked.png','257', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','257', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcr_dept==4){
	$pdf->Image('dist/img/checked.png','278.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','278.5', '23.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}


$pdf->SetFont('helvetica', 'B', 7);
$pdf->writeHTMLCell(22.5, '', '204', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TS', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '226.5', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CN', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '249', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YF', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(22.5, '', '271.5', '24', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PPD', 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(0, '', '270.5', '30.5', 'Prepared by:', 0, 0, 0, true, 'L', false);

$pdf->Rect(226.5, 22,22.5, 6, 'D', '');
$pdf->Rect(249, 22,22.5, 6, 'D', '');
$pdf->Rect(271.5, 22,22.5, 6, 'D', '');
$pdf->Rect(204, 22,22.5, 6, 'D', '');	
// $pdf->Rect(144, 30,30, 22, 'D', '');												
$pdf->Rect(204, 30,30, 22, 'D', '');
$pdf->Rect(234, 30,30, 22, 'D', '');
$pdf->Rect(264, 30,30, 22, 'D', '');
$pdf->SetFont('helvetica', 'B', 7);
// $pdf->writeHTMLCell(0, '', '212.5', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '240.5', '30.5', 'Checked by:', 0, 0, 0, true, 'L', false);
$pdf->SetFont('helvetica', ' ', 7);

if($pcr_noted_by==''||$pcr_noted_by==' '){
	$pdf->Line(294, 34,204, 34);
	$pdf->SetFont('helvetica', 'B', 7);
	$pdf->writeHTMLCell(0, '', '210.5', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
	$pdf->SetFont('helvetica', ' ', 7);
	$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcr_approved_by, 0, 0, 0, true, 'C', false);
	$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);	

}
else if($pcr_approved_by==''||$pcr_approved_by==' '){
	$pdf->Line(294, 34,204, 34);
	$pdf->SetFont('helvetica', 'B', 7);
	$pdf->writeHTMLCell(0, '', '212.5', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
	$pdf->SetFont('helvetica', ' ', 7);
	$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcr_noted_by, 0, 0, 0, true, 'C', false);
	$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_noted_by, 0, 0, 0, true, 'C', false);	

}
else{
	$pdf->SetFont('helvetica', 'B', 7);
	$pdf->writeHTMLCell(0, '', '212.5', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
	$pdf->SetFont('helvetica', ' ', 7);
	$pdf->writeHTMLCell(32, '', '203.5', '46.5', $pcr_noted_by, 0, 0, 0, true, 'C', false);
	$pdf->writeHTMLCell(32, '', '203.5', '49', $ur_title_noted_by, 0, 0, 0, true, 'C', false);	
	$pdf->SetFont('helvetica', 'B', 7);
	$pdf->Rect(174, 30,30, 22, 'D', '');	
	$pdf->writeHTMLCell(0, '', '180', '30.5', 'Approved by:', 0, 0, 0, true, 'L', false);
	$pdf->SetFont('helvetica', ' ', 7);
	// $pdf->writeHTMLCell(0, '', '182', '30.5', 'Noted by:', 0, 0, 0, true, 'L', false);
	$pdf->writeHTMLCell(32, '', '173.5', '46.5', $pcr_approved_by, 0, 0, 0, true, 'C', false);
	$pdf->writeHTMLCell(32, '', '173.5', '49', $ur_title_approver, 0, 0, 0, true, 'C', false);
	$pdf->Line(294, 34,174.1, 34);
}
	
$pdf->writeHTMLCell(32, '', '233.5', '46.5', $pcr_checked_by, 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(32, '', '233.5', '49', $ur_title_checker, 0, 0, 0, true, 'C', false);


$pdf->writeHTMLCell(32, '', '263.5', '46.5', $pcr_prepared_by, 0, 0, 0, true, 'C', false);
$pdf->writeHTMLCell(32, '', '263.5', '49', 'PPC Clerk', 0, 0, 0, true, 'C', false);
$pdf->setPage(1, true);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->writeHTMLCell(0, '', '8', '18', 'PMI Charging Report', 0, 0, 0, true, 'L', false);
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTMLCell(0, '', '8', '30', 'To ', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '30', ': &nbsp;'.$pcr_charge_to, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '34', 'Attn', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '34', ': &nbsp;'.$pcr_attention, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '38', 'Cc ', 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '25', '38', ': &nbsp;'.$pcr_cc, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '46', 'PMI DM '.$pcr_debit_credit_no, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '50', 'Document # &nbsp;'.$pmicr_control_no, 0, 0, 0, true, 'L', false);
$pdf->writeHTMLCell(0, '', '8', '54', 'Issued Date &nbsp;'.date("F d, Y",strtotime($pcr_date)), 0, 0, 0, true, 'L', false);

$pdf->writeHTMLCell(286, '', '8', '64', 'CREDIT', 0, 0, 0, true, 'R', false);
$pdf->writeHTMLCell(267, '', '8', '64', 'DEBIT', 0, 0, 0, true, 'R', false);
if($pcr_type==1){
	$pdf->writeHTMLCell(0, '', '23', '62', 'Summary of <b>Debit</b> Memo for the month of '.date("F",strtotime($pcr_date)).' '.date("Y",strtotime($pcr_date)).'', 0, 0, 0, true, 'L', false);
	$pdf->Image('dist/img/checked.png','259.4', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('dist/img/unchecked.png','259.4', '64.5', 3, 3, '', '', '', true, 150, '', false, false, 1, false, false, false);
}
if($pcr_type==2){
	$pdf->writeHTMLCell(0, '', '23', '62', 'Summary of <b>Credit</b> Memo for the month of '.$month.' '.$year.'', 0, 0, 0, true, 'L', false);
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
				<td style="width:78px;border:1px solid black;text-align:center;"><br><br><b>In-Charge Section</b></td>
				<td style="width:108px;border:1px solid black;text-align:center;"><br><br><b> Material/Product Name</b></td>
				<td style="width:77px;border:1px solid black;text-align:center;"><br><br><b>Detail</b></td>
				<td style="width:62px;border:1px solid black;text-align:center;"><b>Billing Summary</b></td>
				<td style="width:67px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Material Qty./ Sorting Qty.</b></td>
				<td style="width:69px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Tact Time/ Minutes</b></td>
				<td style="width:69px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Material Unit Price/ Cost/pc.</b></td>
				<td style="width:68px;border:1px solid black;text-align:center;background-color:#13a529;color:#fcfcfc;"><b>Total Amnt.(USD)</b></td>
				<td style="width:68px;border:1px solid black;text-align:center;background-color:#ff9d00;"><b>Transport Total Amnt.(USD)</b></td>
				<td style="width:68px;border:1px solid black;text-align:center;background-color:#fffa00;"><b>Total Amnt.(USD)</b></td>
				<td style="width:75px;border:1px solid black;text-align:center;"><b>Detail of Indication</b></td>
				<td style="width:66px;border:1px solid black;text-align:center;"><br><br><b>Supplier Name</b></td>
				<td style="width:70px;border:1px solid black;text-align:center;"><b>YEC Billing Request</b></td>
				<td style="width:66px;border:1px solid black;text-align:center;"><br><br><b>Category</b></td>	
			</tr>
		</thead>
		<tbody>';
$table 	   					= 't_pmi_cr_content';
$array_fields 				= array('*');
$joins 	   					= '';
$sql_where 					= "WHERE pmicrc_control_no='".$pmicr_control_no."' && logdel=0";
$sql_order 					= 'ORDER BY pmicrc_id ASC';
$sql_limit 					= '';
$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
$ctr 						= 0;
$count						= 1;
$total_material_sorting_qty = 0;
$total_manhours 			= 0;
$total_materials 			= 0;
$l 							= 0;
$total_amount 				= 0;
$row_count 					= $result->num_rows;
while($row 	= mysqli_fetch_array($result)){
	$total_material_sorting_qty = $total_material_sorting_qty+$row['pmicrc_qty'];
	$total_amount = $total_amount+$row['pmicrc_amount'];
	$table_content .='<tr style="font-size:8px;">';
	$table_content .='<td style="height:30px;width:20px;border:1px solid black;text-align:center;">'.$count.'</td>';
	$table_content .='<td style="width:78px;border:1px solid black;text-align:left;">'.$pcr_incharge_section.'</td>';
	$table_content .='<td style="width:108px;border:1px solid black;text-align:left;">'.$row['pmicrc_item_name'].'</td>';
	$table_content .='<td style="width:77px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:62px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:67px;border:1px solid black;text-align:right;">'.number_format($row['pmicrc_qty']).'</td>';
	$table_content .='<td style="width:69px;border:1px solid black;text-align:right;"></td>';
	$table_content .='<td style="width:69px;border:1px solid black;text-align:right;">'.$row['pmicrc_unit_price'].'</td>';
	$table_content .='<td style="width:68px;border:1px solid black;text-align:right;">'.number_format($row['pmicrc_amount'],2,'.',',').'</td>';
	$table_content .='<td style="width:68px;border:1px solid black;text-align:right;"></td>';
	switch($ctr){
		// case 3:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">35.45</td>';
		// 	break;
		// case 5:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">4.83</td>';
		// 	break;
		// case 6:
		// 	$table_content .='<td style="width:58px;border:1px solid black;text-align:right;">2.78</td>';
		// 	break;
		default:
			$table_content .='<td style="width:68px;border:1px solid black;text-align:right;">'.number_format($row['pmicrc_amount'],2,'.',',').'</td>';
			break;
	}//example//set row value here//another switch statement if multiple columns 
	$table_content .='<td style="width:75px;border:1px solid black;text-align:left;"></td>';
	$table_content .='<td style="width:66px;border:1px solid black;text-align:left;"></td>';
	if($row['pcrdc_yec_billing']=='Debit'){
		$table_content .='<td style="width:70px;border:1px solid black;text-align:center;background-color:#020BED;color:#FFFDFE;"></td>';
	}	
	else if($row['pcrdc_yec_billing']=='Invoice'){
		$table_content .='<td style="width:70px;border:1px solid black;text-align:center;background-color:#FB0100;color:#FFFDFE;"></td>';
	}
	else{
		$table_content .='<td style="width:70px;border:1px solid black;text-align:left;"></td>';
	}	
	switch($ctr){
		// case 0:
		// 	$table_content .='<td style="width:66px;border:1px solid black;text-align:left;">PPS FLEXICON</td>';
		// 	break;
		// case 1:
		// 	$table_content .='<td style="width:66px;border:1px solid black;text-align:left;">PPS BURN-IN</td>';
		// 	break;
		// case 2:
		// 	$table_content .='<td style="width:66px;border:1px solid black;text-align:left;">PPS FLEXICON</td>';
		// 	break;
		default:
			$table_content .='<td style="width:66px;border:1px solid black;text-align:left;">'.$row['pmicrc_category'].'</td>';
			break;
	}
	$table_content .='</tr>';
	$count++;
	$ctr++;
}
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
$table_content .= '	<td style="border-right:1px solid black;border-bottom:1px solid black;font-weight:bold;">TOTAL</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">'.number_format($total_material_sorting_qty).'</td>';
$table_content .= '	<td style="border:1px solid black;"></td>';
$table_content .= '	<td style="border:1px solid black;"></td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;"></td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 8,775.96</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;"></td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 8,775.96</td>';
$table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ '.number_format($total_amount,2,'.',',').'</td>';
// $table_content .= '	<td style="border:1px solid black;text-align:right;font-weight:bold;">$ 107,766.76</td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;"></td>';
$table_content .= '	<td style="border-bottom:1px solid black;border-right:1px solid black;"></td>';
$table_content .= '</tr>';
$table_content .= '</tbody></table>';

$count_what     = 'pmicrc_amount';
$table          = 't_pmi_cr_content';
$joins          = '';
$sql_where      = 'WHERE pmicrc_control_no="'.$pmicr_control_no.'" AND logdel=0 AND pmicrc_item_type=1';
$sql_order      = '';
$sql_limit      = '';
$as_ano         = 'manpower_total_amount';
$result         = PMICR::getInstance()->select_sum_query($count_what,$table,$joins,$sql_where,$sql_order,$sql_limit,$as_ano);
if($row = mysqli_fetch_array($result)){
    $manpower_total_amount = $row['manpower_total_amount'];
}
else{
    $manpower_total_amount = 0;
}

$count_what     = 'pmicrc_amount';
$table          = 't_pmi_cr_content';
$joins          = '';
$sql_where      = 'WHERE pmicrc_control_no="'.$pmicr_control_no.'" AND logdel=0 AND pmicrc_item_type=2';
$sql_order      = '';
$sql_limit      = '';
$as_ano         = 'machine_tools_total_amount';
$result         = PMICR::getInstance()->select_sum_query($count_what,$table,$joins,$sql_where,$sql_order,$sql_limit,$as_ano);
if($row = mysqli_fetch_array($result)){
    $machine_tools_total_amount = $row['machine_tools_total_amount'];
}
else{
    $machine_tools_total_amount = 0;
}

$count_what     = 'pmicrc_amount';
$table          = 't_pmi_cr_content';
$joins          = '';
$sql_where      = 'WHERE pmicrc_control_no="'.$pmicr_control_no.'" AND logdel=0 AND pmicrc_item_type=3';
$sql_order      = '';
$sql_limit      = '';
$as_ano         = 'material_total_amount';
$result         = PMICR::getInstance()->select_sum_query($count_what,$table,$joins,$sql_where,$sql_order,$sql_limit,$as_ano);
if($row = mysqli_fetch_array($result)){
    $material_total_amount = $row['material_total_amount'];
}
else{
    $manpower_total_amount = 0;
}

$count_what     = 'pmicrc_amount';
$table          = 't_pmi_cr_content';
$joins          = '';
$sql_where      = 'WHERE pmicrc_control_no="'.$pmicr_control_no.'" AND logdel=0 AND pmicrc_item_type=4';
$sql_order      = '';
$sql_limit      = '';
$as_ano         = 'other_total_amount';
$result         = PMICR::getInstance()->select_sum_query($count_what,$table,$joins,$sql_where,$sql_order,$sql_limit,$as_ano);
if($row = mysqli_fetch_array($result)){
    $other_total_amount = $row['other_total_amount'];
}
else{
    $other_total_amount = 0;
}

$total_total = floatval($manpower_total_amount)+floatval($machine_tools_total_amount)+floatval($material_total_amount)+floatval($other_total_amount);
$pdf->SetFont('helvetica', '', 6);
$table_content = $table_content.'<br>
	<table>
		<tbody>
		 <tr style="font-size:9px;white-space:nowrap;">
		  <td style="text-align:left;font-size:9px;width:620px;">';
if($pcr_charge_to_location==2){		  
	$table_content = $table_content.'<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Note: Important reminders please generate debit memo on per division section in-charge <br>	
	  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Example: If the instruction is from YEC QC the content of Debit Memo should be intended only for YEC-QC <br>								
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction is from YEC Eng`g the content of Debit Memo should be intended only for YEC-Eng`g <br>	
	   <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Here`s How to distinguish the special instruction to be address of Debit Memo per section: <br>					
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction control no. start with: TSH-XXX -> It means the charging is intended only for YEC-QC section <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If the instruction control no. start with: TDI-XX-XXX -> Please confirm it first to Ms.Nakasato if what section should be charge. <br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There are 4 sections using TDI control no. that`s why it is important to ask first Ms.Nakasato, send her the specific TDI data for her clarification.<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(YEC-Eng`g/YEC-Stamping/YEC-Sales/YEC-PPC)';							
}


$table_content = $table_content.'</td>
		  <td style="text-align:left;width:230px;">
		  	<br><br>
		  	Manpower(man-hours):<br>
		  	Machine Tools/Equipment'.$_GET['add_machtools'].':<br>
		  	Materials'.$_GET['add_materials'].':<br>
		  	Others'.$_GET['add_othrchrges'].':
		  	<hr><br>
		  	<b>TOTAL:</b>
		  </td>
		  <td style="text-align:left;width:78px;">
		  	<br><br>
		  	$ '.number_format($manpower_total_amount,2,'.',',').'<br>
		  	$ '.number_format($machine_tools_total_amount,2,'.',',').'<br>
		  	$ '.number_format($material_total_amount,2,'.',',').'<br>
		  	$ '.number_format($other_total_amount,2,'.',',').'
		  	<hr>
		  	<b>$ '.number_format($total_amount,2,'.',',').'</b>
		  </td>
		 </tr>
		</tbody>
	</table>';
$pdf->writeHTMLCell(0, '', '2', '70', $table_content,0, 0, 0, true, 'C', true);
$pdf->lastPage();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('cr_report_f1.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+