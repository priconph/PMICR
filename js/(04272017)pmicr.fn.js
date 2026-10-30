var handler = "handler.php";

var t_main = $('#t_main').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/pmi_charging_report.php",
		scrollY: "74%",
		scrollX: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"DESC"]],
		responsive: true
	});

var t_summary_report = $('#t_summary_report').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/pmi_summary_report.php",
		scrollCollapse: false,
		scrollX: true,
		scrollY: "74%",
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

var t_cn = $('#t_cn').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/cr_cn_dept.php",
		scrollY: "74%",
		scrollX: false,
		scrollCollapse: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

var t_yf = $('#t_yf').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/cr_yf_dept.php",
		scrollY: "74%",
		scrollX: false,
		scrollCollapse: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

var t_ts = $('#t_ts').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/cr_ts_dept.php",
		scrollY: "74%",
		scrollX: false,
		scrollCollapse: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

var t_pps = $('#t_pps').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/cr_pps_dept.php",
		scrollY: "74%",
		scrollX: false,
		scrollCollapse: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

var t_signatories = $('#t_signatories').DataTable({ 
		//paginate:true,
		"ajax" : "./server-side/signatories.php",
		scrollY: "74%",
		scrollX: false,
		scrollCollapse: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});

$('#t_main tbody').on('dblclick','tr',function(){
	var id 			= $(this).find('td:eq(0) input').val();
	var control_no 	= $(this).find('td:eq(4)').text();
	var data = {
		"action"		: "load_pmicr_update",
		"control_no"	: control_no
	}
	data = $.param(data);	
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			if(control_no!==''){
				$('#modal_update_pmi').modal('show');
			}			
			$('#content_loop').empty();
			$('input[name=u_txt_chargeto]').val(data['pcr_charge_to']);
			$('input[name=u_txt_attention]').val(data['pcr_attention']);
			$('input[name=u_txt_date]').val(data['pcr_date']);
			$('input[name=u_txt_cc]').val(data['pcr_cc']);
			$('input[name=u_txt_controlno]').val(data['pcr_control_no']);
			$('input[name=u_txt_debitorcreditnoteno]').val(data['pcr_debit_credit_no']);
			$('input[name=u_txt_natureofcharging]').val(data['pcr_nature_of_charging']);
			$('input[name=u_txt_max_row]').val(data['pcr_row_count']);
			$('input[name=u_txt_manpower]').val('');
			$('input[name=u_txt_machinetools]').val('');
			$('input[name=u_txt_materials]').val('');
			$('input[name=u_txt_othercharges]').val('');
			$('input[name=u_txt_totalcharges]').val('');
			$('input[name=chk_justification]').prop("checked",false);
			$('input[name=chk_computation]').prop("checked",false);
			$('input[name=chk_others]').prop("checked",false);
			$('#noted_by').empty();
			$('select[name=u_txt_debitorcredit]').empty();
			if(data['pcr_type']=='1'){
				var htmd = '<option value="1">Debit Note No.</option><option value="2">Credit Note No.</option>';
			}
			if(data['pcr_type']=='2'){
				var htmd = '<option value="2">Credit Note No.</option><option value="1">Debit Note No.</option>';
			}
			$('select[name=u_txt_debitorcredit]').append(htmd);
			var ctr_notedby_list = data['ctr_notedby_list'];
			if(data['pcr_noted_by']==''){var noted_by_list  = '<option value="" selected>None</option>';}
			else{var noted_by_list  = '<option value="'+data['pcr_noted_by']+'" selected>'+data['pcr_noted_by']+'</option>';}
			for(var r=0;r<ctr_notedby_list;r++){
				if(data['pcr_noted_by']!=data['dl_notedby_name'][r]){noted_by_list += '<option value="'+data['dl_notedby_name'][r]+'">'+data['dl_notedby_name'][r]+'</option>';}
			}
			noted_by_list += '<option value="">None</option>';
			$('#noted_by').append(noted_by_list);
			$('#approved_by').empty();
			var ctr_approver_list = data['ctr_approver_list'];
			var approver_list  = '<option value="'+data['pcr_approved_by']+'" selected>'+data['pcr_approved_by']+'</option>';
			for(var q=0;q<ctr_approver_list;q++){
				if(data['pcr_approved_by']!=data['dl_approver_name'][q]){approver_list += '<option value="'+data['dl_approver_name'][q]+'">'+data['dl_approver_name'][q]+'</option>';}
			}
			approver_list += '<option value="">None</option>';
			$('#approved_by').append(approver_list);	
			var j = 0;

			for(var i=1;i<=data['pcr_row_count'];i++){
				var html  = '<tr class="col-md-12" style="text-align:center;" id="row'+i+'">';
				html += '	<td class="col-md-3">';
				html += '		<input type="text" name="u_pmicrc_id_'+i+'"  id="u_pmicrc_id_'+i+'" value="'+data['pmicrc_id'][j]+'" hidden><input class="form-control" value="'+data['pmicrc_reference'][j]+'" type="text" name="u_txt_reference_'+i+'">';
				html += '	</td>';
				html += '	<td class="col-md-2">';
				html += '		<input class="form-control" value="'+data['pmicrc_item_name'][j]+'" type="text" name="u_txt_itemname_'+i+'">';
				html += '	</td>';
				html += '	<td class="col-md-2">';
				html += '		<input class="form-control decimal" value="'+data['pmicrc_qty'][j]+'" type="text" style="text-align:right;" placeholder="Quantity" name="u_txt_qty_'+i+'">';
				html += '	</td>';
				html += '	<td class="col-md-2">';
				html += '		<input class="form-control decimal" value="'+data['pmicrc_unit_price'][j]+'" type="text" style="text-align:right;" placeholder="0.0000" name="u_txt_unitprice_'+i+'">';
				html += '	</td>';
				html += '	<td class="col-md-2">';
				html += '		<input class="form-control decimal" value="'+data['pmicrc_amount'][j]+'" type="text" style="text-align:right;" placeholder="0.00" name="u_txt_amount_'+i+'">';
				html += '	</td>';
				html += '	<td class="col-md-1">';
				html += '		<a id="a_remove_existingrow_'+i+'"><i class="fa fa-close pointer" style="margin-top:22%;"></i></a>';
				html += '	</td>';
				html += '</tr>';
				$('#content_loop').append(html);
				$('#modal_body_content').append('<input name="hdn_pmicrc_'+i+'" value="'+data['pmicrc_id'][j]+'" type="hidden">');

				$('#a_remove_existingrow_'+i).click(function(){
					$('#modal_confirm_remove_existingrow').modal('show');
					$('input[name=hdn_pmicrc_id]').val($(this).attr('id'));
				});
				j++;			 
			}
			for(var d=1;d<=data['pcr_row_count'];d++){
				$('input[name=u_txt_max_row]').val(d);
				fn_get_amount();
			}
			if(data['pcr_manpower']!=""&&data['pcr_manpower']!=" "&&data['pcr_manpower']!="0"){
				$('input[name=u_txt_manpower]').val(data['pcr_manpower']);
			}
			if(data['pcr_machine_tools']!=""&&data['pcr_machine_tools']!=" "&&data['pcr_machine_tools']!="0"){
				$('input[name=u_txt_machinetools]').val(data['pcr_machine_tools']);
			}
			if(data['pcr_materials']!=""&&data['pcr_materials']!=" "&&data['pcr_materials']!="0"){
				$('input[name=u_txt_materials]').val(data['pcr_materials']);
			}
			if(data['pcr_other_charges']!=""&&data['pcr_other_charges']!=" "&&data['pcr_other_charges']!="0"){
				$('input[name=u_txt_othercharges]').val(data['pcr_other_charges']);
			}
			if(data['pcr_total_charges']!=""&&data['pcr_total_charges']!=" "&&data['pcr_total_charges']!="0"){
				$('input[name=u_txt_totalcharges]').val(data['pcr_total_charges']);
			}
			if(data['pcr_attachment_justification']=='1'){$('input[name=u_chk_justification]').prop("checked",true);}
			if(data['pcr_attachment_computation']=='1'){$('input[name=u_chk_computation]').prop("checked",true);}
			if(data['pcr_attachment_others']=='1'){$('input[name=u_chk_others]').prop("checked",true);}			
			fn_num_with_dot();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER(load_pmicr_update)!');
		}
	});
});

$('#t_ts tbody').on('dblclick','tr',function(){
	var id = $(this).find('td:eq(0) input').val();
	var control_no = $(this).find('td:eq(2)').text();
	console.log(id);
	if(control_no!==''){
		window.location.href='./index.php?page=pmicr_click_table_ts.php&id='+id+'&control_no='+control_no;
	}
});

$('#t_cn tbody').on('dblclick','tr',function(){
	var id = $(this).find('td:eq(0) input').val();
	var control_no = $(this).find('td:eq(2)').text();
	console.log(id);
	if(control_no!==''){
		window.location.href='./index.php?page=pmicr_click_table_cn.php&id='+id+'&control_no='+control_no;
	}
});

$('#t_yf tbody').on('dblclick','tr',function(){
	var id = $(this).find('td:eq(0) input').val();
	var control_no = $(this).find('td:eq(2)').text();
	console.log(id);
	if(control_no!==''){
		window.location.href='./index.php?page=pmicr_click_table_yf.php&id='+id+'&control_no='+control_no;
	}
});

$('#t_pps tbody').on('dblclick','tr',function(){
	var id = $(this).find('td:eq(0) input').val();
	var control_no = $(this).find('td:eq(2)').text();
	console.log(id);
	if(control_no!==''){
		window.location.href='./index.php?page=pmicr_click_table_pps.php&id='+id+'&control_no='+control_no;
	}
});

$('#t_signatories tbody').on('dblclick','tr',function(){
	$('input[name=cbx_pmic_approver]').prop('checked',false);
	$('input[name=cbx_pmic_checker]').prop('checked',false);
	$('input[name=cbx_ts_approver]').prop('checked',false);
	$('input[name=cbx_cn_approver]').prop('checked',false);
	$('input[name=cbx_yf_approver]').prop('checked',false);
	$('input[name=cbx_ts_noter]').prop('checked',false);
	$('input[name=cbx_cn_noter]').prop('checked',false);
	$('input[name=cbx_yf_noter]').prop('checked',false);
	var id = $(this).find('td:eq(0) input').val();
	var name = $(this).find('td:eq(0)').text();
	var title = $(this).find('td:eq(1)').text();
	var column_2 = $(this).find('td:eq(2)').text();
	var column_3 = $(this).find('td:eq(3)').text();
	var column_4 = $(this).find('td:eq(4)').text();
	var column_5 = $(this).find('td:eq(5)').text();
	var column_6 = $(this).find('td:eq(6)').text();
	var column_7 = $(this).find('td:eq(7)').text();
	var column_8 = $(this).find('td:eq(8)').text();
	// var column_9 = $(this).find('td:eq(9)').text();

	if(column_2=='Yes'){$('input[name=cbx_pmic_approver]').prop('checked',true);}
	if(column_3=='Yes'){$('input[name=cbx_pmic_checker]').prop('checked',true);}
	if(column_4=='Yes'){$('input[name=cbx_pmic_noter]').prop('checked',true);}
	if(column_5=='Yes'){$('input[name=cbx_ts_approver]').prop('checked',true);
						$('input[name=cbx_yf_approver]').prop('checked',true);
						$('input[name=cbx_cn_approver]').prop('checked',true);}
	if(column_6=='Yes'){$('input[name=cbx_ts_noter]').prop('checked',true);}
	if(column_7=='Yes'){$('input[name=cbx_cn_noter]').prop('checked',true);}
	if(column_8=='Yes'){$('input[name=cbx_yf_noter]').prop('checked',true);}
	// if(column_7=='Yes'){}
	// if(column_8=='Yes'){}
	// if(column_9=='Yes'){}

	$('#modal_edit_role').modal('show');
	$('#input_ur_id').val(id);
	$('#input_ur_name').val(name);
	$('input[name=u_txt_emp_title]').val(title);
});

