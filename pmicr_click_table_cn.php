<?php
	$pmicr_bydept_id=$_GET['id'];
	$pmicrd_control_no=$_GET['control_no'];
?>
<p id="p_pmicrbydept_id" hidden><?php echo $pmicr_bydept_id;?></p>
<p id="p_control_no" hidden><?php echo $_GET['control_no']?></p>
<p id="paragraph_dept" style="position:absolute;" hidden>cn</p>
<div class="col-md-12">
	<div class="col-md-12" style="margin-top:1.5%;">
		<a href="./index.php?page=pmicr_cn.inc.php"><button class="btn btn-default pull-left grow"><i class="fa fa-arrow-left"></i>&nbsp;Back</button></a>
		<button class="btn btn-warning pull-left grow" id="btn_print" style="margin-left:1%;"><i class="fa fa-print"></i>&nbsp;Print</button> 
	</div>
	<div class="box box-primary" style="margin-top:5%;height:80%;background-color:#eff3f9;padding:2%;overflow-y:scroll;">
		<div class="panel panel-primary">
			<div class="panel-heading">PMI Charging Report (CN)</div>
				<div class="panel-body" style="padding-right:3%;padding-left:3%;">
					<div class="col-md-6" style="padding-top:1%;">
						<div class="col-md-12" style="padding-bottom:2%;">
							<div class="form-group">
								<div class="col-md-3">
									<label style="white-space:nowrap;">Control No</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8"> 
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_control_no">
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-md-3">
									<label>To</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_to">
								</div> 
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label>Attention</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_attention">
								</div>	
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label>CC</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_cc">
								</div>	
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label>PDI DM</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_pdi_dm">
								</div>	
							</div>
						</div>
					</div>
					<div class="col-md-6" style="padding-top:1%;"> 
						<div class="col-md-12" >
							<div class="form-group">
								<div class="col-md-3">
									<label style="white-space:nowrap;">Approved By</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<div class="input-group"> 
										<input class="form-control xover" style="border-radius:3px;margin-bottom:1.5%;" readonly="true" id="txt_approved_by">
										<span class="input-group-addon" style="border:none;"><i style="font-size: 10px;color:red;">*Bottom</i></span>
									</div>	
								</div>
							</div>
							<div id="cont_another_approver">
								<div class="form-group">
									<div class="col-md-3">
										<label style="white-space:nowrap;"></label>
									</div>
									<div class="col-md-1">
										<label class="pull-left">:</label>
									</div>
									<div class="col-md-8" > 
										<div class="input-group">
											<input class="form-control xover" style="border-radius:3px;margin-bottom:1.5%;" readonly="true" id="txt_approved_by2">
										<span class="input-group-addon" style="border:none;"><i style="font-size: 10px;color:red;">*Top&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label style="white-space:nowrap;">Noted By</label>
								</div>
								<div class="col-md-1" >
									<label class="pull-left">:</label>
								</div>
								
								<div class="col-md-8"> 
									<!-- <select class="form-control" id="txt_noted_by1">
									</select> -->
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_noted_by1">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;"></label>
								</div>
								<div class="col-md-1">
									<label class="pull-right"></label>
								</div>
								<div class="col-md-8" style="margin-left:5%;margin-bottom:1%;">
									<input class="form-control xover" name="another_txt_noted_by" id="txt_noted_by2" readonly="true">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label style="white-space:nowrap;">Prepared By</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8" > 
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_prepared_by">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label style="white-space:nowrap;">Issued Date</label>
								</div>
								<div class="col-md-1">
									<label class="pull-left">:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control xover" style="margin-bottom:1.5%;" readonly="true" id="txt_issued_date">
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer" style="text-align:right;"> 
						<button class="btn btn-success grow" type="button" id="btn_add_content_bdept" style="margin-right:.8%;"><i class="fa fa-plus"></i> Add Report</button> 
						<button class="btn btn-info grow" id="btn_update_info" type="button"><i class="fa fa-edit"></i> Update Info</button>		
						<a href="./export/excel_cn.export.php?control_no=<?php echo $pmicrd_control_no;?>" target="_blank" style="font-decoration:none;"><button class="btn btn-danger grow" type="button" style="margin-left:.8%;"><i class="fa fa-file-excel-o"></i> Export</button></a>
					</div>
			</div>
			<br><br>
			<table id="t_content_cn" class="display table-bordered stripe compact cell-border table-hover" style="border-color:#ccd4e2;border-radius:7px;font-size:14px;">
				<thead>
					<tr style="height:50px;font-size:11px;">	
						<th style="width:1%;text-align:center;"><i class="fa fa-hashtag"></i></th>
						<th style="width:1%;text-align:center;">In-Charge Section</th>
						<th style="width:1%;text-align:center;">Material/ Product Code</th>
						<th style="width:1%;text-align:center;">Material/ Product Name</th>
						<th style="width:1%;text-align:center;min-width:100px;">Detail</th>
						<th style="width:1%;text-align:center;">Billing Summary</th>	
						<th style="width:1%;text-align:center;background-color:#074fc1;color:#fcfcfc;">Material Unit Price</th>
						<th style="width:1%;text-align:center;background-color:#074fc1;color:#fcfcfc;">Material Qty.</th>
						<th style="width:1%;text-align:center;background-color:#074fc1;color:#fcfcfc;">Total Amount</th>		
						<th style="width:1%;text-align:center;background-color:#13a529;color:#fcfcfc;">Sorting Qty.</th>
						<!-- <th style="width:1%;text-align:center;background-color:#13a529;color:#fcfcfc;">Tact Time</th>		 -->
						<th style="width:1%;text-align:center;background-color:#13a529;color:#fcfcfc;">Total Manhours (mins)</th>		
						<th style="width:1%;text-align:center;background-color:#13a529;color:#fcfcfc;">Cost/Mins.</th>		
						<th style="width:1%;text-align:center;background-color:#13a529;color:#fcfcfc;">Total Amount</th>		
						<th style="width:1%;text-align:center;background-color:#ff9d00;color:black;">Transport Total Amnt.</th>
						<th style="width:1%;text-align:center;background-color:#fffa00;color:black;">Total Amnt. (Transport Included)</th>
						<th style="width:1%;text-align:center;">Detail of Indication</th>
						<th style="width:1%;text-align:center;">Supplier Name</th>	
						<th style="width:1%;text-align:center;">YEC Billing Request</th>
						<th style="width:1%;text-align:center;">Category</th>			
					</tr>
				</thead>  
				<tbody class="pointer">
				</tbody>
			</table> 
	</div> 	
