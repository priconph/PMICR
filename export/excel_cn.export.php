<?php
		$excel_class = 'class/excel.php';

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
		$array_width = array('5','12','11','11','18','13','19','13','13','15','13','15','13','15','15','15','20','20','20','20','20','20','20','20','20','20');
		$excel->set_width($array_cell,$array_width);

		/* set height - Array Rows, Array Height */
		$array_row = array('12');
		$array_height = array(43);
		$excel->set_height($array_row,$array_height);

		/* borders - Cell, Left, Right, Top, Bottom */
		$excel->set_borders('A11:T11',1,1,1,1);
		$excel->set_borders('A12:T12',1,1,1,1);

		/* set font - cell, bold, color, size, style */
		$excel->set_font('A1',true,'','',18,'Lucida Fax');
		$excel->set_font('A11',true,'','',14,'Lucida Fax');
		$excel->set_font('A12:T12',true,'','C9DAE2',11,'Lucida Fax');
		$excel->set_font('U8:X8',true,'','',11,'Lucida Fax');
		$excel->set_font('L12:O12',true,'','',11,'Lucida Fax');
		$excel->merge_cells('A1:T1');
		$excel->merge_cells('A11:T11');
		$excel->merge_cells('A2:P10');
		// $excel->merge_cells('Q6:R9');
		// $excel->merge_cells('S6:T9');
		// $excel->merge_cells('Q10:R10');
		// $excel->merge_cells('S10:T10');
		$excel->set_font('H12',true,'fcfcfc','074fc1',11,'Lucida Fax');
		$excel->set_font('I12',true,'fcfcfc','074fc1',11,'Lucida Fax');
		$excel->set_font('J12',true,'fcfcfc','074fc1',11,'Lucida Fax');
		$excel->set_font('K12',true,'fcfcfc','13a529',11,'Lucida Fax');
		$excel->set_font('L12',true,'fcfcfc','13a529',11,'Lucida Fax');
		$excel->set_font('M12',true,'fcfcfc','13a529',11,'Lucida Fax');
		$excel->set_font('N12',true,'fcfcfc','13a529',11,'Lucida Fax');
		$excel->set_font('O12',true,'','ff9d00',11,'Lucida Fax');
		$excel->set_font('P12',true,'','fffa00',11,'Lucida Fax');

		$excel->place_value('A1','PMI Charging Report','string','left',false);
		$excel->place_value('A11','PMI Charging Summary Report','string','center',false);
		$excel->place_value('A12','No.','string','center',true);
		$excel->place_value('B12','Control No','string','center',true);
		$excel->place_value('C12','Issued Date','string','center',true);
		$excel->place_value('D12','In-Charge Section','string','center',true);
		$excel->place_value('E12','Material/Product Name','string','center',true);
		$excel->place_value('F12','Detail','string','center',true);
		$excel->place_value('G12','Billing Summary','string','center',true);
		$excel->place_value('H12','Material Unit Price','string','center',true);
		$excel->place_value('I12','Material Qty.','string','center',true);
		$excel->place_value('J12','Total Amount','string','center',true);
		$excel->place_value('K12','Sorting Qty.','string','center',true);
		$excel->place_value('L12','Tact Time/ Minutes','string','center',true);
		$excel->place_value('M12','Cost/ Mins.','string','center',true);
		$excel->place_value('N12','Total Amount','string','center',true);
		$excel->place_value('O12','Transport Total Amount','string','center',true);
		$excel->place_value('P12','Total Amount (Transport Included)','string','center',true);
		$excel->place_value('Q12','Detail of Indication','string','center',true);
		$excel->place_value('R12','Supplier Name','string','center',true);
		$excel->place_value('S12','YEC Billing Request','string','center',true);
		$excel->place_value('T12','Category','string','center',true);
		// $excel->place_value('Q5','TS','string','center',false);
		// $excel->place_value('R5','CN','string','center',false);
		// $excel->place_value('S5','YF','string','center',false);
		// $excel->place_value('T5','PPS','string','center',false);
		// $excel->set_borders('Q5',1,1,1,1);	
		// $excel->set_borders('R5',1,1,1,1);	
		// $excel->set_borders('S5',1,1,1,1);	
		// $excel->set_borders('T5',1,1,1,1);	
		// $excel->set_borders('Q6:R9',1,1,1,0);	
		// $excel->set_borders('S6:T9',1,1,1,0);	
		// $excel->set_borders('S10:T10',1,1,0,1);	
		// $excel->set_borders('Q10:R10',1,1,0,1);	
		// $excel->place_value('Q10','PPC General Manager','string','center',false);
		// $excel->place_value('Q6','Approved by: Rosalinda Sunga','string','center',false);
		// $excel->place_value('S10','PPC Clerk','string','center',false);
		// $excel->place_value('S6','Prepared by: Marie De Guzman','string','center',false);
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
		$sql_where 					= "WHERE t_pmi_cr_dept_content.logdel='0' AND pcrdc_control_no='".$_GET['control_no']."'";
		$sql_order 					= '';
		$sql_limit 					= '';
		$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$query_select_query 		= PMICR::getInstance()->query_select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr 						= 13;
		$no 						= 1;
		$row_count					= $result->num_rows;
		while($row 	= mysqli_fetch_array($result)){
			$array_row = array($ctr);
			$array_height = array(25);
			$excel->set_height($array_row,$array_height);
			if($row['pcrdc_type']=='2'){$row['pcrdc_cost_mins']='';}
			$total_mt_qty 				= $total_mt_qty+(int)$row['pcrdc_mt_qty'];
			$total_mp_qty 				= $total_mp_qty+(int)$row['pcrdc_sorting_qty'];
			$total_mt_amnt 				= $total_mt_amnt+floatval($row['pcrdc_total_amount_mt']);
			$total_mp_amnt 				= $total_mp_amnt+floatval($row['pcrdc_total_amnt_mp']);
			$total_transpo 				= $total_transpo+floatval($row['pcrdc_transport_total_amnt']);
			$total_total_amount			= $total_total_amount+floatval($row['pcrdc_total_amount']);
			$excel->place_value('A'.$ctr,$no,'string','center',true);
			$excel->place_value('B'.$ctr,$row['pcrdc_control_no'],'string','center',true);	
			$excel->place_value('C'.$ctr,$row['pcrd_issued_date'],'string','center',true);	
			$excel->place_value('D'.$ctr,$row['pcrdc_incharge_section'],'string','left',true);	
			$excel->place_value('E'.$ctr,$row['pcrdc_material_product_name'],'string','left',true);	
			$excel->place_value('F'.$ctr,$row['pcrdc_detail'],'string','left',true);	
			$excel->place_value('G'.$ctr,$row['pcrdc_billing_summary'],'string','left',true);	
			$excel->place_value('H'.$ctr,$row['pcrdc_mt_unit_price'],'string','right',true);	
			$excel->place_value('I'.$ctr,number_format($row['pcrdc_mt_qty']),'string','right',true);	
			$excel->place_value('J'.$ctr,number_format($row['pcrdc_total_amount_mt'],2,'.',','),'string','right',true);	
			$excel->place_value('K'.$ctr,number_format($row['pcrdc_sorting_qty']),'string','right',true);
			$excel->place_value('L'.$ctr,number_format($row['pcrdc_tact_time'],2,'.',','),'string','right',true);	
			$excel->place_value('M'.$ctr,$row['pcrdc_cost_mins'],'string','right',true);	
			$excel->place_value('N'.$ctr,number_format($row['pcrdc_total_amnt_mp'],2,'.',','),'string','right',true);	
			$excel->place_value('O'.$ctr,number_format($row['pcrdc_transport_total_amnt'],2,'.',','),'string','right',true);	
			$excel->place_value('P'.$ctr,number_format($row['pcrdc_total_amount'],2,'.',','),'string','right',true);	
			$excel->place_value('Q'.$ctr,$row['pcrdc_details_of_indication'],'string','left',true);
			$excel->place_value('R'.$ctr,$row['pcrdc_supplier_name'],'string','left',true);	
			$excel->place_value('S'.$ctr,$row['pcrdc_yec_billing'],'string','center',true);	
			$excel->place_value('T'.$ctr,$row['pcrdc_category'],'string','left',true);	
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
			$excel->set_font('A'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('B'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('C'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('D'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('E'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('F'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('G'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('H'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('I'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('J'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('K'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('L'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('M'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('N'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('O'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('P'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('Q'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('R'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('S'.$ctr,false,'','',10,'Lucida Fax');
			$excel->set_font('T'.$ctr,false,'','',10,'Lucida Fax');
			$ctr++;
			$no++;
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
			$excel->set_borders('T'.$ctr,0,1,0,1);
			$excel->merge_cells('A'.$ctr.":".'T'.$ctr);
			$excel->place_value('A'.$ctr,'No data!','string','center',false);
			$excel->set_font('A'.$ctr.':'.'T'.$ctr,true,'','E83338',11,'Lucida Fax');
			$ctr++;
		}
		$excel->merge_cells('A'.$ctr.":".'C'.$ctr);
		$excel->set_font('I'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('J'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('K'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('N'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('O'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('P'.$ctr,true,'','',11,'Lucida Fax');
		$excel->set_font('A'.$ctr,true,'','',11,'Lucida Fax');
		$excel->place_value('A'.$ctr,'TOTAL:','string','left',false);
		$excel->place_value('I'.$ctr,number_format($total_mt_qty),'string','right',false);
		$excel->place_value('J'.$ctr,'$ '.number_format($total_mt_amnt,2,'.',','),'string','right',false);
		$excel->place_value('K'.$ctr,number_format($total_mp_qty),'string','right',false);
		$excel->place_value('N'.$ctr,'$ '.number_format($total_mp_amnt,2,'.',','),'string','right',false);
		$excel->place_value('O'.$ctr,'$ '.number_format($total_transpo,2,'.',','),'string','right',false);
		$excel->place_value('P'.$ctr,'$ '.number_format($total_total_amount,2,'.',','),'string','right',false);
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
		/* output excel - filename, excel version (2003,2007) */

		// $excel->place_value('R5','CN ✓','string','center',false);
		// $excel->set_font('R5',true,'','B4B4B4',11,'Lucida Fax');
		$excel->output($filename,'2003');
?>