$('#t_content_cn tbody').on('dblclick','tr',function(){
	var id 			= $(this).find('td:eq(0) input').val();
	var data = {
		"action"		: "load_pmicr_dept_content_update",
		"id" 			: id
	}
	data = $.param(data);
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			$('#mdl_update_content').modal('show');
			if(data['pcrdc_type']=='1'){
				$('#u_rdo_item_material').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",true);
				$('#u_cont_items_manpower').prop("hidden",false);
				$('#u_rdo_item_manpower').prop("checked",true);
			}
			if(data['pcrdc_type']=='2'){
				$('#u_rdo_item_manpower').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",false);
				$('#u_cont_items_manpower').prop("hidden",true);
				$('#u_rdo_item_material').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='1'){
				$('#u_rdo_not_tta').prop("checked",false);
				$('#u_rdo_included_tta').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='0'){
				$('#u_rdo_not_tta').prop("checked",true);
				$('#u_rdo_included_tta').prop("checked",false);
			}
			$('input[name=u_txt_incharge_section]').val(data['pcrdc_incharge_section']);
			$('input[name=u_txt_material]').val(data['pcrdc_material_product_name']);
			$('input[name=u_txt_detail]').val(data['pcrdc_detail']);
			$('input[name=u_txt_billing_summary]').val(data['pcrdc_billing_summary']);
			$('input[name=u_txt_material_unit_price]').val(data['pcrdc_mt_unit_price']);
			$('input[name=u_txt_material_quantity]').val(data['pcrdc_mt_qty']);
			$('input[name=u_txt_total_amnt_material]').val(data['pcrdc_total_amount_mt']);
			$('input[name=u_txt_transport_total_amnt]').val(data['pcrdc_transport_total_amnt']);
			$('input[name=u_txt_sorting_qty]').val(data['pcrdc_sorting_qty']);
			$('input[name=u_txt_seconds]').val(data['pcrdc_seconds']);
			$('input[name=u_txt_tact_time]').val(data['pcrdc_tact_time']);
			$('input[name=u_txt_cost_mins]').val(data['pcrdc_cost_mins']);
			
			$('input[name=u_txt_total_amnt_manpower]').val(data['pcrdc_total_amnt_mp']);
			$('input[name=u_txt_detail_of_indication]').val(data['pcrdc_details_of_indication']);
			$('input[name=u_txt_supplier]').val(data['pcrdc_supplier_name']);
			$('input[name=hdn_content_id]').val(data['pcrdc_id']);
			$('input[name=u_txt_category]').val(data['pcrdc_category']);
			$('#u_txt_yec_billing').empty();
			if(data['pcrdc_yec_billing']=='Debit'){
				var htmz =  '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']=='Invoice'){
				var htmz =  '<option value="Invoice">Invoice</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']==''){
				var htmz =  '<option value="">None</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
			}
			$('#u_txt_yec_billing').append(htmz);
			if(data['pcrdc_billing_summary']==''){
				var htmg = '<option value="">None</option>';			
			}
			else{
				var htmg = '<option value="'+data['pcrdc_billing_summary']+'">'+data['pcrdc_billing_summary']+'</option>';
			}
			if(data['pcrdc_billing_summary']!=''){ htmg += '<option value="">None</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Material NG)'){ htmg += '<option value="Parts Costs (Material NG)">Parts Costs (Material NG)</option>';}
			if(data['pcrdc_billing_summary']!='Sorting Cost'){ htmg += '<option value="Sorting Costs">Sorting Costs</option>';}
			if(data['pcrdc_billing_summary']!='Transport Cost'){ htmg += '<option value="Transport Costs">Transport Costs</option>';}
			if(data['pcrdc_billing_summary']!='Additional Work'){ htmg += '<option value="Additional Work">Additional Work</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Other)'){ htmg += '<option value="Parts Costs (Other)">Parts Costs (Other)</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Unit)'){ htmg += '<option value="Parts Costs (Unit)">Parts Costs (Unit)</option>';}
			$('#u_txt_billing_summary').append(htmg);
		},
		error 	: function(data){
			alert('ERROR ON HANDLER(load_pmicr_dept_content_update)!');
		}
	});
});

$('#t_content_yf tbody').on('dblclick','tr',function(){
	var id 			= $(this).find('td:eq(0) input').val();
	var data = {
		"action"		: "load_pmicr_dept_content_update",
		"id" 			: id
	}
	data = $.param(data);
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			$('#mdl_update_content').modal('show');
			if(data['pcrdc_type']=='1'){
				$('#u_rdo_item_material').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",true);
				$('#u_cont_items_manpower').prop("hidden",false);
				$('#u_rdo_item_manpower').prop("checked",true);
			}
			if(data['pcrdc_type']=='2'){
				$('#u_rdo_item_manpower').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",false);
				$('#u_cont_items_manpower').prop("hidden",true);
				$('#u_rdo_item_material').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='1'){
				$('#u_rdo_not_tta').prop("checked",false);
				$('#u_rdo_included_tta').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='0'){
				$('#u_rdo_not_tta').prop("checked",true);
				$('#u_rdo_included_tta').prop("checked",false);
			}
			$('input[name=u_txt_incharge_section]').val(data['pcrdc_incharge_section']);
			$('input[name=u_txt_material]').val(data['pcrdc_material_product_name']);
			$('input[name=u_txt_detail]').val(data['pcrdc_detail']);
			$('input[name=u_txt_billing_summary]').val(data['pcrdc_billing_summary']);
			$('input[name=u_txt_material_unit_price]').val(data['pcrdc_mt_unit_price']);
			$('input[name=u_txt_material_quantity]').val(data['pcrdc_mt_qty']);
			$('input[name=u_txt_total_amnt_material]').val(data['pcrdc_total_amount_mt']);
			$('input[name=u_txt_transport_total_amnt]').val(data['pcrdc_transport_total_amnt']);
			$('input[name=u_txt_sorting_qty]').val(data['pcrdc_sorting_qty']);
			$('input[name=u_txt_sat_sec]').val(data['pcrdc_seconds']);
			$('input[name=u_txt_tact_time]').val(data['pcrdc_tact_time']);

			$('input[name=u_txt_manhours]').val(data['pcrdc_manhours']);
			$('input[name=u_txt_cost_mins]').val(data['pcrdc_cost_mins']);
			$('input[name=u_txt_total_amnt_manpower]').val(data['pcrdc_total_amnt_mp']);
			$('input[name=u_txt_detail_of_indication]').val(data['pcrdc_details_of_indication']);
			$('input[name=u_txt_supplier]').val(data['pcrdc_supplier_name']);
			$('input[name=hdn_content_id]').val(data['pcrdc_id']);
			$('input[name=u_txt_category]').val(data['pcrdc_category']);
			$('#u_txt_yec_billing').empty();
			if(data['pcrdc_yec_billing']=='Debit'){
				var htmz =  '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']=='Invoice'){
				var htmz =  '<option value="Invoice">Invoice</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']==''){
				var htmz =  '<option value="">None</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
			}
			$('#u_txt_yec_billing').append(htmz);
			if(data['pcrdc_billing_summary']==''){
				var htmg = '<option value="">None</option>';			
			}
			else{
				var htmg = '<option value="'+data['pcrdc_billing_summary']+'">'+data['pcrdc_billing_summary']+'</option>';
			}
			if(data['pcrdc_billing_summary']!=''){ htmg += '<option value="">None</option>';}			
			if(data['pcrdc_billing_summary']!='Parts Cost (Material NG)'){ htmg += '<option value="Parts Costs (Material NG)">Parts Costs (Material NG)</option>';}
			if(data['pcrdc_billing_summary']!='Sorting Cost'){ htmg += '<option value="Sorting Costs">Sorting Costs</option>';}
			if(data['pcrdc_billing_summary']!='Transport Cost'){ htmg += '<option value="Transport Costs">Transport Costs</option>';}
			if(data['pcrdc_billing_summary']!='Additional Work'){ htmg += '<option value="Additional Work">Additional Work</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Other)'){ htmg += '<option value="Parts Costs (Other)">Parts Costs (Other)</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Unit)'){ htmg += '<option value="Parts Costs (Unit)">Parts Costs (Unit)</option>';}
			$('#u_txt_billing_summary').append(htmg);
		},
		error 	: function(data){
			alert('ERROR ON HANDLER(load_pmicr_dept_content_update)!');
		}
	});
});

