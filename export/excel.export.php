<?php
if(	isset($_POST['chk_ts_export'])||
	isset($_POST['chk_cn_export'])||
	isset($_POST['chk_yf_export'])||
	// isset($_POST['chk_pps_export'])|| // ! OLD CODE
	isset($_POST['chk_ppd_ts_export'])|| // CHAN - 01-30-2025
	isset($_POST['chk_ppd_cn_export'])|| // CHAN - 01-30-2025
	isset($_POST['chk_pm_export'])
){
		$excel_class = 'class/excel.php';

		if(isset($_POST['hdn_date_range_export'])){
			$daterange = explode(' - ',$_POST['hdn_date_range_export']);
		}


		if(file_exists($excel_class)){
			include($excel_class);
		}
		else{
			echo 'File '.$excel_class.' does not exist';
			exit;
		}

		$excel = new EXCEL;
		/* set title */
		$excel->title = 'PMICR('.date("M", strtotime($daterange[0])).')';
		/* add a new page */
		$excel->add_page();
		/* use the default font style */
		$excel->set_default_font_style();
		/* select an active page */
		$excel->set_active_sheet(0);

		/* set width - Array Cells, Array Width */
		$array_cell = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$array_width = array('5','18','15','11','25','30','30','13','13','15','13','15','13','15','15','15','20','20','20','20','20','20','20','20','20','20');
		$excel->set_width($array_cell,$array_width);

		/* set height - Array Rows, Array Height */
		$array_row = array('12');
		$array_height = array(49);
		$excel->set_height($array_row,$array_height);

		/* borders - Cell, Left, Right, Top, Bottom */
		$excel->set_borders('A11:U11',1,1,1,1);
		$excel->set_borders('A12:U12',1,1,1,1);

		/* set font - cell, bold, color, size, style */
		$excel->set_font('A1',true,'','',18,'Lucida Fax');
		$excel->set_font('A11',true,'','',14,'Lucida Fax');
		$excel->set_font('A12:U12',true,'','C9DAE2',12,'Lucida Fax');
		$excel->set_font('U8:X8',true,'','',12,'Lucida Fax');
		$excel->set_font('L12:O12',true,'','',12,'Lucida Fax');
		$excel->merge_cells('A1:T1');
		$excel->merge_cells('A11:U11');
		$excel->merge_cells('A2:P10');
		// $excel->merge_cells('R6:S9');
		// $excel->merge_cells('T6:U9');
		// $excel->merge_cells('R10:S10');
		// $excel->merge_cells('T10:U10');
		$excel->set_font('I12',true,'fcfcfc','074fc1',12,'Lucida Fax');
		$excel->set_font('J12',true,'fcfcfc','074fc1',12,'Lucida Fax');
		$excel->set_font('K12',true,'fcfcfc','074fc1',12,'Lucida Fax');
		$excel->set_font('L12',true,'fcfcfc','13a529',12,'Lucida Fax');
		$excel->set_font('M12',true,'fcfcfc','13a529',12,'Lucida Fax');
		$excel->set_font('N12',true,'fcfcfc','13a529',12,'Lucida Fax');
		$excel->set_font('O12',true,'fcfcfc','13a529',12,'Lucida Fax');
		$excel->set_font('P12',true,'','ff9d00',12,'Lucida Fax');
		$excel->set_font('Q12',true,'','fffa00',12,'Lucida Fax');

		$excel->place_value('A1','PMI Charging Report','string','left',false);
		$excel->place_value('A11','PMI Charging Summary Report ('.date("F d, Y", strtotime($daterange[0])).' to '.date("F d, Y", strtotime($daterange[1])).')','string','center',false);
		$excel->place_value('A12','No.','string','center',true);
		$excel->place_value('B12','DMA Control','string','center',true);
		$excel->place_value('C12','Control No','string','center',true);
		$excel->place_value('D12','Issued Date','string','center',true);
		$excel->place_value('E12','In-Charge Section','string','center',true);
		$excel->place_value('F12','Material/Product Code/Name','string','center',true);
		$excel->place_value('G12','Detail','string','center',true);
		$excel->place_value('H12','Billing Summary','string','center',true);
		$excel->place_value('I12','Material Unit Price','string','center',true);
		$excel->place_value('J12','Material Qty.','string','center',true);
		$excel->place_value('K12','Total Amount','string','center',true);
		$excel->place_value('L12','Sorting Qty.','string','center',true);
		$excel->place_value('M12','Tact Time/ Minutes','string','center',true);
		$excel->place_value('N12','Cost/ Mins.','string','center',true);
		$excel->place_value('O12','Total Amount','string','center',true);
		$excel->place_value('P12','Transport Total Amount','string','center',true);
		$excel->place_value('Q12','Total Amount (Transport Included)','string','center',true);
		$excel->place_value('R12','Detail of Indication','string','center',true);
		$excel->place_value('S12','Supplier Name','string','center',true);
		$excel->place_value('T12','YEC Billing Request','string','center',true);
		$excel->place_value('U12','Category','string','center',true);
		// $excel->place_value('R5','TS','string','center',false);
		// $excel->place_value('S5','CN','string','center',false);
		// $excel->place_value('T5','YF','string','center',false);
		// $excel->place_value('U5','PPS','string','center',false);
		// $excel->set_borders('R5',1,1,1,1);	
		// $excel->set_borders('S5',1,1,1,1);	
		// $excel->set_borders('T5',1,1,1,1);	
		// $excel->set_borders('U5',1,1,1,1);	
		// $excel->set_borders('R6:S9',1,1,1,0);	
		// $excel->set_borders('T6:U9',1,1,1,0);	
		// $excel->set_borders('R10:S10',1,1,0,1);	
		// $excel->set_borders('T10:U10',1,1,0,1);	
		// $excel->place_value('R10','PPC General Manager','string','center',false);
		// $excel->place_value('R6','Approved by: Rosalinda Sunga','string','center',false);
		// $excel->place_value('T10','PPC Clerk','string','center',false);
		// $excel->place_value('T6','Prepared by: Marie De Guzman','string','center',false);
		require_once('../query.php');
		$result						= "";
		$total_mt_qty 				= 0;
		$total_mt_amnt 				= 0;
		$total_mp_qty 				= 0;
		$total_mp_amnt 				= 0;
		$total_transpo 				= 0;
		$total_total_amount			= 0;
		$table 	   					= 't_pmi_cr_dept_content';
		$array_fields 				= array('*');
		$joins 	   					= 'INNER JOIN t_pmi_cr_dept ON t_pmi_cr_dept_content.pcrdc_control_no=t_pmi_cr_dept.pcrd_control_no';
		$sql_where 	= "WHERE t_pmi_cr_dept_content.logdel='0'";
		if(isset($_POST['chk_ts_export'])){
			$depts[0] 	.= "'ts'";
		}
		if(isset($_POST['chk_cn_export'])){
			$depts[1] 	.= "'cn'";
		}
		if(isset($_POST['chk_yf_export'])){
			$depts[2] 	.= "'yf'";
		}
		if(isset($_POST['chk_ppd_ts_export'])){ // CHAN - 01-30-2025
			$depts[3] 	.= "'ppd-ts'";
		}
		if(isset($_POST['chk_ppd_cn_export'])){ // CHAN - 01-30-2025
			$depts[4] 	.= "'ppd-cn'";
		}
		// if(isset($_POST['chk_pps_export'])){ // ! OLD CODE
		// 	$depts[3] 	.= "'pps'";
		// }
		$sql_where .= " AND pcrdc_department IN (".implode(',',$depts).")";
		$sql_where .= " AND pcrdc_adate BETWEEN '".date('Y-m-d', strtotime($daterange[0]))."' AND '".date('Y-m-d', strtotime($daterange[1]))."'";
		$sql_order 					= 'ORDER BY pcrdc_id ASC';
		$sql_limit 					= '';
		$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$query_select_query 		= PMICR::getInstance()->query_select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr 						= 13;
		$no 						= 1;
		$row_count					= $result->num_rows;
		$t_material_qty 			= 0;
		$t_material_amount 			= 0;
		$t_manhour_amount 			= 0;
		$t_sorting_qty 				= 0;
		$t_transpo					= 0;
		$t_total_amount 			= 0;
		while($row 	= mysqli_fetch_array($result)){
			$array_row = array($ctr);
			$array_height = array(44);
			$excel->set_height($array_row,$array_height);
			if($row['pcrdc_type']=='2'){$row['pcrdc_cost_mins']='';}
			$excel->place_value('A'.$ctr,$no,'string','center',true);
			$excel->place_value('B'.$ctr,$row['pcrd_pdi_dm'],'string','center',true);
			$excel->place_value('C'.$ctr,$row['pcrdc_control_no'],'string','center',true);	
			$excel->place_value('D'.$ctr,date("M d, Y",strtotime($row['pcrd_issued_date'])),'string','center',true);	
			$excel->place_value('E'.$ctr,$row['pcrdc_incharge_section'],'string','left',true);	
			// $excel->place_value('F'.$ctr,$row['pcrdc_material_product_name'],'string','left',true);	
			$excel->place_value('F'.$ctr,$row['pcrdc_material_product_code']."\n".$row['pcrdc_material_product_name'],'string','left',true);	
			$excel->place_value('G'.$ctr,$row['pcrdc_detail'],'string','left',true);	
			$excel->place_value('H'.$ctr,$row['pcrdc_billing_summary'],'string','left',true);	
			$excel->place_value('I'.$ctr,$row['pcrdc_mt_unit_price'],'string','right',true);	
			$excel->place_value('J'.$ctr,$row['pcrdc_mt_qty'],'number_0_decimal','right',true);	
			$excel->place_value('K'.$ctr,number_format($row['pcrdc_total_amount_mt'],2,'.',''),'number_2_decimal','right',true);	
			$excel->place_value('L'.$ctr,$row['pcrdc_sorting_qty'],'number_0_decimal','right',true);
			$excel->place_value('M'.$ctr,number_format($row['pcrdc_tact_time'],2,'.',','),'number_2_decimal','right',true);	
			$excel->place_value('N'.$ctr,$row['pcrdc_cost_mins'],'string','right',true);	
			$excel->place_value('O'.$ctr,number_format($row['pcrdc_total_amnt_mp'],2,'.',''),'number_2_decimal','right',true);	
			$excel->place_value('P'.$ctr,number_format($row['pcrdc_transport_total_amnt'],2,'.',''),'number_2_decimal','right',true);	
			$excel->place_value('Q'.$ctr,number_format($row['pcrdc_total_amount'],2,'.',''),'number_2_decimal','right',true);	
			$excel->place_value('R'.$ctr,$row['pcrdc_details_of_indication'],'string','left',true);
			$excel->place_value('S'.$ctr,$row['pcrdc_supplier_name'],'string','left',true);	
			$excel->place_value('T'.$ctr,$row['pcrdc_yec_billing'],'string','center',true);	
			$excel->place_value('U'.$ctr,$row['pcrdc_category'],'string','left',true);	

			$t_material_qty 			= $t_material_qty+$row['pcrdc_mt_qty'];
			$t_material_amount 			= $t_material_amount+$row['pcrdc_total_amount_mt'];
			$t_sorting_qty				= $t_sorting_qty+$row['pcrdc_sorting_qty'];
			$t_transpo 					= $t_transpo+$row['pcrdc_transport_total_amnt'];
			$t_manhour_amount 			= $t_manhour_amount+$row['pcrdc_total_amnt_mp'];
			$t_total_amount 			= $t_total_amount+$row['pcrdc_total_amount'];

			$excel->set_borders('A'.$ctr,1,1,1,1);
			$excel->set_borders('B'.$ctr,1,1,1,1);	
			$excel->set_borders('C'.$ctr,1,1,1,1);	
			$excel->set_borders('D'.$ctr,1,1,1,1);	
			$excel->set_borders('E'.$ctr,1,1,1,1);		
			$excel->set_borders('F'.$ctr,1,1,1,1);	
			$excel->set_borders('G'.$ctr,1,1,1,1);	
			$excel->set_borders('H'.$ctr,1,1,1,1);	
			$excel->set_borders('I'.$ctr,1,1,1,1);	
			$excel->set_borders('J'.$ctr,1,1,1,1);	
			$excel->set_borders('K'.$ctr,1,1,1,1);
			$excel->set_borders('L'.$ctr,1,1,1,1);
			$excel->set_borders('M'.$ctr,1,1,1,1);	
			$excel->set_borders('N'.$ctr,1,1,1,1);	
			$excel->set_borders('O'.$ctr,1,1,1,1);	
			$excel->set_borders('P'.$ctr,1,1,1,1);		
			$excel->set_borders('Q'.$ctr,1,1,1,1);	
			$excel->set_borders('R'.$ctr,1,1,1,1);	
			$excel->set_borders('S'.$ctr,1,1,1,1);	
			$excel->set_borders('T'.$ctr,1,1,1,1);	
			$excel->set_borders('U'.$ctr,1,1,1,1);	
			$excel->set_font('A'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('B'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('C'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('D'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('E'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('F'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('G'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('H'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('I'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('J'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('K'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('L'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('M'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('N'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('O'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('P'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('Q'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('R'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('S'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('T'.$ctr,false,'','',12,'Lucida Fax');
			$excel->set_font('U'.$ctr,false,'','',12,'Lucida Fax');
			$ctr++;
			$no++;
		}

		if(isset($_POST['chk_pm_export'])){
			$table 	   					= 't_pmi_cr_content';
			$array_fields 				= array('*');
			$joins 	   					= 'INNER JOIN t_pmi_charging_report ON t_pmi_cr_content.pmicrc_control_no=t_pmi_charging_report.pcr_control_no';
			$sql_where 					= "WHERE t_pmi_cr_content.logdel='0'";
			$sql_where 		.= " AND t_pmi_charging_report.pcr_date BETWEEN '".date('Y-m-d', strtotime($daterange[0]))."' AND '".date('Y-m-d', strtotime($daterange[1]))."'";
			$sql_order 					= 'ORDER BY t_pmi_cr_content.pmicrc_id ASC';
			$sql_limit 					= '';
			$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
			$query_select_query 		= PMICR::getInstance()->query_select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
			$row_count2					= $result->num_rows;
			$row_count					= $row_count+$row_count2;
			while($row 	= mysqli_fetch_array($result)){
				$array_row = array($ctr);
				$array_height = array(25);
				$excel->set_height($array_row,$array_height);
				$excel->place_value('A'.$ctr,$no,'string','center',true);
				$excel->place_value('B'.$ctr,$row['pcr_debit_credit_no'],'string','center',true);	
				$excel->place_value('C'.$ctr,$row['pmicrc_control_no'],'string','center',true);	
				$excel->place_value('D'.$ctr,date("M d, Y",strtotime($row['pcr_date'])),'string','center',true);	
				$excel->place_value('E'.$ctr,' ','string','left',true);	
				$excel->place_value('F'.$ctr,$row['pcr_incharge_section'],'string','left',true);	
				$excel->place_value('G'.$ctr,$row['pmicrc_item_name'],'string','left',true);	
				$excel->place_value('H'.$ctr,' ','string','left',true);	
				$excel->place_value('I'.$ctr,' ','string','right',true);	
				$excel->place_value('J'.$ctr,' ','string','right',true);	
				$excel->place_value('K'.$ctr,' ','string','right',true);	
				$excel->place_value('L'.$ctr,$row['pmicrc_qty'],'string','right',true);
				$excel->place_value('M'.$ctr,' ','string','right',true);	
				$excel->place_value('N'.$ctr,$row['pmicrc_unit_price'],'string','right',true);	
				$excel->place_value('O'.$ctr,$row['pmicrc_amount'],'number_2_decimal','right',true);	
				$excel->place_value('P'.$ctr,' ','string','right',true);	
				$excel->place_value('Q'.$ctr,$row['pmicrc_amount'],'number_2_decimal','right',true);	
				$excel->place_value('R'.$ctr,' ','string','left',true);
				$excel->place_value('S'.$ctr,' ','string','left',true);	
				$excel->place_value('T'.$ctr,' ','string','center',true);	
				$excel->place_value('U'.$ctr,$row['pmicrc_category'],'string','left',true);	

				$t_sorting_qty				= $t_sorting_qty+$row['pmicrc_qty'];
				$t_manhour_amount 			= $t_manhour_amount+$row['pmicrc_amount'];
				$t_total_amount 			= $t_total_amount+$row['pmicrc_amount'];

				$excel->set_borders('A'.$ctr,1,1,1,1);
				$excel->set_borders('B'.$ctr,1,1,1,1);	
				$excel->set_borders('C'.$ctr,1,1,1,1);	
				$excel->set_borders('D'.$ctr,1,1,1,1);	
				$excel->set_borders('E'.$ctr,1,1,1,1);		
				$excel->set_borders('F'.$ctr,1,1,1,1);	
				$excel->set_borders('G'.$ctr,1,1,1,1);	
				$excel->set_borders('H'.$ctr,1,1,1,1);	
				$excel->set_borders('I'.$ctr,1,1,1,1);	
				$excel->set_borders('J'.$ctr,1,1,1,1);	
				$excel->set_borders('K'.$ctr,1,1,1,1);
				$excel->set_borders('L'.$ctr,1,1,1,1);
				$excel->set_borders('M'.$ctr,1,1,1,1);	
				$excel->set_borders('N'.$ctr,1,1,1,1);	
				$excel->set_borders('O'.$ctr,1,1,1,1);	
				$excel->set_borders('P'.$ctr,1,1,1,1);		
				$excel->set_borders('Q'.$ctr,1,1,1,1);	
				$excel->set_borders('R'.$ctr,1,1,1,1);	
				$excel->set_borders('S'.$ctr,1,1,1,1);	
				$excel->set_borders('T'.$ctr,1,1,1,1);	
				$excel->set_borders('U'.$ctr,1,1,1,1);	
				$excel->set_font('A'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('B'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('C'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('D'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('E'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('F'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('G'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('H'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('I'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('J'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('K'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('L'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('M'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('N'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('O'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('P'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('Q'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('R'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('S'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('T'.$ctr,false,'','',12,'Lucida Fax');
				$excel->set_font('U'.$ctr,false,'','',12,'Lucida Fax');
				$ctr++;
				$no++;
			}
		}
		if($row_count=='0'){
			$excel->set_borders('A'.$ctr,1,0,0,1);
			$excel->set_borders('B'.$ctr,0,0,0,1);
			$excel->set_borders('C'.$ctr,0,0,0,1);
			$excel->set_borders('D'.$ctr,0,0,0,1);
			$excel->set_borders('E'.$ctr,0,0,0,1);
			$excel->set_borders('F'.$ctr,0,0,0,1);
			$excel->set_borders('G'.$ctr,0,0,0,1);
			$excel->set_borders('H'.$ctr,0,0,0,1);
			$excel->set_borders('I'.$ctr,0,0,0,1);
			$excel->set_borders('J'.$ctr,0,0,0,1);
			$excel->set_borders('K'.$ctr,0,0,0,1);
			$excel->set_borders('L'.$ctr,0,0,0,1);
			$excel->set_borders('M'.$ctr,0,0,0,1);
			$excel->set_borders('N'.$ctr,0,0,0,1);
			$excel->set_borders('O'.$ctr,0,0,0,1);
			$excel->set_borders('P'.$ctr,0,0,0,1);
			$excel->set_borders('Q'.$ctr,0,0,0,1);
			$excel->set_borders('R'.$ctr,0,0,0,1);
			$excel->set_borders('S'.$ctr,0,0,0,1);
			$excel->set_borders('T'.$ctr,0,0,0,1);
			$excel->set_borders('U'.$ctr,0,1,0,1);
			$excel->merge_cells('A'.$ctr.":".'T'.$ctr);
			$excel->place_value('A'.$ctr,'No data!','string','center',false);
			$excel->set_font('A'.$ctr.':'.'T'.$ctr,true,'','E83338',11,'Lucida Fax');
			$ctr++;
		}
		$excel->merge_cells('A'.$ctr.":".'C'.$ctr);
		$excel->place_value('A'.$ctr,'TOTAL:','string','left',false);
		$excel->place_value('J'.$ctr,$t_material_qty,'number_2_decimal','right',false);
		$excel->place_value('K'.$ctr,$t_material_amount,'number_2_decimal','right',false);
		$excel->place_value('L'.$ctr,$t_sorting_qty,'number_2_decimal','right',false);
		$excel->place_value('O'.$ctr,$t_manhour_amount,'number_2_decimal','right',false);
		$excel->place_value('P'.$ctr,$t_transpo,'number_2_decimal','right',false);
		$excel->place_value('Q'.$ctr,$t_total_amount,'number_2_decimal','right',false);
		$excel->set_font('J'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('K'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('L'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('O'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('P'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('Q'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_font('A'.$ctr,true,'','',12,'Lucida Fax');
		$excel->set_borders('A'.$ctr,1,0,0,1);
		$excel->set_borders('B'.$ctr,0,0,0,1);
		$excel->set_borders('C'.$ctr,0,0,0,1);
		$excel->set_borders('D'.$ctr,0,0,0,1);
		$excel->set_borders('E'.$ctr,0,0,0,1);
		$excel->set_borders('F'.$ctr,0,0,0,1);
		$excel->set_borders('G'.$ctr,0,0,0,1);
		$excel->set_borders('H'.$ctr,0,0,0,1);
		$excel->set_borders('I'.$ctr,0,0,0,1);
		$excel->set_borders('J'.$ctr,0,0,0,1);
		$excel->set_borders('K'.$ctr,0,0,0,1);
		$excel->set_borders('L'.$ctr,0,0,0,1);
		$excel->set_borders('M'.$ctr,0,0,0,1);
		$excel->set_borders('N'.$ctr,0,0,0,1);
		$excel->set_borders('O'.$ctr,0,0,0,1);
		$excel->set_borders('P'.$ctr,0,0,0,1);
		$excel->set_borders('Q'.$ctr,0,0,0,1);
		$excel->set_borders('R'.$ctr,0,0,0,1);
		$excel->set_borders('S'.$ctr,0,0,0,1);
		$excel->set_borders('T'.$ctr,0,1,0,1);
		$ctr++;
		$ctr++;
		$excel->merge_cells('A'.$ctr.":".'F'.$ctr);
		$excel->place_value('A'.$ctr,'Generated by PMI Charging Report System','string','left',false);
		$excel->set_font('A'.$ctr,false,'','',12,'Lucida Fax');

		$filename = "PMI Charging Report ".date("M-d-y hi");

		$excel->output($filename,'2003');
}
else{
		echo  "<script type='text/javascript'>";
		echo "alert('Choose a department to include!');";
		echo "this.window.close();";
		echo "</script>";
}