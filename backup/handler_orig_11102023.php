<?php
	if(is_ajax()) {
		if(isset($_POST["action"]) && !empty($_POST["action"])) {
			$action = $_POST["action"];
			switch($action) {
				case "add_signatory" 								: add_signatory(); break;
				case "load_emp_name" 								: load_emp_name(); break;
				case "create_pmi_charging_report"					: create_pmi_charging_report(); break;
				case "edit_role" 									: edit_role(); break;
				case "load_control_number" 							: load_control_number(); break;
				case "load_signatories_select" 						: load_signatories_select(); break;
				case "load_pmicr_update" 							: load_pmicr_update(); break;
				case "update_pmi_charging_report"					: update_pmi_charging_report(); break;
				case "remove_pmicr_content" 						: remove_pmicr_content(); break;
				case "create_pmi_charging_report_bydept"			: create_pmi_charging_report_bydept(); break;
				case "fn_signatories_val" 							: fn_signatories_val(); break;
				case "update_pmi_charging_report_bydept" 			: update_pmi_charging_report_bydept(); break;
				case "add_pmi_charging_report_bydept_content"		: add_pmi_charging_report_bydept_content(); break;
				case "load_pmicr_dept_content_update" 				: load_pmicr_dept_content_update(); break;
				case "update_pmi_charging_report_bydept_content"	: update_pmi_charging_report_bydept_content(); break;
				case "load_pmicr_dept_details"  					: load_pmicr_dept_details(); break;
				case "delete_pmicr"									: delete_pmicr(); break;
			}
		}
	}

	function is_ajax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}

	function update_pmi_charging_report_bydept_content(){
		require_once('query.php'); //OOP Path
		// echo 'here';
		// return;
		$control_no 				= $_POST['control_no'];
		$para_dept					= $_POST['para_dept'];
		$return 					= $_POST; 
		$result 					= "";
		if($return['u_rdo_type']=='2'){
			if($return['u_rdo_include_tta']=='1'){
				$total_amount 	= floatval($return['u_txt_transport_total_amnt']) + floatval($return['u_txt_total_amnt_material']);
			}
			else{
				$total_amount 	= floatval($return['u_txt_total_amnt_material']);
				$return['u_txt_transport_total_amnt'] = '';
			}
		}
		else{
			$total_amount 	= $return['u_txt_total_amnt_manpower'];
		}
		$table        				= "t_pmi_cr_dept_content";
		$array_fields 				= array('pcrdc_manhours','pcrdc_total_amount','pcrdc_category','pcrdc_yec_billing','pcrdc_tta_included','pcrdc_transport_total_amnt','pcrdc_qty_included','pcrdc_type','pcrdc_control_no','pcrdc_incharge_section','pcrdc_detail','pcrdc_material_product_name','pcrdc_billing_summary','pcrdc_sorting_qty','pcrdc_seconds','pcrdc_tact_time','pcrdc_cost_mins','pcrdc_total_amnt_mp','pcrdc_details_of_indication','pcrdc_supplier_name','pcrdc_mt_unit_price','pcrdc_mt_qty','pcrdc_total_amount_mt','pcrdc_department','pcrdc_adate'); //table fields
		$array_values 				= array($return['u_txt_manhours'],$total_amount,$return['u_txt_category'],$return['u_txt_yec_billing'],$return['u_rdo_include_tta'],$return['u_txt_transport_total_amnt'],$return['u_rdo_include_sqty'],$return['u_rdo_type'],$control_no,$return['u_txt_incharge_section'],$return['u_txt_detail'],$return['u_txt_material'],$return['u_txt_billing_summary'],$return['u_txt_sorting_qty'],$return['u_txt_sat_sec'],$return['u_txt_tact_time'],$return['u_txt_cost_mins'],$return['u_txt_total_amnt_manpower'],$return['u_txt_detail_of_indication'],$return['u_txt_supplier'],$return['u_txt_material_unit_price'],$return['u_txt_material_quantity'],$return['u_txt_total_amnt_material'],$para_dept,date("Y-m-d")); //values to be saved
		$pkid 						= $return['hdn_content_id'];
		$result 					= PMICR::getInstance()->update_pmi_charging_report_bydept_content($table,$array_fields,$array_values,$pkid);
		$query 						= PMICR::getInstance()->query_update_pmi_charging_report_bydept_content($table,$array_fields,$array_values,$pkid);
		$return["result"] 			= json_encode($result); //return the the serialize values
		$return["query"] 			= $query; //return the the serialize values
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here
	}

	function load_pmicr_dept_content_update(){
		require_once('query.php'); //OOP Path
		$return 		= $_POST;
		$id				= $_POST['id'];
		$result			= "";
		$array_fields 	= array('*');
		$table 	   		= 't_pmi_cr_dept_content';
		$joins 	   		= '';
		$sql_where 		= "WHERE pcrdc_id='$id' AND logdel='0'";
		$sql_order 		= '';
		$sql_limit 		= '';
		$result 		= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			$return['pcrdc_id'] 							= $row['pcrdc_id'];
			$return['pcrdc_control_no'] 					= $row['pcrdc_control_no'];
			$return['pcrdc_incharge_section'] 				= $row['pcrdc_incharge_section'];
			$return['pcrdc_detail'] 						= $row['pcrdc_detail'];
			$return['pcrdc_material_product_name'] 			= $row['pcrdc_material_product_name'];
			$return['pcrdc_billing_summary'] 				= $row['pcrdc_billing_summary'];
			$return['pcrdc_sorting_qty']					= $row['pcrdc_sorting_qty'];
			$return['pcrdc_seconds']						= $row['pcrdc_seconds'];
			$return['pcrdc_tact_time']						= $row['pcrdc_tact_time'];
			$return['pcrdc_cost_mins'] 						= $row['pcrdc_cost_mins'];
			$return['pcrdc_total_amnt_mp']					= $row['pcrdc_total_amnt_mp'];
			$return['pcrdc_details_of_indication']			= $row['pcrdc_details_of_indication'];
			$return['pcrdc_supplier_name']					= $row['pcrdc_supplier_name'];
			$return['pcrdc_mt_unit_price']					= $row['pcrdc_mt_unit_price'];
			$return['pcrdc_mt_qty']							= $row['pcrdc_mt_qty'];
			$return['pcrdc_total_amount_mt']				= $row['pcrdc_total_amount_mt'];
			$return['pcrdc_department']						= $row['pcrdc_department'];
			$return['pcrdc_adate']							= $row['pcrdc_adate'];
			$return['pcrdc_type'] 							= $row['pcrdc_type'];
			$return['pcrdc_qty_included'] 					= $row['pcrdc_qty_included'];
			$return['pcrdc_sat'] 							= $row['pcrdc_sat'];
			$return['pcrdc_transport_total_amnt'] 			= $row['pcrdc_transport_total_amnt'];
			$return['pcrdc_tta_included'] 					= $row['pcrdc_tta_included'];
			$return['pcrdc_total_amount'] 					= $row['pcrdc_total_amount'];
			$return['pcrdc_yec_billing'] 					= $row['pcrdc_yec_billing'];
			$return['pcrdc_category'] 						= $row['pcrdc_category'];
			$return['pcrdc_manhours'] 						= $row['pcrdc_manhours'];
		}
		$return['result'] = json_encode($result);
		echo json_encode($return);
	}

	function add_pmi_charging_report_bydept_content(){
		require_once('query.php'); //OOP Path
		$para_dept			= $_POST['para_dept'];
		$control_no 		= $_POST['control_no'];
		$return 			= $_POST; 
		$result 			= "";
		if($return['rdo_type']=='2'){
			$return['txt_sorting_qty']			= '';
			$return['txt_seconds']				= '';
			$return['txt_tact_time']			= '';
			$return['txt_cost_mins']			= '';
			$return['txt_total_amnt_manpower']	= '';
			if($return['rdo_include_tta']=='1'){
				$total_amount 	= floatval($return['txt_transport_total_amnt']) + floatval($return['txt_total_amnt_material']);
			}
			else{
				$total_amount 	= floatval($return['txt_total_amnt_material']);
				$return['txt_transport_total_amnt'] = '';
			}
		}
		else{
			$return['txt_material_unit_price']	= '';
			$return['txt_material_quantity']	= '';
			$return['txt_total_amnt_material'] 	= '';
			$total_amount 	= $return['txt_total_amnt_manpower'];
		}
		$table   			= "t_pmi_cr_dept_content"; //table name
		$array_fields 		= array('pcrdc_manhours','pcrdc_total_amount','pcrdc_category','pcrdc_yec_billing','pcrdc_tta_included','pcrdc_transport_total_amnt','pcrdc_qty_included','pcrdc_type','pcrdc_control_no','pcrdc_incharge_section','pcrdc_detail','pcrdc_material_product_name','pcrdc_billing_summary','pcrdc_sorting_qty','pcrdc_seconds','pcrdc_tact_time','pcrdc_cost_mins','pcrdc_total_amnt_mp','pcrdc_details_of_indication','pcrdc_supplier_name','pcrdc_mt_unit_price','pcrdc_mt_qty','pcrdc_total_amount_mt','pcrdc_department','pcrdc_adate'); //table fields
		$array_values 		= array($return['txt_manhours'],$total_amount,$return['txt_category'],$return['txt_yec_billing'],$return['rdo_include_tta'],$return['txt_transport_total_amnt'],$return['rdo_include_sqty'],$return['rdo_type'],$control_no,$return['txt_incharge_section'],$return['txt_detail'],$return['txt_material'],$return['txt_billing_summary'],$return['txt_sorting_qty'],$return['txt_sat_sec'],$return['txt_tact_time'],$return['txt_cost_mins'],$return['txt_total_amnt_manpower'],$return['txt_detail_of_indication'],$return['txt_supplier'],$return['txt_material_unit_price'],$return['txt_material_quantity'],$return['txt_total_amnt_material'],$para_dept,date("Y-m-d")); //values to be saved
		$result				= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
		$query				= PMICR::getInstance()->query_insert_query($table,$array_fields,$array_values);
		$return['query'] 	= $query;
		$return["result"] 	= json_encode($result); 
		echo json_encode($return);
	}

	function update_pmi_charging_report_bydept(){
		require_once('query.php'); //OOP Path
		$return 					= $_POST; 
		$result 					= "";
		$table        				= "t_pmi_cr_dept";
		$array_values 				= array($return['u_txt_pdi_dm'],date("Y-m-d",strtotime($return['u_txt_issued_date'])),$return['u_txt_to'],$return['u_txt_attention'],$return['u_txt_cc'],$return['u_txt_approved_by'],$return['u_txt_approved_by2'],$return['u_txt_noted_by1'],$return['u_txt_noted_by2'],$return['u_txt_prepared_by']);
		$array_fields 				= array('pcrd_pdi_dm','pcrd_issued_date','pcrd_to','pcrd_attention','pcrd_cc','pcrd_approved_by1','pcrd_approved_by2','pcrd_noted_by1','pcrd_noted_by2','pcrd_prepared_by');
		$pkid 						= $return['u_txt_control_no'];
		$result 					= PMICR::getInstance()->update_pmi_charging_report_bydept($table,$array_fields,$array_values,$pkid);
		$return["result"] 			= json_encode($result); //return the the serialize values
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here		
	}

	function load_pmicr_dept_details(){
		require_once('query.php'); //OOP Path
		$return = $_POST;
		$para_id	= $_POST['para_id'];
		$result		= "";
		$array_fields = array('*');
		$table 	   	= 't_pmi_cr_dept';
		$joins 	   	= '';
		$sql_where 	= 'WHERE pcrd_id='.$para_id;
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);

		if($row = mysqli_fetch_array($result)){
			$return['pcrd_no'] 				= $row['pcrd_no']; 
			$return['pcrd_control_no'] 		= $row['pcrd_control_no']; 
			$return['pcrd_to']				= $row['pcrd_to']; 
			$return['pcrd_attention'] 		= $row['pcrd_attention']; 
			$return['pcrd_cc']				= $row['pcrd_cc']; 
			$return['pcrd_approved_by1']	= $row['pcrd_approved_by1']; 
			$return['pcrd_approved_by2']	= $row['pcrd_approved_by2']; 
			$return['pcrd_noted_by1'] 		= $row['pcrd_noted_by1']; 
			$return['pcrd_noted_by2'] 		= $row['pcrd_noted_by2']; 
			$return['pcrd_prepared_by'] 	= $row['pcrd_prepared_by'];
			$return['pcrd_department'] 		= $row['pcrd_department'];
			$return['pcrd_issued_date'] 	= date("M d, Y", strtotime($row['pcrd_issued_date']));
			$return['pcrd_issued_date_og'] 	= $row['pcrd_issued_date'];
			$return['pcrd_pdi_dm']  		= $row['pcrd_pdi_dm'];
		}

		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where = 'WHERE ur_approver_yf=1';
		$sql_order 	= 'ORDER BY ur_id ASC';
		$sql_limit 	= '';
		$ctr_approver = 0;
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		while($row = mysqli_fetch_array($result)){
			$return['flist_approver_id'][$ctr_approver]		= $row['ur_id'];
			$return['flist_approver_name'][$ctr_approver] 	= $row['ur_name'];
			$ctr_approver++;
		}
		$return['ctr_approver'] = $ctr_approver;

		$return['result'] = json_encode($result);
		echo json_encode($return);
	}

	function create_pmi_charging_report_bydept(){
		require_once('query.php'); //OOP Path
		$return 			= $_POST; 
		$para_dept			= $return['para_dept'];
		$result 			= "";	
		$return['another_txt_noted_by'] = $return['another_txt_noted_by'].'';	
		if($return['rdo_type']=='2'){
			$return['txt_sorting_qty']			= '';
			$return['txt_seconds']				= '';
			$return['txt_tact_time']			= '';
			$return['txt_cost_mins']			= '';
			$return['txt_total_amnt_manpower']	= '';
			if($return['rdo_include_tta']=='1'){
				$total_amount 	= floatval($return['txt_transport_total_amnt']) + floatval($return['txt_total_amnt_material']);
			}
			else{
				$total_amount 	= floatval($return['txt_total_amnt_material']);
				$return['txt_transport_total_amnt'] = '';
			}
		}
		else{
			$return['txt_material_unit_price']	= '';
			$return['txt_material_quantity']	= '';
			$return['txt_total_amnt_material'] 	= '';
			$total_amount 	= $return['txt_total_amnt_manpower'];
		}
		$table   			= "t_pmi_cr_dept"; //table name
		$array_fields 		= array('pcrd_control_no','pcrd_to','pcrd_attention','pcrd_cc','pcrd_issued_date','pcrd_approved_by1','pcrd_approved_by2','pcrd_noted_by1','pcrd_noted_by2','pcrd_prepared_by','pcrd_department','pcrd_adate'); //table fields
		$array_values 		= array($return['txt_control_no'],$return['txt_to'],$return['txt_attention'],$return['txt_cc'],date("Y-m-d",strtotime($return['txt_issued_date'])),$return['txt_approved_by'],$return['another_txt_approved_by'],$return['txt_noted_by'],$return['another_txt_noted_by'],$return['txt_prepared_by'],$para_dept,date("Y-m-d")); //values to be saved
		$result 			= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
		if($return['txt_incharge_section']!=''){
			$table   			= "t_pmi_cr_dept_content"; //table name
			$array_fields 		= array('pcrdc_manhours','pcrdc_total_amount','pcrdc_category','pcrdc_yec_billing','pcrdc_tta_included','pcrdc_transport_total_amnt','pcrdc_qty_included','pcrdc_type','pcrdc_control_no','pcrdc_incharge_section','pcrdc_detail','pcrdc_material_product_name','pcrdc_billing_summary','pcrdc_sorting_qty','pcrdc_seconds','pcrdc_tact_time','pcrdc_cost_mins','pcrdc_total_amnt_mp','pcrdc_details_of_indication','pcrdc_supplier_name','pcrdc_mt_unit_price','pcrdc_mt_qty','pcrdc_total_amount_mt','pcrdc_department','pcrdc_adate'); //table fields
			$array_values 		= array($return['txt_manhours'],$total_amount,$return['txt_category'],$return['txt_yec_billing'],$return['rdo_include_tta'],$return['txt_transport_total_amnt'],$return['rdo_include_sqty'],$return['rdo_type'],$return['txt_control_no'],$return['txt_incharge_section'],$return['txt_detail'],$return['txt_material'],$return['txt_billing_summary'],$return['txt_sorting_qty'],$return['txt_sat_sec'],$return['txt_tact_time'],$return['txt_cost_mins'],$return['txt_total_amnt_manpower'],$return['txt_detail_of_indication'],$return['txt_supplier'],$return['txt_material_unit_price'],$return['txt_material_quantity'],$return['txt_total_amnt_material'],$para_dept,date("Y-m-d")); //values to be saved
			$result				= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
			$return["result"] 	= json_encode($result); 
		}
		echo json_encode($return);
	}
														
	function remove_pmicr_content(){
		require_once('query.php'); //OOP Path
		$pmicrc_id = ''; 
		$return 					= $_POST;
		$control_no 				= $_POST['control_no']; 
		$max_row   = $_POST['max_row'];
		for($s=1;$s<=$max_row;$s++){
			if($return['hdn_pmicrc_id']=='a_remove_existingrow_'.$s){
				$pmicrc_id=$return['hdn_pmicrc_'.$s];
			}
		}
		$new_max_row 				= (int)$max_row-1;
		$result 					= "";
		$table        				= "t_pmi_cr_content";
		$array_values 				= array('2');
		$array_fields 				= array('logdel');
		$pkid 						= $pmicrc_id;
		$result 					= PMICR::getInstance()->remove_pmicr_content($table,$array_fields,$array_values,$pkid);
		$query 						= PMICR::getInstance()->query_remove_pmicr_content($table,$array_fields,$array_values,$pkid);
		$table        				= "t_pmi_charging_report";
		$array_values 				= array($new_max_row);
		$array_fields 				= array('pcr_row_count');
		$pkid 						= $control_no;
		$result 					= PMICR::getInstance()->update_pmi_charging_report($table,$array_fields,$array_values,$pkid);
		$return["query"] 			= $query;
		$return["result"] 			= json_encode($result); //return the the serialize values
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here
	}

	/* function for loading data of pmicr format 1 */
	function load_pmicr_update(){
		require_once('query.php'); //OOP Path
		$return 		= $_POST;
		$control_no		= $return['control_no'];
		$result			= "";
		$array_fields 	= array('*');
		$table 	   		= 't_pmi_charging_report';
		$joins 	   		= '';
		$sql_where 		= "WHERE pcr_control_no='".$control_no."' AND logdel=0";
		$sql_order 		= '';
		$sql_limit 		= '';
		$result 		= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			$return['pcr_charge_to'] 					= $row['pcr_charge_to'];
			$return['pcr_incharge_section']				= $row['pcr_incharge_section'];
			$return['pcr_from'] 						= $row['pcr_from'];
			$return['pcr_attention'] 					= $row['pcr_attention'];
			$return['pcr_cc'] 							= $row['pcr_cc'];
			$return['pcr_date'] 						= $row['pcr_date'];
			$return['pcr_control_no'] 					= $row['pcr_control_no'];
			$return['pcr_debit_credit_no']				= $row['pcr_debit_credit_no'];
			$return['pcr_type']							= $row['pcr_type'];
			$return['pcr_copy_for'] 					= $row['pcr_copy_for'];
			$return['pcr_noted_by']						= $row['pcr_noted_by'];
			$return['pcr_approved_by']					= $row['pcr_approved_by'];
			$return['pcr_dept'] 						= $row['pcr_dept'];
			$return['pcr_row_count']					= $row['pcr_row_count'];
			$return['pcr_charge_to_location']			= $row['pcr_charge_to_location'];
			$return['pcr_type_mh_mp']					= $row['pcr_type_mh_mp'];
		}	
		$array_fields	= array('*');
		$table 	   		= 't_pmi_cr_content';
		$joins 	   		= '';
		$sql_where 		= "WHERE pmicrc_control_no='".$control_no."' AND logdel=0";
		$sql_order 		= '';
		$sql_limit 		= '';
		$result 		= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr_content 	= 0;
		while($row 		= mysqli_fetch_array($result)){
			$return['pmicrc_id'][$ctr_content] 				= $row['pmicrc_id'];
			$return['pmicrc_control_no'][$ctr_content] 		= $row['pmicrc_control_no'];
			$return['pmicrc_reference'][$ctr_content] 		= $row['pmicrc_reference'];
			$return['pmicrc_item_name'][$ctr_content] 		= $row['pmicrc_item_name'];
			$return['pmicrc_qty'][$ctr_content] 			= $row['pmicrc_qty'];
			$return['pmicrc_unit_price'][$ctr_content] 		= $row['pmicrc_unit_price'];
			$return['pmicrc_item_type'][$ctr_content] 		= $row['pmicrc_item_type'];
			$return['pmicrc_amount'][$ctr_content] 			= $row['pmicrc_amount'];
			$return['pmicrc_category'][$ctr_content] 		= $row['pmicrc_category'];

			$ctr_content++;
		}
		$return['ctr_content'] 	= $ctr_content;	
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where 	= 'WHERE ur_notedby_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr_notedby_list = 0;
		while($row = mysqli_fetch_array($result)){
			$return['dl_notedby_name'][$ctr_notedby_list] = $row['ur_name'];
			$ctr_notedby_list++;
		}
		$return['ctr_notedby_list'] = $ctr_notedby_list;
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where 	= 'WHERE ur_approver_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr_approver_list = 0;
		while($row = mysqli_fetch_array($result)){
			$return['dl_approver_name'][$ctr_approver_list] = $row['ur_name'];
			$ctr_approver_list++;
		}
		$return['ctr_approver_list'] = $ctr_approver_list;
		$return['result'] = json_encode($result);
		echo json_encode($return);
	}

	/* function for laoding respective signatories at create PMICR modal at CN, YF, PPS, TS */
	function fn_signatories_val(){
		require_once('query.php'); //OOP Path
		$return 	= $_POST;
		$para_dept	= $_POST['para_dept'];
		$username	= $_POST['username'];
		$result		= "";
		// $return['approver_name'] = 'x';
		$return['noter_name'] = 'x';
		$return['another_noter_name'] = '';
		$return['pmicr_approver'] = 'x';
		$return['pmicr_checker'] = 'x';
		$array_fields = array('*');
		
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		if($para_dept=='cn'){$sql_where = 'WHERE ur_approver_cn=1';}
		if($para_dept=='ts'){$sql_where = 'WHERE ur_approver_ts=1';}
		if($para_dept=='yf'||$para_dept=='pps'){$sql_where = 'WHERE ur_approver_yf=1';}
		if($para_dept=='all'){$sql_where = 'WHERE ur_approver_cn=1';}
		$sql_order 	= 'ORDER BY ur_id ASC';
		$sql_limit 	= '';
		$ctr_approver = 0;
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		while($row = mysqli_fetch_array($result)){
			$return['approver_id'][$ctr_approver]		= $row['ur_id'];
			$return['approver_name'][$ctr_approver] 	= $row['ur_name'];
			$ctr_approver++;
		}
		$return['ctr_approver'] = $ctr_approver;
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		if($para_dept=='cn'){$sql_where = 'WHERE ur_notedby_cn=1';}
		if($para_dept=='ts'){$sql_where = 'WHERE ur_notedby_ts=1';}
		if($para_dept=='yf'){$sql_where = 'WHERE ur_notedby_yf=1';}
		if($para_dept=='pps'){$sql_where = 'WHERE ur_notedby_pps=1';}
		if($para_dept=='all'){$sql_where = 'WHERE ur_notedby_ts=1';}
		$sql_order 	= 'ORDER BY ur_id ASC';
		$sql_limit 	= '';
		$result_noter = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result_noter)){
			$return['noter_id']			= $row['ur_id'];
			$return['noter_name'] 		= 'Ms. Lyn Sunga';
		}					
		$noted_by_count = $result_noter->num_rows;
		$return['noted_by_count'] = $noted_by_count;
		// if($noted_by_count>=2){		
			$table 	   	= 't_user_role';
			$joins 	   	= '';
			$sql_order 	= 'ORDER BY ur_id DESC';
			$sql_limit 	= '';
			$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
			if($row = mysqli_fetch_array($result)){
				$return['another_noter_id'] = $row['ur_id'];
				$return['another_noter_name'] = $row['ur_name'];
			}
		// }
		
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where = 'WHERE ur_approver_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			$return['pmicr_approver_id']	= $row['ur_id'];
			$return['pmicr_approver'] 		= $row['ur_name'];
		}

		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where = 'WHERE ur_checker_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			$return['pmicr_checker_id']		= $row['ur_id'];
			$return['pmicr_checker'] 		= $row['ur_name'];
		}

		$table 			= 'vw_EmpInfo_Rapid';
		$joins 	   		= '';
		$sql_where 		= "WHERE username='".$username."'";
		$sql_order 		= '';
		$sql_limit 		= '';
		$result 		= SYS1_HRIS::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			// if($row['Gender']=='1'){$return['prepared_by']	= 'Mr. '.$row['firstname'].' '.$row['lastname'];}
			// if($row['Gender']=='2'){$return['prepared_by']	= 'Ms. '.$row['firstname'].' '.$row['lastname'];}
			$emp_no 					= $row['EmpNo'];
			$return['user_employee_id']	= $row['EmpNo'];
		}

		// if($username=='jlustado'){
		// 	$return['prepared_by'] = 'Ms. Jessica Lustado';
		// }
		if($username=='mnbalaoing'){
			$return['prepared_by'] = 'Ms. Merry Monarch Balaoing';
		}
		else{
			$table 	   	= 't_user_role';
			$joins 	   	= '';
			$sql_where = "WHERE ur_eid='$emp_no'";
			$sql_order 	= '';
			$sql_limit 	= '';
			$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
			if($row = mysqli_fetch_array($result)){
				$return['prepared_by'] = $row['ur_name'];
			}
			else{
				$table 			= 'vw_EmpInfo_Rapid';
				$joins 	   		= '';
				$sql_where 		= "WHERE username='$username'";
				$sql_order 		= '';
				$sql_limit 		= '';
				$result 		= SYS1_HRIS::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
				if($row = mysqli_fetch_array($result)){
					if($row['Gender']=='1'){$return['prepared_by']	= 'Mr. '.$row['firstname'].' '.$row['lastname'];}
					if($row['Gender']=='2'){$return['prepared_by']	= 'Ms. '.$row['firstname'].' '.$row['lastname'];}
				}
			}			
		}

		$return['result'] = json_encode($result);
		echo json_encode($return);
	}

	/* function for laoding respective signatories at create PMICR modal at main page */
	function load_signatories_select(){
		require_once('query.php'); //OOP Path
		$return = $_POST;
		$para_id	= $_POST['para_id'];
		$result		= "";
		$array_fields = array('*');
		$username		= $_POST['username'];

		$table 			= 'vw_EmpInfo_Rapid';
		$joins 	   		= '';
		$sql_where 		= "WHERE username='$username'";
		$sql_order 		= '';
		$sql_limit 		= '';
		$result 		= SYS1_HRIS::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$query 			= SYS1_HRIS::getInstance()->select_query_script($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			// $return['prepared_by']		= $row['firstname'].' '.$row['lastname'];
			$return['prepared_by_id']	= $row['EmpNo'];
			$emp_no 					= $row['EmpNo'];
		}
		$return['query'] = $query;
		
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where 	= 'WHERE ur_notedby_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr_notedby = 0;
		while($row = mysqli_fetch_array($result)){
			$return['ur_notedby_id'][$ctr_notedby] = $row['ur_id'];
			$return['ur_notedby_name'][$ctr_notedby] = $row['ur_name'];
			$ctr_notedby++;
		}
		$return['ctr_notedby'] = $ctr_notedby;
		
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where 	= 'WHERE ur_approver_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= '';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$ctr_approver = 0;
		while($row = mysqli_fetch_array($result)){
			$return['ur_approver_id'][$ctr_approver] = $row['ur_id'];
			$return['ur_approver_name'][$ctr_approver] = $row['ur_name'];
			$ctr_approver++;
		}
		$return['ctr_approver'] = $ctr_approver;
		
		$table 	   	= 't_user_role';
		$joins 	   	= '';
		$sql_where 	= 'WHERE ur_checker_pmicr=1';
		$sql_order 	= '';
		$sql_limit 	= 'LIMIT 1';
		$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		if($row = mysqli_fetch_array($result)){
			$return['ur_checker_id'] = $row['ur_id'];
			$return['ur_checker_name'] = $row['ur_name'];
		}
		
		if($username=='hermanl'){
			$return['prepared_by'] = 'Ms. Hermidith Manlangit';
		}
		else{
			$table 	   	= 't_user_role';
			$joins 	   	= '';
			$sql_where 	= "WHERE ur_eid='$emp_no' and ur_eid!=''";
			$sql_order 	= '';
			$sql_limit 	= '';
			$result = PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
			if($row = mysqli_fetch_array($result)){
				$return['prepared_by'] = $row['ur_name'];
			}
			else{
				$table 			= 'vw_EmpInfo_Rapid';
				$joins 	   		= '';
				$sql_where 		= "WHERE username='$username'";
				$sql_order 		= '';
				$sql_limit 		= '';
				$result 		= SYS1_HRIS::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
				if($row = mysqli_fetch_array($result)){
					if($row['Gender']=='1'){$return['prepared_by']	= 'Mr. '.$row['firstname'].' '.$row['lastname'];}
					if($row['Gender']=='2'){$return['prepared_by']	= 'Ms. '.$row['firstname'].' '.$row['lastname'];}
				}
			}			
		}
		$return['result'] = json_encode($result);
		echo json_encode($return);
	}

	/* function for creating charging report and content*/
	function create_pmi_charging_report(){
		require_once('query.php'); //OOP Path
		$return 					= $_POST;
		$checked_by 				= $return['checked_by'];
		$prepared_by 				= $return['prepared_by'];
		if($return['txt_amount_1']==''||$return['txt_amount_1']==' '){
			$return['txt_max_row']=0;
		}
		$result 					= "";
		$table   					= "t_pmi_charging_report"; //table name
		$array_fields 				= array('pcr_type_mh_mp','pcr_noted_by','pcr_prepared_by','pcr_checked_by','pcr_charge_to','pcr_from','pcr_attention','pcr_cc','pcr_date','pcr_control_no','pcr_debit_credit_no','pcr_type','pcr_copy_for','pcr_approved_by','pcr_row_count','pcr_dept','pcr_incharge_section','pcr_charge_to_location'); //table fields
		$array_values 				= array($return['pcr_type_mh_mp'],$return['txt_notedby'],$prepared_by,$checked_by,$return['txt_chargeto'],$return['txt_from'],$return['txt_attention'],$return['txt_cc'],date("Y-m-d", strtotime($return['txt_date'])),$return['txt_controlno'],$return['txt_debitorcreditnoteno'],$return['txt_debitorcredit'],$return['txt_copyfor'],$return['txt_approvedby'],$return['txt_max_row'],$return['pcr_dept'],$return['txt_incharge_section'],$return['pcr_where']); //values to be saved
		$result 					= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
		$return["result"] 			= json_encode($result); //return the the serialize values
		$i 							= 0;
		$j 							= 1;
		if($return['txt_amount_1']!=''&&$return['txt_amount_1']!=' '){
			while($i<$return['txt_max_row']){
				$result 			= "";
				$table   			= "t_pmi_cr_content"; //table name
				$array_fields 		= array('pmicrc_reference','pmicrc_item_name','pmicrc_qty','pmicrc_unit_price','pmicrc_amount','pmicrc_item_type','pmicrc_control_no','pmicrc_category'); //table fields
				$array_values 		= array($return['txt_reference_'.$j],$return['txt_itemname_'.$j],$return['txt_qty_'.$j],$return['txt_unitprice_'.$j],$return['txt_amount_'.$j],$return['txt_item_type_'.$j],$return['txt_controlno'],$return['txt_category_'.$j]); //values to be saved
				$result 			= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
				$return["result"] 	= json_encode($result); //return the the serialize values
				$i++;
				$j++;
			}
		}
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here
	}

	/* function for updating charging report and content*/
	function update_pmi_charging_report(){
		require_once('query.php'); //OOP Path
		$checked_by 				= $_POST['checked_by'];
		$prepared_by 				= $_POST['prepared_by'];
		$return 					= $_POST;
		$result 					= "";
		$max_row_count 				= $return['u_txt_max_row'];
		$i 					= 0;
		$j 					= 1;
		if($return['additional_row']!='0'){
			$combined_row_count 	= (int)$max_row_count+(int)$return['additional_row'];
			while($i<$return['additional_row']){
				$result 			= "";
				$table   			= "t_pmi_cr_content"; //table name
				$array_fields 		= array('pmicrc_reference','pmicrc_item_name','pmicrc_qty','pmicrc_unit_price','pmicrc_amount','pmicrc_control_no','pmicrc_adate','pmicrc_item_type','pmicrc_category'); //table fields
				$array_values 		= array($return['i_txt_reference_'.$j],$return['i_txt_itemname_'.$j],$return['i_txt_qty_'.$j],$return['i_txt_unitprice_'.$j],$return['i_txt_amount_'.$j],$return['u_txt_controlno'],date("Y-m-d h:i:s"),$return['i_txt_item_type_'.$j],$return['i_txt_category_'.$j]); //values to be saved
				$result 			= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
				$return["result"] 	= json_encode($result); //return the the serialize values
				$i++;
				$j++;
			}
		}
		else{
			$combined_row_count 	= (int)$max_row_count;
		}
		$table 						= "t_pmi_charging_report";
		$array_fields 				= array('pcr_type_mh_mp','pcr_noted_by','pcr_prepared_by','pcr_checked_by','pcr_charge_to','pcr_from','pcr_attention','pcr_cc','pcr_date','pcr_control_no','pcr_debit_credit_no','pcr_nature_of_charging','pcr_type','pcr_copy_for','pcr_manpower','pcr_machine_tools','pcr_materials','pcr_other_charges','pcr_total_charges','pcr_noted_by','pcr_approved_by','pcr_attachment_justification','pcr_attachment_computation','pcr_attachment_others','pcr_row_count','pcr_adate','pcr_dept','pcr_incharge_section','pcr_charge_to_location'); //table fields
		$array_values 				= array($return['u_pcr_type_mh_mp'],$return['u_txt_notedby'],$prepared_by,$checked_by,$return['u_txt_chargeto'],$return['u_txt_from'],$return['u_txt_attention'],$return['u_txt_cc'],date("Y-m-d", strtotime($return['u_txt_date'])),$return['u_txt_controlno'],$return['u_txt_debitorcreditnoteno'],$return['u_txt_natureofcharging'],$return['u_txt_debitorcredit'],$return['u_txt_copyfor'],$return['u_txt_manpower'],$return['u_txt_machinetools'],$return['u_txt_materials'],$return['u_txt_othercharges'],$return['u_txt_totalcharges'],$return['u_txt_notedby'],$return['u_txt_approvedby'],$return['u_chk_justification'],$return['u_chk_computation'],$return['u_chk_others'],$combined_row_count,date("Y-m-d h:i:s"),$return['u_pcr_dept'],$return['u_txt_incharge_section'],$return['u_pcr_where']); //values to be saved
		$pkid 						= $return['u_hidden_txt_controlno'];
		$result 					= PMICR::getInstance()->update_pmi_charging_report($table,$array_fields,$array_values,$pkid);
		$return['sd'] 				= PMICR::getInstance()->query_update_pmi_charging_report($table,$array_fields,$array_values,$pkid);
		$return["result"] 			= json_encode($result); //return the the serialize values
		$z 							= 0;
		$a 							= 1;
		while($z<$return['u_txt_max_row']){
			$result 			= "";
			$table   			= "t_pmi_cr_content"; 
			$array_fields 		= array('pmicrc_reference','pmicrc_item_name','pmicrc_qty','pmicrc_unit_price','pmicrc_amount','pmicrc_control_no','pmicrc_adate','pmicrc_item_type','pmicrc_category'); 
			$array_values 		= array($return['u_txt_reference_'.$a],$return['u_txt_itemname_'.$a],$return['u_txt_qty_'.$a],$return['u_txt_unitprice_'.$a],$return['u_txt_amount_'.$a],$return['u_txt_controlno'],date("Y-m-d h:i:s"),$return['u_txt_item_type_'.$a],$return['u_txt_category_'.$a]); //values to be saved
			$pkid 				= $return['u_pmicrc_id_'.$a];
			$result 			= PMICR::getInstance()->update_pmicr_content($table,$array_fields,$array_values,$pkid);
			$return["result"] 	= json_encode($result); 
			$z++;
			$a++;
		}	
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here
	}

	/* function for editing signatory roles */
	function edit_role(){
		require_once('query.php'); //OOP Path
		$return 					= $_POST; 
		$result 					= "";

		// if($return['hdn_status_of_pmicrapprover']!='null'&&($return['cbx_pmic_approver']=='1')){
		// 		$table        				= "t_user_role";
		// 		$array_values 				= array('0');
		// 		$array_fields 				= array('ur_approver_pmicr');
		// 		$pkid 						= $return['hdn_status_of_pmicrapprover'];
		// 		$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
		// }

		if($return['hdn_status_of_pmicrchecker']!='null'&&($return['cbx_pmic_checker']=='1')){
				$table        				= "t_user_role";
				$array_values 				= array('0');
				$array_fields 				= array('ur_checker_pmicr');
				$pkid 						= $return['hdn_status_of_pmicrchecker'];
				$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
				// $table        				= "t_user_role";
				// $array_values 				= array($return['cbx_pmic_checker']);
				// $array_fields 				= array('ur_checker_pmicr');
				// $pkid 						= $return['txt_ur_id'];
				// $result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
		}

		$table        				= "t_user_role";
		$array_values 				= array($return['cbx_pmic_noter'],$return['cbx_ts_approver'],$return['cbx_cn_approver'],$return['cbx_yf_approver'],$return['cbx_ts_noter'],$return['u_txt_emp_name'],$return['u_txt_emp_title'],$return['cbx_pmic_checker'],$return['cbx_pmic_approver']);
		$array_fields 				= array('ur_notedby_pmicr','ur_approver_ts','ur_approver_cn','ur_approver_yf','ur_notedby_ts','ur_name','ur_title','ur_checker_pmicr','ur_approver_pmicr');
		$pkid 						= $return['txt_ur_id'];
		$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);


		$signa = explode('-',$return['hdn_status_of_signatories1']);
		

			if($return['cbx_ts_approver']=='1'||$return['cbx_cn_approver']=='1'||$return['cbx_yf_approver']=='1'){

				$table        				= "t_user_role";
				$array_values 				= array('1','1','1');
				$array_fields 				= array('ur_approver_ts','ur_approver_cn','ur_approver_yf');
				$pkid 						= $return['txt_ur_id'];
				$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
			}

		$array_fields = array('ur_notedby_ts','ur_notedby_cn','ur_notedby_yf');
		$array_values = array($return['cbx_ts_noter'],$return['cbx_cn_noter'],$return['cbx_yf_noter']);
		$pkid = $return['txt_ur_id'];
		$result = PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
			if($return['cbx_ts_noter_2']=='1'){
				$table        				= "t_user_role";
				$array_values 				= array('0');
				$array_fields 				= array('ur_notedby_ts');
				$pkid 						= $return['hdn_status_of_signatories2'];
				$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);

				$table        				= "t_user_role";
				$array_values 				= array($return['cbx_ts_noter_2']);
				$array_fields 				= array('ur_notedby_ts');
				$pkid 						= $return['txt_ur_id'];
				$result 					= PMICR::getInstance()->update_role($table,$array_fields,$array_values,$pkid);
			}
		

		$return["result"] 			= json_encode($result); //return the the serialize values
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here
	}

	/* function for loading employee names */
	function load_emp_name(){
		require_once('query.php');
		$return 					= $_POST;
		$return['emp_name'] 		= '';
		$result 					= "";
		$array_fields 				= array('*');
		$table 	   					= 'vw_EmpInfo_Rapid';
		$joins 	   					= '';
		$sql_where 					= 'WHERE EmpNo="'.$return['txt_emp_no'].'"';
		$sql_order 					= '';
		$sql_limit 					= '';
		$result 					= SYS1_HRIS::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);

		if($row = mysqli_fetch_array($result)){
			$return['emp_name'] = $row['firstname'].' '.$row['lastname']; 
		}
	
		$return['result'] 			= json_encode($result);
		echo json_encode($return);
	}

	/* function for adding signatory */
	function add_signatory(){
		require_once('query.php'); 
		$return 					= $_POST; 
		$result 					= "";
		$table   					= "t_user_role"; 
		$array_fields 				= array('ur_id','ur_eid','ur_name','ur_title'); 
		$array_values 				= array('',$return['txt_emp_no'],$return['txt_emp_name'],$return['txt_emp_title']); 
		$result 					= PMICR::getInstance()->insert_query($table,$array_fields,$array_values);
		$return["result"] 			= json_encode($result); 
		echo json_encode($return); 
	}

	/* function for editing signatory roles */
	function load_control_number(){
		require_once('query.php'); //OOP Path
		$return 					= $_POST;
		$result						= "";
		$month_now 					= date("m");
		$month_int 					= (int)$month_now;
		$year_now  					= date("Y");
		$year  						= substr( $year_now, -2);
		$array_fields 				= array('*');
		$table 	   					= 't_pmi_charging_report';
		$joins 	   					= '';
		$sql_where 					= "WHERE Month(pcr_date)=$month_int AND SUBSTRING(pcr_control_no,5,4)='".$year.$month_now."' AND logdel=0";
		$sql_order 					= '';
		$sql_limit 					= '';
		$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$monthly_count_pmi			= $result->num_rows;
		while($row = mysqli_fetch_array($result)){
			$control_numbers_tomonth[$ctr] = $row['pcr_control_no']; 
			$ctr++;
		}
		$table 	   					= 't_pmi_cr_dept';
		$joins 	   					= '';
		$sql_where 					= "WHERE Month(pcrd_adate)=$month_int AND SUBSTRING(pcrd_control_no,5,4)='".$year.$month_now."' AND logdel=0";
		$sql_order 					= '';
		$sql_limit 					= '';
		$result 					= PMICR::getInstance()->select_query($array_fields,$table,$joins,$sql_where,$sql_order,$sql_limit);
		$monthly_count_dept 		= $result->num_rows;
		while($row = mysqli_fetch_array($result)){
			$control_numbers_tomonth[$ctr] = $row['pcrd_control_no']; 
			$ctr++;
		}
		$control_count_base			= $monthly_count_pmi+$monthly_count_dept+1;
		$control_count				= str_pad($control_count_base, 3, "0", STR_PAD_LEFT);
		$control_number 			= 'PMI-'.$year.$month_now.'-'.$control_count;

		$x = 1;
		if(in_array($control_number, $control_numbers_tomonth)){
			while($x!=0){
			    $control_count_base = $control_count_base+1;
				$control_count	= str_pad($control_count_base, 3, "0", STR_PAD_LEFT);
			    $control_number = 'PMI-'.$year.$month_now.'-'.$control_count;
			    if(in_array($control_number, $control_numbers_tomonth)){
			    	$x = 1;
			    }
			    else{
			    	$x = 0;
			    }
			}
		}
		$return['control_number']	= $control_number;
		$return['result'] 			= json_encode($result);
		echo json_encode($return);
	}

	function delete_pmicr(){
		require_once('query.php'); //OOP Path
		$return 					= $_POST; 
		$result 					= "";
		$pkid 						= $return['control_no'];
		$result 					= PMICR::getInstance()->delete_pmicr_query($pkid);
		echo json_encode($return); //json encode since I used a dataType json before passing the serialized values here	
	}
?>