$('#t_content_ts tbody').on('dblclick','tr',function(){
	var id 			= $(this).find('td:eq(0) input').val();
	var data = {
		"action"		: "load_pmicr_dept_content_update",
		"id" 			: id
	}
	data = $.param(data);
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			$('#mdl_update_content').modal('show');
			if(data['pcrdc_type']=='1'){
				$('#u_rdo_item_material').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",true);
				$('#u_cont_items_manpower').prop("hidden",false);
				$('#u_rdo_item_manpower').prop("checked",true);
			}
			if(data['pcrdc_type']=='2'){
				$('#u_rdo_item_manpower').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",false);
				$('#u_cont_items_manpower').prop("hidden",true);
				$('#u_rdo_item_material').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='1'){
				$('#u_rdo_not_tta').prop("checked",false);
				$('#u_rdo_included_tta').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='0'){
				$('#u_rdo_not_tta').prop("checked",true);
				$('#u_rdo_included_tta').prop("checked",false);
			}
			$('input[name=u_txt_incharge_section]').val(data['pcrdc_incharge_section']);
			$('input[name=u_txt_material]').val(data['pcrdc_material_product_name']);
			$('input[name=u_txt_detail]').val(data['pcrdc_detail']);
			$('input[name=u_txt_billing_summary]').val(data['pcrdc_billing_summary']);
			$('input[name=u_txt_material_unit_price]').val(data['pcrdc_mt_unit_price']);
			$('input[name=u_txt_material_quantity]').val(data['pcrdc_mt_qty']);
			$('input[name=u_txt_total_amnt_material]').val(data['pcrdc_total_amount_mt']);
			$('input[name=u_txt_transport_total_amnt]').val(data['pcrdc_transport_total_amnt']);
			$('input[name=u_txt_sorting_qty]').val(data['pcrdc_sorting_qty']);
			$('input[name=u_txt_sat_sec]').val(data['pcrdc_seconds']);
			$('input[name=u_txt_manhours]').val(data['pcrdc_manhours']);
			$('input[name=u_txt_tact_time]').val(data['pcrdc_tact_time']);
			$('input[name=u_txt_cost_mins]').val(data['pcrdc_cost_mins']);
			$('input[name=u_txt_total_amnt_manpower]').val(data['pcrdc_total_amnt_mp']);
			$('input[name=u_txt_detail_of_indication]').val(data['pcrdc_details_of_indication']);
			$('input[name=u_txt_supplier]').val(data['pcrdc_supplier_name']);
			$('input[name=hdn_content_id]').val(data['pcrdc_id']);
			$('input[name=u_txt_category]').val(data['pcrdc_category']);
			$('#u_txt_yec_billing').empty();
			if(data['pcrdc_yec_billing']=='Debit'){
				var htmz =  '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']=='Invoice'){
				var htmz =  '<option value="Invoice">Invoice</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']==''){
				var htmz =  '<option value="">None</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
			}
			$('#u_txt_yec_billing').append(htmz);
			if(data['pcrdc_billing_summary']==''){
				var htmg = '<option value="">None</option>';			
			}
			else{
				var htmg = '<option value="'+data['pcrdc_billing_summary']+'">'+data['pcrdc_billing_summary']+'</option>';
			}
			if(data['pcrdc_billing_summary']!=''){ htmg += '<option value="">None</option>';}	
			if(data['pcrdc_billing_summary']!='Parts Cost (Material NG)'){ htmg += '<option value="Parts Costs (Material NG)">Parts Costs (Material NG)</option>';}
			if(data['pcrdc_billing_summary']!='Sorting Cost'){ htmg += '<option value="Sorting Costs">Sorting Costs</option>';}
			if(data['pcrdc_billing_summary']!='Transport Cost'){ htmg += '<option value="Transport Costs">Transport Costs</option>';}
			if(data['pcrdc_billing_summary']!='Additional Work'){ htmg += '<option value="Additional Work">Additional Work</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Other)'){ htmg += '<option value="Parts Costs (Other)">Parts Costs (Other)</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Unit)'){ htmg += '<option value="Parts Costs (Unit)">Parts Costs (Unit)</option>';}
			$('#u_txt_billing_summary').append(htmg);
		},
		error 	: function(data){
			alert('ERROR ON HANDLER(load_pmicr_dept_content_update)!');
		}
	});
});

$('#t_content_pps tbody').on('dblclick','tr',function(){
	var id 			= $(this).find('td:eq(0) input').val();
	var data = {
		"action"		: "load_pmicr_dept_content_update",
		"id" 			: id
	}
	data = $.param(data);
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			$('#mdl_update_content').modal('show');
			if(data['pcrdc_type']=='1'){
				$('#u_rdo_item_material').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",true);
				$('#u_cont_items_manpower').prop("hidden",false);
				$('#u_rdo_item_manpower').prop("checked",true);
			}
			if(data['pcrdc_type']=='2'){
				$('#u_rdo_item_manpower').prop("checked",false);
				$('#u_cont_items_material').prop("hidden",false);
				$('#u_cont_items_manpower').prop("hidden",true);
				$('#u_rdo_item_material').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='1'){
				$('#u_rdo_not_tta').prop("checked",false);
				$('#u_rdo_included_tta').prop("checked",true);
			}
			if(data['pcrdc_tta_included']=='0'){
				$('#u_rdo_not_tta').prop("checked",true);
				$('#u_rdo_included_tta').prop("checked",false);
			}
			$('input[name=u_txt_incharge_section]').val(data['pcrdc_incharge_section']);
			$('input[name=u_txt_material]').val(data['pcrdc_material_product_name']);
			$('input[name=u_txt_detail]').val(data['pcrdc_detail']);
			$('input[name=u_txt_billing_summary]').val(data['pcrdc_billing_summary']);
			$('input[name=u_txt_material_unit_price]').val(data['pcrdc_mt_unit_price']);
			$('input[name=u_txt_material_quantity]').val(data['pcrdc_mt_qty']);
			$('input[name=u_txt_total_amnt_material]').val(data['pcrdc_total_amount_mt']);
			$('input[name=u_txt_transport_total_amnt]').val(data['pcrdc_transport_total_amnt']);
			$('input[name=u_txt_sorting_qty]').val(data['pcrdc_sorting_qty']);
			$('input[name=u_txt_manhours]').val(data['pcrdc_manhours']);
			$('input[name=u_txt_sat_sec]').val(data['pcrdc_seconds']);
			$('input[name=u_txt_tact_time]').val(data['pcrdc_tact_time']);
			$('input[name=u_txt_cost_mins]').val(data['pcrdc_cost_mins']);
			$('input[name=u_txt_total_amnt_manpower]').val(data['pcrdc_total_amnt_mp']);
			$('input[name=u_txt_detail_of_indication]').val(data['pcrdc_details_of_indication']);
			$('input[name=u_txt_supplier]').val(data['pcrdc_supplier_name']);
			$('input[name=hdn_content_id]').val(data['pcrdc_id']);
			$('input[name=u_txt_category]').val(data['pcrdc_category']);
			$('#u_txt_yec_billing').empty();
			if(data['pcrdc_yec_billing']=='Debit'){
				var htmz =  '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']=='Invoice'){
				var htmz =  '<option value="Invoice">Invoice</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="">None</option>';
			}
			if(data['pcrdc_yec_billing']==''){
				var htmz =  '<option value="">None</option>';
					htmz += '<option value="Debit">Debit</option>';
					htmz += '<option value="Invoice">Invoice</option>';
			}
			$('#u_txt_yec_billing').append(htmz);
			if(data['pcrdc_billing_summary']==''){
				var htmg = '<option value="">None</option>';			
			}
			else{
				var htmg = '<option value="'+data['pcrdc_billing_summary']+'">'+data['pcrdc_billing_summary']+'</option>';
			}
			if(data['pcrdc_billing_summary']!=''){ htmg += '<option value="">None</option>';}	
			if(data['pcrdc_billing_summary']!='Parts Cost (Material NG)'){ htmg += '<option value="Parts Costs (Material NG)">Parts Costs (Material NG)</option>';}
			if(data['pcrdc_billing_summary']!='Sorting Cost'){ htmg += '<option value="Sorting Costs">Sorting Costs</option>';}
			if(data['pcrdc_billing_summary']!='Transport Cost'){ htmg += '<option value="Transport Costs">Transport Costs</option>';}
			if(data['pcrdc_billing_summary']!='Additional Work'){ htmg += '<option value="Additional Work">Additional Work</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Other)'){ htmg += '<option value="Parts Costs (Other)">Parts Costs (Other)</option>';}
			if(data['pcrdc_billing_summary']!='Parts Cost (Unit)'){ htmg += '<option value="Parts Costs (Unit)">Parts Costs (Unit)</option>';}
			$('#u_txt_billing_summary').append(htmg);
		},
		error 	: function(data){
			alert('ERROR ON HANDLER(load_pmicr_dept_content_update)!');
		}
	});
});