</div>
<div class="modal fade" id="mdl_print">
	<div class="modal-dialog" style="width:33%;margin-top:5%;">
		<form method="post" id="frm_print" target="_blank" action="./cr_report_by_dept.php?control_no=<?php echo $pmicrd_control_no;?>">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-print"></i>&nbsp;&nbsp;Print PMI Charging Report (CN)</h4>
				</div>
				<div class="modal-body"> 
					<div class="form-group">
						<label>Memo Type:</label>
						<select class="form-control" name="txt_memo_type"> 
							<option value="Choose Memo">Choose Memo</option>
							<option value="Debit">Debit Memo</option>
							<option value="Credit">Credit Memo</option>
						</select>
				   	</div>
					<div class="form-group">
						<label>Month:</label>
						<select class="form-control" name="txt_month"> 						
							<option value="Choose Month">Choose Month</option>
							<option value="January">January</option>
							<option value="February">February</option>
							<option value="March">March</option>
							<option value="April">April</option>
							<option value="May">May</option>
							<option value="June">June</option>
							<option value="July">July</option>
							<option value="August">August</option>
							<option value="September">September</option>
							<option value="October">October</option>
							<option value="November">November</option>
							<option value="December">December</option>
						</select>
					</div>
					<div class="form-group">
							<label>Year:</label>
							<input class="decimal form-control" name="txt_year" placeholder="Year" value="<?php echo date('Y');?>">
					</div>    
				</div>
				<div class="modal-footer">
					<button id="submit_print" type="button" class="btn btn-success"><span class="fa fa-print" aria-hidden="true"></span>&nbsp;Print</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="mdl_add_report">
	<div class="modal-dialog" style="width:45%;margin-top:.8%;">
		<form method="post" id="frm_add_report">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Content PMI Charging Report CN</h4>
				</div>
				<div class="modal-body" style="height:73%;overflow-y:scroll;">						
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-3">
									<input class="form-control" id="txt_dept" value="CN" style="display: none;">
								</div>
								<div class="col-md-3">
									<span style="white-space:nowrap;"><input type="radio" name="rdo_type" id="rdo_item_manpower" value="1" checked> Manpower</span>
								</div>
								<div class="col-md-3">
									<input type="radio" name="rdo_type" id="rdo_item_material" value="2"> Material
								</div>
								<div class="col-md-3">
									<input type="radio" name="rdo_type" id="rdo_others" value="3"> Others
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">In-Charge Section:</label>
									<input class="form-control"  placeholder="In-Charge Section" name="txt_incharge_section">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Material/Product Code:</label>
									<!-- <input class="form-control" placeholder="Material/Product Code" name="txt_material_code"> -->
									<!-- <input class="form-control" list="material_code_list" type="text" placeholder="Material/ Product Code" id="txt_material_code" name="txt_material_code" autocomplete="off"> -->
									<!-- Darren 7-2-24 -->
									<input class="form-control materialCodeCN" list="material_code_list" type="text" placeholder="Material/ Product Code" id="txt_material_code" name="txt_material_code" autocomplete="off">
							  		<datalist id="material_code_list">
							       	</datalist>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Material/Product Name:</label>
									<input class="form-control" placeholder="Material/Product Name" id="txt_material" name="txt_material">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Details:</label>
									<input class="form-control" placeholder="Details" name="txt_detail">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label>Billing Summary:</label>
									<select class="form-control" placeholder="Billing Summary" name="txt_billing_summary">
										<option value="">None</option>
										<option>Parts Cost (Material NG)</option>
										<option>Sorting Cost</option>
										<option>Transport Cost</option>
										<option>Additional Work</option>
										<option>Parts Cost (Other)</option>
										<option>Parts Cost (Unit)</option>
									</select>
								</div>
							</div>
							<div id="cont_items_material" hidden>
								<div class="form-group">
									<div class="col-md-3">
										<label style="white-space:nowrap;">Material Unit Price:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control num_only decimal" placeholder="Material Unit Price" id="txt_material_unit_price" name="txt_material_unit_price">
									</div>
								</div>  
								<div class="form-group">
									<div class="col-md-12">
										<label style="white-space:nowrap;">Material Quantity:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Material Quantity" name="txt_material_quantity" id="txt_material_quantity">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label style="white-space:nowrap;">Total Amount(USD):</label>
									</div>
									<div class="col-md-12">
										<input class="form-control" placeholder="Total Amount(USD)" name="txt_total_amnt_material">
									</div>
								</div>   
								<div class="form-group">
									<div class="col-md-12">
										<label>Transport Total Amount:</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<span style="white-space:nowrap"><input id="rdo_included_tta" type="radio" value="1" name="rdo_include_tta" checked> Included</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" value="0" id="rdo_not_tta" name="rdo_include_tta"> Not
									</div>
								</div>
								<div class="col-md-8">
									<input class="form-control" readonly="true" name="txt_transport_total_amnt">						
								</div>
							</div>
							<div id="cont_items_manpower">
								<div class="form-group">
									<div class="col-md-12">
										<label>Sorting Quantity:</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<span style="white-space:nowrap"><input type="radio" value="1" id="rdo_included_sq" name="rdo_include_sqty" checked> Included</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" value="0" id="rdo_not_sq" name="rdo_include_sqty"> Not
									</div>
								</div>
								<div class="col-md-8">
									<input class="form-control decimal" name="txt_sorting_qty" placeholder="Sorting Quantity">						
								</div>
								<div class="form-group">
									<div class="col-md-10" >
									<label>SAT/Sec:</label>
									</div>
									<div class="col-md-12">
									</div>
								</div>
								<input type="hidden" id="hdn_time_field">
								<input type="hidden" id="hdn_time_type" val="min">
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="rdo_time_conv" id="sec"> Sec
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="rdo_time_conv" id="min" checked> Min
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="rdo_time_conv" id="hrs"> Hrs
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="rdo_time_conv" id="none"> None
									</div>
								</div>								
								<div class="form-group">
									<div class="col-md-4"> 
										<input class="form-control decimal" name="txt_sat_sec">
									</div>
								</div>  
								<div id="cont_tact_time">
									<div class="form-group">
										<div class="col-md-3">
											<label>Minutes:</label>
										</div>
										<div class="col-md-12">
											<input class="form-control xover" placeholder="Minutes" readonly="true" name="txt_seconds">
										</div>
									</div>
									<input name="txt_manhours" type="hidden">									
									<div class="form-group">
										<div class="col-md-3">
											<label>Tact Time:</label>
										</div>
										<div class="col-md-12">
											<input class="form-control xover" placeholder="Tact Time" readonly="true" name="txt_tact_time">
										</div>
									</div> 
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<label>Cost/Mins:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Cost/Mins." id="txt_cost_mins" name="txt_cost_mins" value="0.0650">
									</div>
								</div>   
								<div class="form-group">
									<div class="col-md-4">
										<label style="white-space:nowrap;">Total Amount(USD):</label>
									</div>
									<div class="col-md-12">
										<input class="form-control xover" placeholder="Total Amount(USD)" readonly="true" name="txt_total_amnt_manpower">
									</div>
								</div>  
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Detail of Indication:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Detail of Indication" name="txt_detail_of_indication">
								</div>
							</div>  
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Supplier Name:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Supplier Name" name="txt_supplier">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">YEC Billing Request:</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" name="txt_yec_billing">
										<option value="">None</option>
										<option value="Debit">Debit</option>
										<option value="Credit">Credit</option>
										<option value="Invoice">Invoice</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Category:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Category" name="txt_category">
								</div>
							</div>   
						</div>
				</div>
				<div class="modal-footer">					
					<button id="submit_add_report" type="button" class="btn btn-success"><span class="fa fa-save" aria-hidden="true"></span>&nbsp;Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"> </i> Close</button>
				</div>
			</div>
		</form>
	</div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdl_confirm_add_report">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_add_report">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        System Alert
	      </div>
	      <div class="modal-body">      	
	      	Are you sure you want to add this?
	      </div>
	      <div class="modal-footer">        
	        <button type="submit" class="btn btn-success">Yes</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
	      </div>
	    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="mdl_update_info">
	<div class="modal-dialog" style="width:65%;margin-top:7%;">
		<form method="post" id="frm_update_info">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update PMI Charging Report (CN)</h4>
				</div>
				<div class="modal-body" style="overflow-y:scroll;padding-top:3%;height:42%;">  
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group"> 
								<div class="col-md-4">
									<label class="nowrap">Control No:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control" id="txt_update_control_no"  name="u_txt_control_no" readonly="true">
								</div> 
							</div>
							<br>		
							<div class="form-group"> 
								<div class="col-md-4">
									<label>To:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<select class="form-control" id="select_data_to" name="u_txt_to">
									</select>
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label>Attention:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control" id="txt_update_attention" name="u_txt_attention">
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label>CC:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control" id="txt_update_cc" name="u_txt_cc">
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label>PDI DM:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control" id="u_txt_pdi_dm" name="u_txt_pdi_dm">
								</div> 
							</div>
						</div>
						<div class="col-md-6">	
							<div class="form-group"> 
								<div class="col-md-4">
									<label style="white-space:nowrap;">Approved By:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<select class="form-control" id="txt_update_approved_by" name="u_txt_approved_by">
									</select>
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label style="white-space:nowrap;"></label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<select class="form-control" id="txt_update_approved_by2" name="u_txt_approved_by2">
									</select>
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label style="white-space:nowrap;">Noted By:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<select class="form-control" id="txt_update_noted_by1" name="u_txt_noted_by1">
									</select>
									<!-- <input class="form-control xover" readonly="true" name="u_txt_noted_by1" id="txt_update_noted_by1"> -->
								</div> 
							</div>
							<div class="form-group"> 
								<div class="col-md-4">
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control xover" readonly="true" name="u_txt_noted_by2" id="txt_update_noted_by2">
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label style="white-space:nowrap;">Prepared By:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1.5%;">
									<input class="form-control xover" readonly="true" name="u_txt_prepared_by" id="txt_update_prepared_by">
								</div> 
							</div>
							<br>
							<div class="form-group"> 
								<div class="col-md-4">
									<label style="white-space:nowrap;">Issued Date:</label>
								</div>
								<div class="col-md-8">
									<input class="form-control" id="u_txt_issued_date" name="u_txt_issued_date">
								</div> 
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">					
					<button id="submit_update_info" type="button" class="btn btn-success"><span class="fa fa-save" aria-hidden="true"></span>&nbsp;Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="mdl_confirm_update_info">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_update_info">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        System Alert
	      </div>
	      <div class="modal-body">      	
	      	Are you sure you want to update the details of this Charging Report?
	      </div>
	      <div class="modal-footer">        
	        <button type="submit" class="btn btn-success">Yes</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
	      </div>
	    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="mdl_update_content">
	<div class="modal-dialog" style="width:45%;margin-top:.8%;">
		<form method="post" id="frm_update_content">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Content PMI Charging Report CN</h4>
				</div>
				<div class="modal-body" style="height:73%;overflow-y:scroll;">					
						<input name="hdn_content_id" type="hidden">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<span style="white-space:nowrap;"><input type="radio" name="u_rdo_type" id="u_rdo_item_manpower" value="1" checked> Manpower</span>
								</div>
								<div class="col-md-3">
									<input type="radio" name="u_rdo_type" id="u_rdo_item_material" value="2"> Material
								</div>
								<div class="col-md-3">
									<input type="radio" name="u_rdo_type" id="u_rdo_others" value="3"> Others
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">In-Charge Section:</label>
									<input class="form-control" placeholder="In-Charge Section" name="u_txt_incharge_section">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Material/Product Code:</label>
									<input class="form-control" placeholder="Material/Product Code" name="u_txt_material_code">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Material/Product Name:</label>
									<input class="form-control" placeholder="Material/Product Name" name="u_txt_material">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Details:</label>
									<input class="form-control" placeholder="Details" name="u_txt_detail">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label>Billing Summary:</label>
									<select class="form-control" placeholder="Billing Summary" id="u_txt_billing_summary" name="u_txt_billing_summary">
									</select>
								</div>
							</div>
							<div id="u_cont_items_material">
								<div class="form-group">
									<div class="col-md-3">
										<label style="white-space:nowrap;">Material Unit Price:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Material Unit Price" name="u_txt_material_unit_price">
									</div>
								</div>  
								<div class="form-group">
									<div class="col-md-12">
										<label style="white-space:nowrap;">Material Quantity:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Material Quantity" name="u_txt_material_quantity">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label style="white-space:nowrap;">Total Amount(USD):</label>
									</div>
									<div class="col-md-12">
										<input class="form-control xover" placeholder="Total Amount(USD)" name="u_txt_total_amnt_material">
									</div>
								</div>   
								<div class="form-group">
									<div class="col-md-12">
										<label>Transport Total Amount:</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<span style="white-space:nowrap"><input id="u_rdo_included_tta" type="radio" value="1" name="u_rdo_include_tta" checked> Included</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" value="0" id="u_rdo_not_tta" name="u_rdo_include_tta"> Not
									</div>
								</div>
								<div class="col-md-8">
									<input class="form-control" readonly="true" name="u_txt_transport_total_amnt">						
								</div>
							</div>
							<div id="u_cont_items_manpower">
								<div class="form-group">
									<div class="col-md-12">
										<label>Sorting Quantity:</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<span style="white-space:nowrap"><input type="radio" value="1" id="u_rdo_included_sq" name="u_rdo_include_sqty" checked> Included</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" value="0" id="u_rdo_not_sq" name="u_rdo_include_sqty"> Not
									</div>
								</div>
								<div class="col-md-8">
									<input class="form-control decimal" name="u_txt_sorting_qty">						
								</div>
								<div class="form-group">
									<div class="col-md-10" >
									<label>SAT/Sec:</label>
									</div>
									<div class="col-md-12">
									</div>
								</div>
								<input type="hidden" id="u_hdn_time_field">
								<input type="hidden" id="u_hdn_time_type" val="min">
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="u_rdo_time_conv" id="u_sec"> Sec
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="u_rdo_time_conv" id="u_min" checked> Min
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="u_rdo_time_conv" id="u_hrs"> Hrs
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" name="u_rdo_time_conv" id="u_none"> None
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4"> 
										<input class="form-control decimal" name="u_txt_sat_sec">
									</div>
								</div>  
								<input name="u_txt_manhours" type="hidden">
								<div id="u_cont_tact_time">
									<div class="form-group">
										<div class="col-md-3">
											<label>Minutes:</label>
										</div>
										<div class="col-md-12">
											<input class="form-control xover" placeholder="Minutes" readonly="true" name="u_txt_seconds">
										</div>
									</div>
									 <div class="form-group">
										<div class="col-md-3">
											<label>Tact Time:</label>
										</div>
										<div class="col-md-12">
											<input class="form-control xover" placeholder="Tact Time" readonly="true" name="u_txt_tact_time">
										</div>
									</div> 	
								</div>				
								<div class="form-group">
									<div class="col-md-12">
										<label>Cost/Mins:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Cost/Mins." id="u_txt_cost_mins" name="u_txt_cost_mins" value="0.0650">
									</div>
								</div>  
								<div class="form-group">
									<div class="col-md-4">
										<label style="white-space:nowrap;">Total Amount(USD):</label>
									</div>
									<div class="col-md-12">
										<input class="form-control xover" placeholder="Total Amount(USD)" readonly="true" name="u_txt_total_amnt_manpower">
									</div>
								</div>  
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Detail of Indication:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Detail of Indication" name="u_txt_detail_of_indication">
								</div>
							</div>  
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Supplier Name:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Supplier Name" name="u_txt_supplier">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">YEC Billing Request:</label>
								</div>
								<div class="col-md-12">
									<select class="form-control" name="u_txt_yec_billing" id="u_txt_yec_billing">
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Category:</label>
								</div>
								<div class="col-md-12">
									<input class="form-control" placeholder="Category" name="u_txt_category">
								</div>
							</div>   
						</div>
					</div>
				<div class="modal-footer">					
					<button id="submit_update_content" type="button" class="btn btn-success"><span class="fa fa-save" aria-hidden="true"></span>&nbsp;Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"> </i> Close</button>
				</div>
			</div>
		</form>
	</div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="mdl_confirm_update_content">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_update_content">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        System Alert
	      </div>
	      <div class="modal-body">      	
	      	Are you sure you want to update the content of this Charging Report?
	      </div>
	      <div class="modal-footer">        
	        <button type="submit" class="btn btn-success">Yes</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
	      </div>
	    </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="./js/pmicr.fn.js?n=451236"></script>
<script type="text/javascript">
	fn_num_with_dot();	
	load_pmicr_dept_details();
	fn_shift_manpower_material();
	fn_modal_computations_cn();
	fn_modal_u_computations_cn();	
	fn_cn_t_content();
	$('#input_date').datepicker({
		format: 'mm/dd/yyyy',
		changeMonth: true, 
		changeYear: true
	});
	$('#txt_click_issued_date').datepicker({
		format: 'mm/dd/yyyy',	
		changeMonth: true, 
		changeYear: true
	});
	$('#u_txt_issued_date').datepicker({
		format: 'mm/dd/yyyy',	
		changeMonth: true, 
		changeYear: true
	});	
</script>