$(document).ready(function(){
	/* open modal for add signatory */

	$('#btn_add_signatory').click(function(){ 
		$('#modal_add_signatory').modal('show');
	});

	$('#choose_dept_export_yes').click(function(){
		$('input[name=hdn_date_range_export]').val($('#input_search_date_range').val());
		$('#frm_choose_dept_export').submit();
	});

	$('#btn_export_summaryreport').click(function(){
		if($('#input_search_date_range').val()!=''){
			$('#modal_choose_dept_export').modal('show');
		}
		else{
			alert('Please select a range of date.')
		}
		// window.open('./export/excel.export.php');
	});

	$('#submit_printandcreate_pmi').click(function(){
		if($('input[name=txt_chargeto]').val()==''||
			$('input[name=txt_chargeto]').val()==' '||
			$('input[name=txt_from]').val()==''||
			$('input[name=txt_from]').val()==' '||
			$('input[name=txt_attention]').val()==''||
			$('input[name=txt_attention]').val()==' '||
			$('input[name=txt_date]').val()==''||
			$('input[name=txt_date]').val()==' '||
			$('input[name=txt_copyfor]').val()==''||
			$('input[name=txt_copyfor]').val()==' '||
			$('input[name=txt_natureofcharging]').val()==''||
			$('input[name=txt_natureofcharging]').val()==' '){
			alert("Please fill out the required fields!");
			$('.required').empty();
			var asterisk = '<span style="color:red;font-size:20px;">*</span>';
			$('.required').append(asterisk);
		}
		else{
			$('#modal_confirm_printandcreate_pmi').modal('show');
		}
	});

	$('#frm_confirm_printandcreate_pmi').submit(function(e){
		var checked_by 	= $('#c_span_checked_by').text();
		var prepared_by = $('#c_span_prepared_by').text();
		var control_no = $('input[name=txt_controlno]').val();
		// window.open('./cr_report.php?pmicr_control_no='+control_no);
		e.preventDefault();
		var data = $('#frm_create_pmi').serialize();

		var data = {
			"action"		: "create_pmi_charging_report",
			"checked_by"	: checked_by,
			"prepared_by" 	: prepared_by
		}


		data = $.param(data) + "&" + $('#frm_create_pmi').serialize();
		console.log(data);
		$('#modal_confirm_create_pmi').modal('hide');
		$('#mdl_add_ons').modal('show');
		$('#frm_add_ons').submit(function(){
			create_pmi_charging_report(data);
			var txt_add_control_no = $('input[name=txt_add_control_no]').val();
			var txt_add_machine_tools = $('input[name=txt_add_machine_tools]').val();
			var txt_add_materials = $('input[name=txt_add_materials]').val();
			var txt_add_other_charges = $('input[name=txt_add_other_charges]').val();
			var txt_hdn_user_emp_id = $('input[name=hdn_user_emp_id]').val();
			window.open('./cr_report.php?pmicr_control_no='+control_no+'&add_control='+txt_add_control_no+'&add_machtools='+txt_add_machine_tools+'&add_materials='+txt_add_materials+'&add_othrchrges='+txt_add_other_charges+'&p_id='+txt_hdn_user_emp_id);		
		});	
			
	});

	$('.submit_create_pmi').click(function(){
		if($('input[name=txt_chargeto]').val()==''||
			$('input[name=txt_chargeto]').val()==' '||
			$('input[name=txt_from]').val()==''||
			$('input[name=txt_from]').val()==' '||
			$('input[name=txt_attention]').val()==''||
			$('input[name=txt_attention]').val()==' '||
			$('input[name=txt_date]').val()==''||
			$('input[name=txt_date]').val()==' '||
			$('input[name=txt_copyfor]').val()==''||
			$('input[name=txt_copyfor]').val()==' '||
			$('input[name=txt_natureofcharging]').val()==''||
			$('input[name=txt_natureofcharging]').val()==' '){
			alert("Please fill out the required fields!");
			$('.required').empty();
			var asterisk = '<span style="color:red;font-size:20px;">*</span>';
			$('.required').append(asterisk);
		}
		else{
			$('#modal_confirm_create_pmi').modal('show');
		}
	});

	$('.submit_update_pmi').click(function(){
		if($('input[name=u_txt_chargeto]').val()==''||
			$('input[name=u_txt_chargeto]').val()==' '||
			$('input[name=u_txt_from]').val()==''||
			$('input[name=u_txt_from]').val()==' '||
			$('input[name=u_txt_attention]').val()==''||
			$('input[name=u_txt_attention]').val()==' '||
			$('input[name=u_txt_date]').val()==''||
			$('input[name=u_txt_date]').val()==' '||
			$('input[name=u_txt_copyfor]').val()==''||
			$('input[name=u_txt_copyfor]').val()==' '||
			$('input[name=u_txt_natureofcharging]').val()==''||
			$('input[name=u_txt_natureofcharging]').val()==' '){
			alert("Please fill out the required fields!");
			$('.required').empty();
			var asterisk = '<span style="color:red;font-size:20px;">*</span>';
			$('.required').append(asterisk);
		}
		else{
			$('#modal_confirm_update_pmi').modal('show');
		}
	});

	$('#frm_confirm_update_pmi').submit(function(e){
		e.preventDefault();
		var checked_by 	= $('#u_span_checked_by').text();
		var prepared_by = $('#u_span_prepared_by').text();
		var data = $('#frm_update_pmi').serialize();
		var data = {
			"action"		: "update_pmi_charging_report",
			"checked_by"	: checked_by,
			"prepared_by"	: prepared_by
		}

		data = $.param(data) + "&" + $('#frm_update_pmi').serialize();
		console.log(data);
		$('#modal_confirm_update_pmi').modal('hide');
		$('.btn').prop('disabled',true);
		update_pmi_charging_report(data);		
	});

	$('#btn_change_notedby').click(function(){
		$('#grp_notedby').empty();
		var html = '<select class="form-control select_notedby" type="text" name="u_txt_notedby" style="border-radius:4px;"></select>';
		$('#grp_notedby').append(html);
		load_signatories_select();
	});

	$('#btn_change_approvedby').click(function(){
		$('#grp_approvedby').empty();
		var html = '<select class="form-control select_approver" type="text" name="u_txt_approvedby" style="border-radius:4px;"></select>';
		$('#grp_approvedby').append(html);
		load_signatories_select();
	});

 	$('#a_pmicr_print').click(function(){
		var control_no = $('input[name=u_txt_controlno]').val();
		$('#mdl_add_ons').modal('show');
		$('#frm_add_ons').submit(function(){
			var txt_add_control_no = $('input[name=txt_add_control_no]').val();
			var txt_add_machine_tools = $('input[name=txt_add_machine_tools]').val();
			var txt_add_materials = $('input[name=txt_add_materials]').val();
			var txt_add_other_charges = $('input[name=txt_add_other_charges]').val();
			var txt_hdn_user_emp_id = $('input[name=hdn_user_emp_id]').val();
			window.open('./cr_report.php?pmicr_control_no='+control_no+'&add_control='+txt_add_control_no+'&add_machtools='+txt_add_machine_tools+'&add_materials='+txt_add_materials+'&add_othrchrges='+txt_add_other_charges+'&p_id='+txt_hdn_user_emp_id);
		});
	});

	/* open modal of confimation alert */
	$('#submit_add_signatory').click(function(){
		if($('input[name=txt_emp_no]').val() !==''){
			$('#modal_confirm_add_signatory').modal('show');
		}
		else{
			$('.input_required').empty();
			alert('Fill required fields!');
			var html = '<i style="color:red;font-size:11px;">*Required</i>';
			$('.input_required').append(html);
		}			
	});

	$('#frm_confirm_create_pmi').submit(function(e){
		e.preventDefault();
		var checked_by 	= $('#c_span_checked_by').text();
		var prepared_by = $('#c_span_prepared_by').text();
		var data = $('#frm_create_pmi').serialize();

		var data = {
			"action"		: "create_pmi_charging_report",
			"checked_by"	: checked_by,
			"prepared_by" 	: prepared_by
		}


		data = $.param(data) + "&" + $('#frm_create_pmi').serialize();
		console.log(data);
		$('#modal_confirm_create_pmi').modal('hide');
		$('.btn').prop('disabled',true);
		create_pmi_charging_report(data);		
	});

	$('#frm_confirm_remove_existingrow').submit(function(e){
		e.preventDefault();
		var max_rows = $('input[name=u_txt_max_row]').val();
		var data = {
			"action"		: "remove_pmicr_content",
			"max_row"		: max_rows,
			"control_no"	: $('input[name=u_txt_controlno]').val()
		}


		
		data = $.param(data) + "&" + $(this).serialize();
		console.log(data);
		$('#modal_confirm_remove_existingrow').modal('hide');
		$('.btn').prop('disabled',true);
		remove_pmicr_content(data);		
	});

	/* open modal of confimation alert */
	$('#submit_edit_role').click(function(){
		$('#modal_confirm_edit_role').modal('show');
	});

	$('input[name=txt_emp_no]').change(function(){
		var data = {
			"action" 		: 	"load_emp_name"
		}
		data = $.param(data) + "&" + $(this).serialize();
		$.ajax({
			type	: "post",
			dataType: "json",
			data	: data,
			url		: handler,
			success	: function(data){
				if(data['emp_name']==''||data['emp_name']==' '||data['emp_name']===null){
					$('#input_emp_name').prop("disabled",true);
					$('#input_emp_name').val('No match found!');
					$('#submit_add_signatory').prop('disabled',true);
				}
				else{
					$('#input_emp_name').val(data['emp_name']);
					$('#input_emp_name').prop("disabled",false);
					$('#submit_add_signatory').prop('disabled',false);
				}				
			},
			error 	: function(data){
				alert('ERROR ON .CHANGE INPUT!');
			}
		});
	});

	/* submit confirm add signatory */ 
	$('#frm_confirm_add_signatory').submit(function(e){
		e.preventDefault();
		var data = $('#frm_add_signatory').serialize();
		var data = {
			"action" 	: 	"add_signatory"
		}		
		data = $.param(data) + "&" + $('#frm_add_signatory').serialize();
		console.log(data);
		$('#modal_confirm_add_signatory').modal('hide');
		$('.btn').prop('disabled',true);
		add_signatory(data);
		$('#modal_add_signatory').modal('hide');
	});

	/* submit confirm add signatory */ 
	$('#frm_confirm_edit_role').submit(function(e){
		e.preventDefault();
		var data = $('#frm_edit_role').serialize();
	
		var data = {
			"action" 	: 	"edit_role"
		}		
		data = $.param(data) + "&" + $('#frm_edit_role').serialize();
		console.log(data);
		$('#modal_confirm_edit_role').modal('hide');
		$('.btn').prop('disabled',true);
		edit_role(data);
		$('#modal_edit_role').modal('hide');	
	});

	$('#btn_create_pmi_bydept').click(function(){
		$('#modal_create_pmi_bydept').modal('show');
	});

	$('#submit_create_pmi_bydept').click(function(){
		if($('input[name=txt_attention]').val()==''||$('input[name=txt_attention]').val()==''){
			$('.input_required').empty();
			alert('Fill required fields!');
			var html = '<i style="color:red;font-size:11px;">*</i>';
			$('.input_required').append(html);
			var htmk = '<i style="color:red;font-size:11px;">* Required Fields</i>'
			$('#field_req_leg').append(htmk);
		}
		else{
			$('#modal_confirm_create_pmi_bydept').modal('show');
		}
	});

	$('#frm_confirm_create_pmi_bydept').submit(function(e){
		var para_dept = $('#paragraph_dept').text();
		var data = $('#frm_create_pmi_bydept').serialize();
		e.preventDefault();
		var data = {
			"action"		: "create_pmi_charging_report_bydept",
			"para_dept" 	: 	para_dept
		}

		data = $.param(data) + "&" + $('#frm_create_pmi_bydept').serialize();
		console.log(data);	
		$('#modal_confirm_create_pmi_bydept').modal('hide');
		$('.btn').prop('disabled',true);
		create_pmi_charging_report_bydept(data);
		$('#modal_create_pmi_bydept').modal('hide');
	});

	$('#btn_update_info').click(function(){
		$('#mdl_update_info').modal('show');
	});

	$('#submit_update_info').click(function(){
		$('#mdl_confirm_update_info').modal('show');
	});

	$('#frm_confirm_update_info').submit(function(e){
		var data = $('#frm_update_info').serialize();
		e.preventDefault();
		var data = {
			"action"		: "update_pmi_charging_report_bydept"
		}
		data = $.param(data) + "&" + $('#frm_update_info').serialize();
		console.log(data);	
		$('#mdl_confirm_update_info').modal('hide');
		$('.btn').prop('disabled',true);
		update_pmi_charging_report_bydept(data);
		$('#mdl_update_info').modal('hide');
	});

	$('#btn_add_content_bdept').click(function(){
		$('#mdl_add_report').modal('show');
	})

	$('#submit_add_report').click(function(){
		$('#mdl_confirm_add_report').modal('show');
	})

	$('#frm_confirm_add_report').submit(function(e){
		var para_dept = $('#paragraph_dept').text();
		var data = $('#frm_add_report').serialize();
		var control_no = $('#txt_control_no').val();
		e.preventDefault();
		var data = {
			"action"		: "add_pmi_charging_report_bydept_content",
			"para_dept" 	: para_dept,
			"control_no"	: control_no
		}
		data = $.param(data) + "&" + $('#frm_add_report').serialize();
		console.log(data);	
		$('#mdl_confirm_add_report').modal('hide');
		$('.btn').prop('disabled',true);
		add_pmi_charging_report_bydept_content(data);
		$('#mdl_add_report').modal('hide');
	});

	$('#submit_update_content').click(function(){
		$('#mdl_confirm_update_content').modal('show');
	});

	$('#frm_confirm_update_content').submit(function(e){
		var para_dept = $('#paragraph_dept').text();
		var data = $('#frm_update_content').serialize();
		var control_no = $('#txt_control_no').val();
		e.preventDefault();
		var data = {
			"action"		: "update_pmi_charging_report_bydept_content",
			"para_dept" 	: para_dept,
			"control_no" 	: control_no
		}
		data = $.param(data) + "&" + $('#frm_update_content').serialize();
		console.log(data);	
		$('#mdl_confirm_update_content').modal('hide');
		$('.btn').prop('disabled',true);
		update_pmi_charging_report_bydept_content(data);
		$('#mdl_update_content').modal('hide');
	});

	$('#btn_print').click(function(){
		$('#mdl_print').modal('show');
	});

	$('#submit_print').click(function(){
		if($('select[name=txt_memo_type]').val()=='Choose Memo'||$('select[name=txt_month]').val()=="Choose Month"||$('input[name=txt_year]').val()==''){
			alert('Please fill out the fields properly!');
		}
		else{
			$('#frm_print').submit();
		}
	});

	$('#t_summary_report tbody').on('click','tr',function(){
        $(this).toggleClass('selected');
    });

    $('#rdo_not_sq').click(function(){
    	$('input[name=txt_sorting_qty]').prop("disabled",true);
    	$('input[name=txt_sorting_qty]').val('');
    });

    $('#rdo_included_sq').click(function(){
    	$('input[name=txt_sorting_qty]').prop("disabled",false);
    });

    $('#u_rdo_not_sq').click(function(){
    	$('input[name=u_txt_sorting_qty]').prop("disabled",true);
    	$('input[name=u_txt_sorting_qty]').val('');
    });

    $('#u_rdo_included_sq').click(function(){
    	$('input[name=u_txt_sorting_qty]').prop("disabled",false);
    });
});

function remove_pmicr_content(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){
			console.log(data['query']);
			alert('Successfully deleted!');
			var max_rows = $('input[name=u_txt_max_row]').val();
			if(Number(max_rows)>0){
				for(var s=1;s<=max_rows;s++){
					if($('input[name=hdn_pmicrc_id]').val()=='a_remove_existingrow_'+s){
						var row_id=s;
					}
				}
			}
			$('#row'+row_id).empty();
			$('.btn').prop('disabled',false);
		},
		error 	: function(){
			alert('ERROR ON HANDLER!(remove_pmicr_content)');
		}
	});
}

function load_signatories_select(){
	var username = $('#hd_username').val();
	var data = {
		"action"	: "load_signatories_select",
		"username" 	: username
	}
	data = $.param(data);
	$.ajax({
		type 	: "post",
		dataType: "json",
		data 	: data,
		url 	: handler,
		success : function(data){
			var ctr_notedby = data['ctr_notedby'];
			var ctr_approver = data['ctr_approver'];
			var html = '<option value="">None</option>';
			var htmk = '';
			$('.select_notedby').empty();
			$('.select_approver').empty();
			for(var i=0;i<ctr_notedby;i++){
				html += '<option value="'+data['ur_notedby_name'][i]+'">'+data['ur_notedby_name'][i]+'</option>';
			}
			for(var j=0;j<ctr_approver;j++){
				htmk += '<option value="'+data['ur_approver_name'][j]+'">'+data['ur_approver_name'][j]+'</option>';
			}
			console.log(data['query']);
			$('.select_notedby').append(html);
			$('.select_approver').append(htmk);
			$('.span_checked_by').text(data['ur_checker_name']);
			$('input[name=hdn_user_emp_id]').val(data['prepared_by_id']);
			$('.span_prepared_by').text(data['prepared_by']);
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(load_signatories_select)');
		}
	});
}

function create_pmi_charging_report_bydept(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){
			alert('Successfully Added New PMI Charging Report!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(create_pmi_charging_report_bydept)');
		}
	});
}

function update_pmi_charging_report_bydept(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){
			alert('Successfully Updated!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(update_pmi_charging_report_bydept)');
		}
	});
}

function add_pmi_charging_report_bydept_content(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){
			console.log(data['query']);
			alert('Successfully Added PMI Charging Content!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(add_pmi_charging_report_bydept_content)');
		}
	});	
}

function update_pmi_charging_report_bydept_content(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){
			console.log(data);
			alert('Successfully Updated!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(update_pmi_charging_report_bydept_content)');
		}
	});	
}

function fn_get_amount(){
	var max_row = $('#input_max_row').val();
	var y = max_row;
	var u_max_row = $('input[name=u_txt_max_row]').val();
	var z = u_max_row;
	var additional_row = $('input[name=additional_row]').val();
	var m = additional_row;

		$('input[name=u_txt_qty_'+z+']').change(function(){
			var unit_price = $('input[name=u_txt_unitprice_'+z+']').val() * 1;
			var qty = $('input[name=u_txt_qty_'+z+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=u_txt_amount_'+z+']').val(amount.toFixed(2));
			$('input[name=u_txt_qty_'+z+']').val(qty);
		});

		$('input[name=u_txt_unitprice_'+z+']').change(function(){
			var unit_price = $('input[name=u_txt_unitprice_'+z+']').val() * 1;
			var qty = $('input[name=u_txt_qty_'+z+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=u_txt_amount_'+z+']').val(amount.toFixed(2));
			$('input[name=u_txt_unitprice_'+z+']').val(unit_price.toFixed(4));
		});

		$('input[name=txt_qty_'+y+']').change(function(){
			var unit_price = $('input[name=txt_unitprice_'+y+']').val() * 1;
			var qty = $('input[name=txt_qty_'+y+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=txt_amount_'+y+']').val(amount.toFixed(2));
			$('input[name=txt_qty_'+y+']').val(qty);
		});

		$('input[name=txt_amount_'+y+']').change(function(){
			var txt_amount = $('input[name=txt_amount_'+y+']').val() * 1;
			$('input[name=txt_amount_'+y+']').val(txt_amount.toFixed(2));
		});

		$('input[name=u_txt_amount_'+z+']').change(function(){
			var txt_amount = $('input[name=u_txt_amount_'+z+']').val() * 1;
			$('input[name=u_txt_amount_'+z+']').val(txt_amount.toFixed(2));
		});


		$('input[name=txt_unitprice_'+y+']').change(function(){
			var unit_price = $('input[name=txt_unitprice_'+y+']').val() * 1;
			var qty = $('input[name=txt_qty_'+y+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=txt_amount_'+y+']').val(amount.toFixed(2));
			$('input[name=txt_unitprice_'+y+']').val(unit_price.toFixed(4));
		});

		$('input[name=i_txt_qty_'+m+']').change(function(){
			var unit_price = $('input[name=i_txt_unitprice_'+m+']').val() * 1;
			var qty = $('input[name=i_txt_qty_'+m+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=i_txt_amount_'+m+']').val(amount.toFixed(2));
			$('input[name=i_txt_qty_'+m+']').val(qty);
		});

		$('input[name=i_txt_unitprice_'+m+']').change(function(){
			var unit_price = $('input[name=i_txt_unitprice_'+m+']').val() * 1;
			var qty = $('input[name=i_txt_qty_'+m+']').val() * 1;
			var amount = qty * unit_price;
			$('input[name=i_txt_amount_'+m+']').val(amount.toFixed(2));
			$('input[name=i_txt_unitprice_'+m+']').val(unit_price.toFixed(4));
		});

		$('input[name=i_txt_amount_'+m+']').change(function(){
			var txt_amount = $('input[name=i_txt_amount_'+m+']').val() * 1;
			$('input[name=i_txt_amount_'+m+']').val(txt_amount.toFixed(2));
		});
}	

function create_pmi_charging_report(data){
	$.ajax({
		type  		: "post",
		dataType 	: "json",
		data 		: data,
		url			: handler,
		success 	: function(data){
			console.log(data['query']);
			alert('Successfully Added New PMI Charging Report!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(create_pmi_charging_report)');
			location.reload();
		}
	});
}

function update_pmi_charging_report(data){
	$.ajax({
		type  		: "post",
		dataType 	: "json",
		data 		: data,
		url			: handler,
		success 	: function(data){
			alert('Successfully Updated!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(update_pmi_charging_report)');
			location.reload();
		}
	});
}

function add_signatory(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){			
			console.log(data);
			alert('Successfully Added New Signatory!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(add_signatory)');
		}
	});
}

function edit_role(data){
	$.ajax({
		type	: "post",
		dataType: "json",
		data	: data,
		url		: handler,
		success	: function(data){			
			console.log(data);
			alert('Signatory\'s Role has been Change!');
			location.reload();
		},
		error 	: function(data){
			alert('ERROR ON HANDLER!(edit_role)');
		}
	});
}

function load_control_number(){
	var data = {
		"action" 	: "load_control_number"
	}
	data = $.param(data);
	$.ajax({
		type 		: "post",
		dataType	: "json" ,
		data 		: data,
		url			: handler,
		success 	: function(data){
			$('input[name=txt_controlno]').val('PMI-'+data['control_number']);
			$('input[name=txt_control_no]').val('PMI-'+data['control_number']);	
		},
		error 		: function(data){
			alert('ERROR ON HANDLER!(load_control_number)');
		}
	});
}

function fn_modal_computations_cn(){
	$('#hrs').change(function(){
		$('#hdn_time_type').val('hrs');
		$('#cont_tact_time').prop("hidden",false);
		$('input[name=txt_sat_sec]').prop("readonly",false);
		// $('input[name=txt_sat_sec]').val('');
		$('input[name=txt_tact_time]').val('');
		$('input[name=txt_total_amnt_manpower]').val('');
		var seconds = Number($('#hdn_time_field').val())*60;
		$('input[name=txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
		$('input[name=txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
		$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#min').change(function(){
		$('#hdn_time_type').val('min');
		$('#cont_tact_time').prop("hidden",false);
		$('input[name=txt_sat_sec]').prop("readonly",false);
		// $('input[name=txt_sat_sec]').val('');
		$('input[name=txt_tact_time]').val('');
		$('input[name=txt_total_amnt_manpower]').val('');
		var seconds = Number($('#hdn_time_field').val());
		$('input[name=txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
		$('input[name=txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
		$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#sec').change(function(){
		$('#hdn_time_type').val('sec');
		$('#cont_tact_time').prop("hidden",false);
		$('input[name=txt_sat_sec]').prop("readonly",false);
		// $('input[name=txt_sat_sec]').val('');
		$('input[name=txt_tact_time]').val('');
		$('input[name=txt_total_amnt_manpower]').val('');
		var seconds = Number($('#hdn_time_field').val())/60;
		$('input[name=txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
		$('input[name=txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
		$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#none').click(function(){
		$('#cont_tact_time').prop("hidden",true);
		$('input[name=txt_sat_sec]').prop("readonly",true);
		$('#hdn_time_type').val('none');
		$('input[name=txt_sat_sec]').val('');
		$('input[name=txt_manhours]').val('');
		$('input[name=txt_tact_time]').val('');
		var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val());
		$('input[name=txt_total_amnt_manpower]').val(result);
	});

	$('input[name=txt_sat_sec]').change(function(){
		$('#hdn_time_field').val($('input[name=txt_sat_sec]').val());
		if($('#hdn_time_type').val()=='hrs'){
			var seconds = Number($('#hdn_time_field').val())*60;
			$('input[name=txt_seconds]').val(seconds);
			var min 	= Number($('$hdn_time_field').val())*Number($('$txt_cost_mins').val()); 
			var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
			$('input[name=txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());

			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
			$('input[name=txt_total_amnt_manpower]').val(min.toFixed(2)); 

		}
		else if($('#hdn_time_type').val()=='sec'){
			var seconds = Number($('#hdn_time_field').val())/60;
			$('input[name=txt_seconds]').val(seconds);
			var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
			$('input[name=txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
			
		}
		else{
			var seconds = Number($('#hdn_time_field').val());
			$('input[name=txt_seconds]').val(seconds);
			var tact_time = Number(seconds)/Number($('input[name=txt_sorting_qty]').val())*60;
			$('input[name=txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2));  

		}
	});

	$('#txt_cost_mins').change(function(){
		if($('#hdn_time_type').val()=='none'){
			$('input[name=txt_sat_sec]').val('');
			$('input[name=txt_manhours]').val('');
			$('input[name=txt_tact_time]').val('');
			var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val());
			$('input[name=txt_total_amnt_manpower]').val(result);
		}
		else{			
			var total_amnt_manpower = ($('input[name=txt_sorting_qty]').val()*$('input[name=txt_tact_time]').val())/60*$('#txt_cost_mins').val();
			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('input[name=txt_sorting_qty]').change(function(){
		if($('#hdn_time_type').val()=='none'){
			var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val())
			$('input[name=txt_total_amnt_manpower]').val(result);
		}
		else{
			$('input[name=txt_sat_sec]').val('');
			$('input[name=txt_manhours]').val('');
			$('input[name=txt_tact_time]').val('');
			$('input[name=txt_total_amnt_manpower]').val('');
		}
	});

	$('input[name=txt_material_unit_price]').change(function(){
		var total_amnt_material = Number($('input[name=txt_material_unit_price]').val())*Number($('input[name=txt_material_quantity]').val());
		$('input[name=txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=txt_total_amnt_material]').val())*.06;
		$('input[name=txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});

	$('input[name=txt_material_quantity]').change(function(){
		var total_amnt_material = Number($('input[name=txt_material_unit_price]').val())*Number($('input[name=txt_material_quantity]').val());
		$('input[name=txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=txt_total_amnt_material]').val())*.06;
		$('input[name=txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});
}

function fn_modal_u_computations_cn(){
	$('#u_hrs').change(function(){
		$('#u_hdn_time_type').val('hrs');
		$('input[name=u_txt_sat_sec]').prop("readonly",false);
		$('#u_cont_tact_time').prop("hidden",false);
		$('input[name=u_txt_tact_time]').val('');
		$('input[name=u_txt_total_amnt_manpower]').val('');
		var seconds = Number($('#u_hdn_time_field').val())*60;
		$('input[name=u_txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
		$('input[name=u_txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#u_txt_cost_mins').val());
		$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#u_min').change(function(){
		$('#u_hdn_time_type').val('min');
		$('input[name=u_txt_sat_sec]').prop("readonly",false);
		$('#u_cont_tact_time').prop("hidden",false);
		$('input[name=u_txt_tact_time]').val('');
		$('input[name=u_txt_total_amnt_manpower]').val('');
		var seconds = Number($('#u_hdn_time_field').val());
		$('input[name=u_txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
		$('input[name=u_txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#u_txt_cost_mins').val());
		$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#u_sec').change(function(){
		$('#u_hdn_time_type').val('sec');
		$('input[name=u_txt_sat_sec]').prop("readonly",false);
		$('#u_cont_tact_time').prop("hidden",false);
		$('input[name=u_txt_tact_time]').val('');
		$('input[name=u_txt_total_amnt_manpower]').val('');
		var seconds = Number($('#u_hdn_time_field').val())/60;
		$('input[name=u_txt_seconds]').val(seconds);
		var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
		$('input[name=u_txt_tact_time]').val(tact_time);
		var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#txt_cost_mins').val());
		$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#u_none').click(function(){
		$('#u_cont_tact_time').prop("hidden",true);
		$('input[name=u_txt_sat_sec]').prop("readonly",true);
		$('#u_hdn_time_type').val('none');
		$('input[name=u_txt_sat_sec]').val('');
		$('input[name=u_txt_manhours]').val('');
		$('input[name=u_txt_tact_time]').val('');
		var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val());
		$('input[name=u_txt_total_amnt_manpower]').val(result);
	});

	$('input[name=u_txt_sat_sec]').change(function(){
		$('#u_hdn_time_field').val($('input[name=u_txt_sat_sec]').val());
		if($('#u_hdn_time_type').val()=='hrs'){
			var seconds = Number($('#u_hdn_time_field').val())*60;
			$('input[name=u_txt_seconds]').val(seconds);
			var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
			$('input[name=u_txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#u_txt_cost_mins').val());
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
		else if($('#u_hdn_time_type').val()=='sec'){
			var seconds = Number($('#u_hdn_time_field').val())/60;
			$('input[name=u_txt_seconds]').val(seconds);
			var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
			$('input[name=u_txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#u_txt_cost_mins').val());
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
			 
		}
		else{
			var seconds = Number($('#u_hdn_time_field').val());
			$('input[name=u_txt_seconds]').val(seconds);
			var tact_time = Number(seconds)/Number($('input[name=u_txt_sorting_qty]').val())*60;
			$('input[name=u_txt_tact_time]').val(tact_time);
			var total_amnt_manpower = (Number($('input[name=u_txt_sorting_qty]').val())*Number(tact_time))/60*Number($('#u_txt_cost_mins').val());
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('#u_txt_cost_mins').change(function(){
		if($('#u_hdn_time_type').val()=='none'){
			$('input[name=u_txt_sat_sec]').val('');
			$('input[name=u_txt_manhours]').val('');
			$('input[name=u_txt_tact_time]').val('');
			var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val());
			$('input[name=u_txt_total_amnt_manpower]').val(result);
		}
		else{			
			var total_amnt_manpower = ($('input[name=u_txt_sorting_qty]').val()*$('input[name=u_txt_tact_time]').val())/60*$('#u_txt_cost_mins').val();
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('input[name=u_txt_sorting_qty]').change(function(){
		if($('#u_hdn_time_type').val()=='none'){
			var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val())
			$('input[name=u_txt_total_amnt_manpower]').val(result);
		}
		else{
			$('input[name=u_txt_sat_sec]').val('');
			$('input[name=u_txt_manhours]').val('');
			$('input[name=u_txt_tact_time]').val('');
			$('input[name=u_txt_total_amnt_manpower]').val('');
		}
	});

	$('input[name=u_txt_material_unit_price]').change(function(){
		var total_amnt_material = Number($('input[name=u_txt_material_unit_price]').val())*Number($('input[name=u_txt_material_quantity]').val());
		$('input[name=u_txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=u_txt_total_amnt_material]').val())*.06;
		$('input[name=u_txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});

	$('input[name=u_txt_material_quantity]').change(function(){
		var total_amnt_material = Number($('input[name=u_txt_material_unit_price]').val())*Number($('input[name=u_txt_material_quantity]').val());
		$('input[name=u_txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=u_txt_total_amnt_material]').val())*.06;
		$('input[name=u_txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});
}

function fn_modal_computations_ts_pps_yf(){
	$('#min').change(function(){
		$('#cont_manhours').prop("hidden",true);
		$('#cont_tact_time').prop("hidden",false);
		$('input[name=txt_sat_sec]').prop("readonly",false);
		$('#hdn_time_type').val('min');
		$('input[name=txt_tact_time]').val('');
		$('input[name=txt_total_amnt_manpower]').val('');
		if($('input[name=txt_sorting_qty]').val()!=''){
			var minutes = Number($('#hdn_time_field').val());
			var total_amnt_manpower = Number(minutes)*Number($('#txt_cost_mins').val());	
		}
		else{
			var total_amnt_manpower = Number($('#hdn_time_field').val())*Number($('#txt_cost_mins').val());	
		}
		$('input[name=txt_tact_time]').val(minutes);
		$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#sec').change(function(){
		$('#cont_tact_time').prop("hidden",false);
		$('input[name=txt_sat_sec]').val('');
		$('#cont_manhours').prop("hidden",false);
		$('input[name=txt_sat_sec]').prop("readonly",true);
		$('#hdn_time_type').val('sec');
		// $('input[name=txt_sat_sec]').val('');
	});

	$('#none').click(function(){
		$('#cont_tact_time').prop("hidden",true);
		$('#cont_manhours').prop("hidden",true);
		$('input[name=txt_sat_sec]').prop("readonly",true);
		$('#hdn_time_type').val('none');
		$('input[name=txt_sat_sec]').val('');
		$('input[name=txt_manhours]').val('');
		$('input[name=txt_tact_time]').val('');
		var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val());
		$('input[name=txt_total_amnt_manpower]').val(result);
	});

	$('#txt_manhours').change(function(){
		$('input[name=txt_tact_time]').val('');
		$('input[name=txt_total_amnt_manpower]').val('');
			var manhours = $('#txt_manhours').val();
			var seconds = Number(manhours)*60*60/Number($('input[name=txt_sorting_qty]').val());
			var minutes = Number($('input[name=txt_sorting_qty]').val())*Number(seconds)/60;
			var total_amnt_manpower = Number(minutes)*Number($('#txt_cost_mins').val());
		$('input[name=txt_sat_sec]').val(seconds);		
		$('input[name=txt_tact_time]').val(minutes);
		$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('input[name=txt_sat_sec]').change(function(){
		$('#hdn_time_field').val($('input[name=txt_sat_sec]').val());

		if($('#hdn_time_type').val()=='min'){
			if($('input[name=txt_sorting_qty]').val()!=''){
				var minutes = Number($('#hdn_time_field').val());
				var total_amnt_manpower = Number(minutes)*Number($('#txt_cost_mins').val());	
			}
			else{
				var total_amnt_manpower = Number($('#hdn_time_field').val())*Number($('#txt_cost_mins').val());	
			}
			$('input[name=txt_tact_time]').val(minutes);
			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('#txt_cost_mins').change(function(){
		if($('#hdn_time_type').val()=='none'){
			$('input[name=txt_sat_sec]').val('');
			$('input[name=txt_manhours]').val('');
			$('input[name=txt_tact_time]').val('');
			var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val());
			$('input[name=txt_total_amnt_manpower]').val(result);
		}
		else{
			var total_amnt_manpower = (Number($('input[name=txt_tact_time]').val()))*Number($('#txt_cost_mins').val());	
			$('input[name=txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('input[name=txt_sorting_qty]').change(function(){
		if($('#hdn_time_type').val()=='none'){
			var result = Number($('input[name=txt_sorting_qty]').val())*Number($('input[name=txt_cost_mins]').val())
			$('input[name=txt_total_amnt_manpower]').val(result);
		}
		else{
			$('input[name=txt_sat_sec]').val('');
			$('input[name=txt_manhours]').val('');
			$('input[name=txt_tact_time]').val('');
			$('input[name=txt_total_amnt_manpower]').val('');
		}
	});

	$('input[name=txt_material_unit_price]').change(function(){
		var total_amnt_material = Number($('input[name=txt_material_unit_price]').val())*Number($('input[name=txt_material_quantity]').val());
		$('input[name=txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=txt_total_amnt_material]').val())*.06;
		$('input[name=txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});

	$('input[name=txt_material_quantity]').change(function(){
		var total_amnt_material = Number($('input[name=txt_material_unit_price]').val())*Number($('input[name=txt_material_quantity]').val());
		$('input[name=txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=txt_total_amnt_material]').val())*.06;
		$('input[name=txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});
}

function fn_modal_u_computations_ts_pps_yf(){
	$('#u_min').change(function(){
		$('#u_cont_manhours').prop("hidden",true);
		$('#u_cont_tact_time').prop("hidden",false);
		$('input[name=u_txt_sat_sec]').prop("readonly",false);
		$('#u_hdn_time_type').val('min');
		$('input[name=u_txt_tact_time]').val('');
		$('input[name=u_txt_total_amnt_manpower]').val('');
		if($('input[name=u_txt_sorting_qty]').val()!=''){
			var minutes = Number($('#hdn_time_field').val());
			var total_amnt_manpower = Number(minutes)*Number($('#u_txt_cost_mins').val());	
		}
		else{
			var total_amnt_manpower = Number($('#u_hdn_time_field').val())*Number($('#u_txt_cost_mins').val());	
		}
		$('input[name=u_txt_tact_time]').val(minutes);
		$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#u_sec').change(function(){
		$('#u_cont_tact_time').prop("hidden",false);
		$('input[name=u_txt_sat_sec]').val('');
		$('#u_cont_manhours').prop("hidden",false);
		$('input[name=u_txt_sat_sec]').prop("readonly",true);
		$('#u_hdn_time_type').val('sec');
	});

	$('#u_txt_manhours').change(function(){
		$('input[name=u_txt_tact_time]').val('');
		$('input[name=u_txt_total_amnt_manpower]').val('');
		var manhours = $('#u_txt_manhours').val();
		var seconds = Number(manhours)*60*60/Number($('input[name=u_txt_sorting_qty]').val());
		var minutes = Number($('input[name=u_txt_sorting_qty]').val())*Number(seconds)/60;
		var total_amnt_manpower = Number(minutes)*Number($('#u_txt_cost_mins').val());
		$('input[name=u_txt_sat_sec]').val(seconds);		
		$('input[name=u_txt_tact_time]').val(minutes);
		$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
	});

	$('#u_none').click(function(){
		$('#u_cont_tact_time').prop("hidden",true);
		$('#u_cont_manhours').prop("hidden",true);
		$('input[name=u_txt_sat_sec]').prop("readonly",true);
		$('#u_hdn_time_type').val('none');
		$('input[name=u_txt_sat_sec]').val('');
		$('input[name=u_txt_manhours]').val('');
		$('input[name=u_txt_tact_time]').val('');
		var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val());
		$('input[name=u_txt_total_amnt_manpower]').val(result);
	});

	$('input[name=u_txt_sat_sec]').change(function(){
		$('#u_hdn_time_field').val($('input[name=u_txt_sat_sec]').val());

		if($('#u_hdn_time_type').val()=='min'){
			if($('input[name=u_txt_sorting_qty]').val()!=''){
				var minutes = Number($('#u_hdn_time_field').val());
				var total_amnt_manpower = Number(minutes)*Number($('#u_txt_cost_mins').val());	
			}
			else{
				var total_amnt_manpower = Number($('#u_hdn_time_field').val())*Number($('#u_txt_cost_mins').val());	
			}
			$('input[name=u_txt_tact_time]').val(minutes);
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2)); 
		}
	});

	$('#u_txt_cost_mins').change(function(){
		if($('#u_hdn_time_type').val()=='none'){
			$('input[name=u_txt_sat_sec]').val('');
			$('input[name=u_txt_manhours]').val('');
			$('input[name=u_txt_tact_time]').val('');
			var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val());
			$('input[name=u_txt_total_amnt_manpower]').val(result);
		}
		else{
			var total_amnt_manpower = (Number($('input[name=u_txt_tact_time]').val()))*Number($('#u_txt_cost_mins').val());	
			$('input[name=u_txt_total_amnt_manpower]').val(total_amnt_manpower.toFixed(2));  
		}
	});

	$('input[name=u_txt_sorting_qty]').change(function(){
		if($('#u_hdn_time_type').val()=='none'){
			var result = Number($('input[name=u_txt_sorting_qty]').val())*Number($('input[name=u_txt_cost_mins]').val())
			$('input[name=u_txt_total_amnt_manpower]').val(result);
		}
		else{
			$('input[name=u_txt_sat_sec]').val('');
			$('input[name=u_txt_manhours]').val('');
			$('input[name=u_txt_tact_time]').val('');
			$('input[name=u_txt_total_amnt_manpower]').val('');
		}
	});

	$('input[name=u_txt_material_unit_price]').change(function(){
		var total_amnt_material = Number($('input[name=u_txt_material_unit_price]').val())*Number($('input[name=u_txt_material_quantity]').val());
		$('input[name=u_txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=u_txt_total_amnt_material]').val())*.06;
		$('input[name=u_txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});

	$('input[name=u_txt_material_quantity]').change(function(){
		var total_amnt_material = Number($('input[name=u_txt_material_unit_price]').val())*Number($('input[name=u_txt_material_quantity]').val());
		$('input[name=u_txt_total_amnt_material]').val(total_amnt_material.toFixed(2));
		var transport_total_amnt = Number($('input[name=u_txt_total_amnt_material]').val())*.06;
		$('input[name=u_txt_transport_total_amnt]').val(transport_total_amnt.toFixed(2));
	});
}

function load_pmicr_dept_details(){
	var para_id = $('#p_pmicrbydept_id').text();
	var data = {
		"action" 	: "load_pmicr_dept_details",
		"para_id" 	: para_id
	}
	data = $.param(data);
	$.ajax({
		type 		: "post",
		dataType	: "json" ,
		data 		: data,
		url			: handler,
		success 	: function(data){
			var htmk = '';
			var html = '';
			$('#txt_to').val(data['pcrd_to']);
			$('#txt_attention').val(data['pcrd_attention']);
			$('#txt_cc').val(data['pcrd_cc']);
			$('#txt_control_no').val(data['pcrd_control_no']);
			$('#txt_approved_by').val(data['pcrd_approved_by1']);			
			$('#txt_approved_by2').val(data['pcrd_approved_by2']);
			$('#txt_noted_by1').val(data['pcrd_noted_by1']);
			$('#txt_noted_by2').val(data['pcrd_noted_by2']);
			$('#txt_prepared_by').val(data['pcrd_prepared_by']);	
			$('#txt_update_attention').val(data['pcrd_attention']);
			$('#txt_update_cc').val(data['pcrd_cc']);
			$('#txt_update_noted_by1').val(data['pcrd_noted_by1']);
			$('#txt_update_noted_by2').val(data['pcrd_noted_by2']);
			$('#txt_update_control_no').val(data['pcrd_control_no']);
			$('#txt_update_prepared_by').val(data['pcrd_prepared_by']);
			$('#txt_pdi_dm').val(data['pcrd_pdi_dm']);
			$('#txt_issued_date').val(data['pcrd_issued_date']);
			$('#u_txt_pdi_dm').val(data['pcrd_pdi_dm']);
			$('input[name=u_txt_issued_date]').val(data['pcrd_issued_date_og'])
			$('input[name=txt_create_control_no]').val(data['pcrd_control_no']);
			html += '<option value="'+data['pcrd_to']+'" selected>'+data['pcrd_to']+'</option>';
			if(data['pcrd_to']!='YEC SAKURA'){html += '<option value="YEC SAKURA">YEC SAKURA</option>';}
			if(data['pcrd_to']!='YEC OKAYAMA'){html += '<option value="YEC OKAYAMA">YEC OKAYAMA</option>';}
			if(data['pcrd_to']!='YEU'){html += '<option value="YEU">YEU</option>';}
			if(data['pcrd_to']!='PPS'){html += '<option value="PPS">PPS</option>';}
			$('#select_data_to').append(html);
			if(data['pcrd_approved_by2']==''){
				$('#cont_another_approver').hide();
			}
			// htmk = '<option value="'+data['pcrd_approved_by1']+'" selected>'+data['pcrd_approved_by1']+'</option>';
			// if(data['pcrd_approved_by1']=='Joel Padullo'){htmk += '<option value="Mr.Joel Padullo" selected>Mr.Joel Padullo</option>';}else{htmk += '<option value="Mr.Joel Padullo">Mr.Joel Padullo</option>';}
			// if(data['pcrd_approved_by1']=='Mr.Nelson Perpetua'){htmk += '<option value="Mr.Nelson Perpetua" selected>Mr.Nelson Perpetua</option>';}else{htmk += '<option value="Mr.Nelson Perpetua">Mr.Nelson Perpetua</option>';}
			// if(data['pcrd_approved_by1']=='Mr.Lito C. Mondok'){htmk += '<option value="Mr.Lito C. Mondok" selected>Mr.Lito C. Mondok</option>';}else{htmk += '<option value="Mr.Lito C. Mondok">Mr.Lito C. Mondok</option>';}
			// if(data['pcrd_approved_by1']=='Mr.Mitsuru Taniyama'){htmk += '<option value="Mr.Mitsuru Taniyama" selected>Mr.Mitsuru Taniyama</option>';}else{htmk += '<option value="Mr.Mitsuru Taniyama">Mr.Mitsuru Taniyama</option>';}
			// $('#txt_update_approved_by').append(htmk);
			var htms = '<option value="'+data['pcrd_approved_by1']+'">'+data['pcrd_approved_by1']+'</option>';
			var ctr_approver = data['ctr_approver'];
			for(var i=0;i<ctr_approver;i++){
				if(data['pcrd_approved_by1']!=data['flist_approver_name'][i])htms += '<option value="'+data['flist_approver_name'][i]+'">'+data['flist_approver_name'][i]+'</option>';
			}
			$('#txt_update_approved_by').append(htms);

			if(data['pcrd_approved_by2']!==''){
				var htmt = '<option value="'+data['pcrd_approved_by2']+'">'+data['pcrd_approved_by2']+'</option>';			
			}
			else{				
				var htmt = '<option value="">None</option>';	
			}
			var ctr_approver = data['ctr_approver'];
			for(var i=0;i<ctr_approver;i++){
				if(data['pcrd_approved_by2']!=data['flist_approver_name'][i])htmt += '<option value="'+data['flist_approver_name'][i]+'">'+data['flist_approver_name'][i]+'</option>';
			}
			if(data['pcrd_approved_by2']!='')htmt += '<option value="">None</option>';
			$('#txt_update_approved_by2').append(htmt);

		},
		error 		: function(data){
			alert('ERROR ON HANDLER!(load_pmicr_dept_details)');
		}
	});
}

function fn_shift_manpower_material(){
	$('#rdo_item_manpower').change(function(){
		$('#cont_items_material').prop("hidden",true);
		$('#cont_items_manpower').prop("hidden",false);
	});
	$('#rdo_item_material').change(function(){
		$('#cont_items_material').prop("hidden",false);
		$('#cont_items_manpower').prop("hidden",true);
	});
	$('#u_rdo_item_manpower').change(function(){
		$('#u_cont_items_material').prop("hidden",true);
		$('#u_cont_items_manpower').prop("hidden",false);
	});
	$('#u_rdo_item_material').change(function(){
		$('#u_cont_items_material').prop("hidden",false);
		$('#u_cont_items_manpower').prop("hidden",true);
	});
}

function fn_get_total_charges(){

	$('input[name=txt_manpower]').change(function(){	
		var txt_manpower 		= Number($('input[name=txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=txt_materials]').val());
		var txt_othercharges	= Number($('input[name=txt_othercharges]').val());
		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=txt_manpower]').val(txt_manpower.toFixed(2));
		$('input[name=txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=txt_machinetools]').change(function(){	
		var txt_manpower 		= Number($('input[name=txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=txt_materials]').val());
		var txt_othercharges	= Number($('input[name=txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=txt_machinetools]').val(txt_machinetools.toFixed(2));
		$('input[name=txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=txt_materials]').change(function(){	
		var txt_manpower 		= Number($('input[name=txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=txt_materials]').val());
		var txt_othercharges	= Number($('input[name=txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=txt_materials]').val(txt_materials.toFixed(2));
		$('input[name=txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=txt_othercharges]').change(function(){	
		var txt_manpower 		= Number($('input[name=txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=txt_materials]').val());
		var txt_othercharges	= Number($('input[name=txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=txt_othercharges]').val(txt_othercharges.toFixed(2));
		$('input[name=txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=u_txt_manpower]').change(function(){	
		var txt_manpower 		= Number($('input[name=u_txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=u_txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=u_txt_materials]').val());
		var txt_othercharges	= Number($('input[name=u_txt_othercharges]').val());
		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=u_txt_manpower]').val(txt_manpower.toFixed(2));
		$('input[name=u_txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=u_txt_machinetools]').change(function(){	
		var txt_manpower 		= Number($('input[name=u_txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=u_txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=u_txt_materials]').val());
		var txt_othercharges	= Number($('input[name=u_txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=u_txt_machinetools]').val(txt_machinetools.toFixed(2));
		$('input[name=u_txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=u_txt_materials]').change(function(){	
		var txt_manpower 		= Number($('input[name=u_txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=u_txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=u_txt_materials]').val());
		var txt_othercharges	= Number($('input[name=u_txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=u_txt_materials]').val(txt_materials.toFixed(2));
		$('input[name=u_txt_totalcharges]').val(total_charges.toFixed(2));
	});

	$('input[name=u_txt_othercharges]').change(function(){	
		var txt_manpower 		= Number($('input[name=u_txt_manpower]').val());
		var txt_machinetools 	= Number($('input[name=u_txt_machinetools]').val());
		var txt_materials 		= Number($('input[name=u_txt_materials]').val());
		var txt_othercharges	= Number($('input[name=u_txt_othercharges]').val());

		var total_charges 		= txt_manpower+txt_machinetools+txt_materials+txt_othercharges;
		$('input[name=u_txt_othercharges]').val(txt_othercharges.toFixed(2));
		$('input[name=u_txt_totalcharges]').val(total_charges.toFixed(2));
	});
}

function fn_search_export(){
	$('#btn_search_export').click(function(e){
		e.preventDefault();
		var srch_date_range = $('#input_search_date_range').val();
		t_summary_report.ajax.url( 'server-side/pmi_summary_report.php?srch_date_range=' + escape(srch_date_range)).load();
	});
}

function date_time_picker(id) {
	$('#'+id).daterangepicker(
			{
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
					'Last 7 Days': [moment().subtract('days', 6), moment()],
					'Last 30 Days': [moment().subtract('days', 29), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
				},
				startDate: moment().subtract('days', 29),
				endDate: moment()
			},
		function(start, end) {
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			if(id == "date_created_search_group") {
				load_all_control_number_per_date_created('control_number_search_list_group','control_number_search',$('#date_created_search_group').val());
			}
		}
	);
	return false;
}

function fn_add_remove_row(){
	var i = 1;
	var w = 1;
	$('#a_add_row').click(function(){
		i++;	
		var html  = '<tr class="col-md-12" style="text-align:center;" id="row'+i+'">';
			html += '	<td class="col-md-3">';
			html += '		<input class="form-control" type="text" name="txt_reference_'+i+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control" type="text" name="txt_itemname_'+i+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="Quantity" name="txt_qty_'+i+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.0000" name="txt_unitprice_'+i+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.00" name="txt_amount_'+i+'">';
			html += '	</td>';
			html += '	<td class="col-md-1">';
			html += '		<a class="remove_row"><i class="fa fa-close pointer" style="margin-top:22%;"></i></a>';
			html += '	</td>';
			html += '</tr>';
		$('#input_max_row').val(i);	
		$('#create_modal_table').append(html);	  
		fn_get_amount();
		fn_num_with_dot();
	});
	
	$('#u_a_add_row').click(function(){
		var html  = '<tr class="col-md-12" style="text-align:center;" id="row'+w+'">';
			html += '	<td class="col-md-3">';
			html += '		<input class="form-control" type="text" name="i_txt_reference_'+w+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control" type="text" name="i_txt_itemname_'+w+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="Quantity" name="i_txt_qty_'+w+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.0000" name="i_txt_unitprice_'+w+'">';
			html += '	</td>';
			html += '	<td class="col-md-2">';
			html += '		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.00" name="i_txt_amount_'+w+'">';
			html += '	</td>';
			html += '	<td class="col-md-1">';
			html += '		<a class="i_remove_row"><i class="fa fa-close pointer" style="margin-top:22%;"></i></a>';
			html += '	</td>';
			html += '</tr>';
		$('#content_loop').append(html);
		w++;
		var additional_row = $('input[name=additional_row]').val();		
		var cont_row = Number(additional_row)+1;
		$('input[name=additional_row]').val('');
		$('input[name=additional_row]').val(cont_row);
		fn_get_amount();
		fn_num_with_dot();
	});

	$("#create_modal_table").on('click', '.remove_row', function(){
		i--;
        $(this).parent().parent().remove();
        $('#input_max_row').val(i);
    });

	$("#update_modal_table").on('click', '.i_remove_row', function(){
        $(this).parent().parent().remove();
        var additional_row = $('input[name=additional_row]').val();        
		var cont_row = Number(additional_row)-1;
		$('input[name=additional_row]').val('');
		$('input[name=additional_row]').val(cont_row);
    });
}

function fn_signatories_val(){
	var para_dept = $('#paragraph_dept').text();
	var username = $('#hd_username').val();
	var data = {
		"action" 	: "fn_signatories_val",
		"para_dept" : para_dept,
		"username" 	: username
	}
	data = $.param(data);
	$.ajax({
		type 		: "post",
		dataType	: "json" ,
		data 		: data,
		url			: handler,
		success 	: function(data){
			// $('input[name=txt_approved_by]').val(data['approver_name']);
			var ctr_approver = data['ctr_approver'];
			var htmj = '';
			for(var i=0;i<ctr_approver;i++){
				htmj += '<option value="'+data['approver_name'][i]+'">'+data['approver_name'][i]+'</option>';
			}
			$('select[name=txt_approved_by]').append(htmj);
			$('select[name=another_txt_approved_by]').append(htmj);
			$('input[name=txt_noted_by]').val(data['noter_name']);
			$('input[name=another_txt_noted_by]').val(data['another_noter_name']);
			$('input[name=txt_prepared_by]').val(data['prepared_by']);
			if(data['pmicr_approver']!=='x'){
				$('input[name=hdn_status_of_pmicrapprover]').val(data['pmicr_approver_id']);
			}
			else{
				$('input[name=hdn_status_of_pmicrapprover]').val('null');
			}
			if(data['pmicr_checker']!=='x'){
				$('input[name=hdn_status_of_pmicrchecker]').val(data['pmicr_checker_id']);
			}
			else{
				$('input[name=hdn_status_of_pmicrchecker]').val('null');
			}
			if(data['approver_name']!=='x'||data['noter_name']!=='x'){
				$('input[name=hdn_status_of_signatories1]').val(data['approver_id']+'-'+data['noter_id']);
			}
			else{
				$('input[name=hdn_status_of_signatories1]').val('null');
			}
			if(data['another_noter_name']!=='x'&&data['another_noter_name']!==''){
				$('input[name=hdn_status_of_signatories2]').val(data['another_noter_id']);
			}
			else{
				$('input[name=hdn_status_of_signatories2]').val('null');
			}
		},
		error 		: function(data){
			alert('ERROR ON HANDLER!(load_control_number)');
		}
	});
}

function fn_num_with_dot(){
	$('.decimal').keypress(function(evt){
    	return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
	});
}

function fn_cn_t_content(){
	var control_no = $('#p_control_no').text();
	var t_content_cn = $('#t_content_cn').DataTable({
		"ajax" : "./server-side/content_cn.php?control_no="+control_no,
		select: false,
		scrollY: false,
		scrollX: true,
		scrollCollapse: true,
		fixedHeader: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]]	
	});
}

function fn_yf_t_content(){
	var control_no = $('#p_control_no').text();
	var t_content_yf = $('#t_content_yf').DataTable({
		"ajax" : "./server-side/content_yf.php?control_no="+control_no,
		select: false,
		scrollY: false,
		scrollX: true,
		scrollCollapse: true,
		fixedHeader: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]]	
	});
}

function fn_ts_t_content(){
	var control_no = $('#p_control_no').text();
	var t_content_ts = $('#t_content_ts').DataTable({
		"ajax" : "./server-side/content_ts.php?control_no="+control_no,
		scrollCollapse: false,
		scrollX: true,
		scrollY: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]],
		responsive: true
	});
}

function fn_pps_t_content(){
	var control_no = $('#p_control_no').text();
	var t_content_pps = $('#t_content_pps').DataTable({
		"ajax" : "./server-side/content_pps.php?control_no="+control_no,
		select: false,
		scrollY: false,
		scrollX: true,
		scrollCollapse: true,
		fixedHeader: false,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		order: [[0,"asc"]]	
	});
}

function fn_remove_disable_addons(){
	$('#btn_edit_add_ons_a').click(function(){
		$('input[name=txt_add_control_no]').prop("disabled",false);
	});
	$('#btn_edit_add_ons_b').click(function(){
		$('input[name=txt_add_machine_tools]').prop("disabled",false);
	});
	$('#btn_edit_add_ons_c').click(function(){
		$('input[name=txt_add_materials]').prop("disabled",false);
	});
	$('#btn_edit_add_ons_d').click(function(){
		$('input[name=txt_add_other_charges]').prop("disabled",false);
	});
}

// function fn_disable_field(){
	// $('#rdo_included_tta').click(function(){
	// 	$('input[name=txt_transport_total_amnt]').prop("disabled",false);
	// });

	// $('#rdo_not_tta').click(function(){
	// 	$('input[name=txt_transport_total_amnt]').prop("disabled",true);
	// })
	// $('#rdo_included_sq').click(function(){
	// 	$('input[name=txt_sorting_qty]').prop("disabled",false);
	// });

	// $('#rdo_not_sq').click(function(){
	// 	$('input[name=txt_sorting_qty]').prop("disabled",true);
	// })
// }