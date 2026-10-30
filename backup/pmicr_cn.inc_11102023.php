<div class="col-md-12">
	<div class="col-md-12" style="margin-top:1.5%;">
		<button class="btn btn-success btn-md pull-left grow" style="margin-right:1%;" id="btn_create_pmi_bydept"><i class="fa fa-plus"></i> Create - CN</button>
	</div>
	<div class="col-md-12" style="margin-top:1.5%;">
		<div class="box box-primary" style="background-color:#eff3f9;padding:3%;height:78%;padding-top:2%;">
			<table id="t_cn" class="display table-bordered table-hover" style="border-color:#ccd4e2;border-radius:7px;">
				<thead>
					<tr style="height:50px;background-color:#11418e;color:#fcfcfc;">
						<th style="width:1%;text-align:center;">No</th>
						<th style="width:10%;text-align:center;">Issued Date</th>
						<th style="width:11%;text-align:center;">Control No</th>
						<th style="width:12%;text-align:center;">To</th>
						<th style="width:12%;text-align:center;">Attention</th>
						<th style="width:12%;text-align:center;">CC</th>	
						<th style="width:14%;text-align:center;">Approved By</th>
						<th style="width:14%;text-align:center;">Noted By</th>
						<th style="width:14%;text-align:center;">Prepared By</th>							
					</tr>
				</thead>
				<tbody class="pointer" style="font-size:90%;">
				</tbody>
			</table>	
		</div>
	</div>
</div>
<div class="modal fade" id="modal_create_pmi_bydept">
	<div class="modal-dialog" style="width:50%;margin-top:.4%;">
		<form method="post" id="frm_create_pmi_bydept">
			<div class="modal-content" >
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create PMI Charging Report CN</h4>
				</div>
				<div class="modal-body" style="height:75%;overflow-y:scroll;">   
					<p id="paragraph_dept" style="position:absolute;" hidden>cn</p>
					<div class="panel panel-default">
						<div class="panel-body" style="padding-top:0%;">
							<div class="form-group" id="field_req_leg" style="text-align:right;">
							</div>
							<!-- <input type="hidden" name="another_txt_noted_by" value=""> -->
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label>Control No</label>
								</div>
								<div class="col-md-1" >
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left: 4%;margin-bottom: 1%;">
									<input class="form-control" name="txt_control_no">
								</div>
							</div>
							<br>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label>To</label><span class="input_required"></span>
								</div>
								<div class="col-md-1"> 
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<select class="form-control" name="txt_to" required="required" >
										<option value="ASIA YAMAICHI ELECTRONICS INC.">ASIA YAMAICHI ELECTRONICS INC.</option>
										<option value="PPS">PPS</option>
										<option value="Service Resources Inc.">Service Resources Inc.</option>
										<option value="TS">TS</option>	
										<option value="YEC SAKURA">YEC SAKURA</option>
										<option value="YEC OKAYAMA">YEC OKAYAMA</option>
										<option value="YEU">YEU</option>
										<option value="YF ASSY">YF ASSY</option>
										<option value="YAMAICHI SEIKO PHILIPPINES INC.">YAMAICHI SEIKO PHILIPPINES INC.</option>	
										<option value="ENOMOTO PHILIPPINES MANUFACTURING, INC.">ENOMOTO PHILIPPINES MANUFACTURING, INC.</option>
										<option value="SANNO PHILIPPINES MANUFACTURING CORP.">SANNO PHILIPPINES MANUFACTURING CORP.</option>
										<option value="TSS">TSS</option>
										<option value="YAMAICHI ELECTRONICS SINGAPORE PTE LTD.">YAMAICHI ELECTRONICS SINGAPORE PTE LTD.</option>
										<option value="YAMAICHI ELECTRONICS CO. LTD. HONGKONG">YAMAICHI ELECTRONICS CO. LTD. HONGKONG</option>
										<!-- ^ Connected to js, Update JS File -->
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label>Attention</label><span class="input_required"></span>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-bottom:1%;margin-left:4%;" >
									<input class="form-control" name="txt_attention" placeholder="Attention" autocomplete="OFF">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label>CC</label>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;" >
									<input class="form-control" name="txt_cc" placeholder="CC">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;">Issued Date</label>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<input class="form-control" id="input_date" name="txt_issued_date" placeholder="Issued Date">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;">Approved By</label>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<select class="form-control" id="input_date" name="txt_approved_by">
									</select>
									<!-- <select class="form-control" name="txt_to" required="required" >
										<option value="Mr. Mitsuru Taniyama">Mr. Mitsuru Taniyama</option>
										<option value="Mr. Nelson Perpetua">Mr. Nelson Perpetua</option>
										<option value="Mr. Lito Mondok">Mr. Lito Mondok</option>
										<option value="Ms. Lyn Sunga">Ms. Lyn Sunga</option>
										 ^ Connected to js, Update JS File
									</select> -->
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;"></label>
								</div>
								<div class="col-md-1">
									<label class="pull-right"></label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<select class="form-control" name="another_txt_approved_by">
									<!-- <option value="">None</option> -->
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;">Noted By</label>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<input class="form-control xover" id="input_date" name="txt_noted_by" readonly="true">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;"></label>
								</div>
								<div class="col-md-1">
									<label class="pull-right"></label>
								</div>
								<div class="col-md-8" style="margin-left:4%;margin-bottom:1%;">
									<input class="form-control xover" name="another_txt_noted_by" readonly="true">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3" style="margin-right:-5%;">
									<label style="white-space:nowrap;">Prepared By</label>
								</div>
								<div class="col-md-1">
									<label class="pull-right">:</label>
								</div>
								<div class="col-md-8" style="margin-left:4%;">
									<input class="form-control xover" id="input_date" name="txt_prepared_by" readonly="true">
								</div>
							</div>								
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<span style="white-space:nowrap;"><input type="radio" name="rdo_type" id="rdo_item_manpower" value="1" checked> Manpower</span>
								</div>
								<div class="col-md-3">
									<input type="radio" name="rdo_type" id="rdo_item_material" value="2"> Material
								</div>
								<div class="col-md-3"></div>
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
									<input class="form-control" placeholder="Material/Product Code" name="txt_material">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Material/Product Name:</label>
									<input class="form-control" placeholder="Material/Product Name" name="txt_material">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label style="white-space:nowrap;">Details:</label>
									<input class="form-control" placeholder="Details" name="txt_detail">
								</div>
							</div>
							<div class="form-group" hidden>
								<div class="col-md-12">
									<label>Billing Summary:</label>
									<select class="form-control" placeholder="Material/Product Name" name="txt_billing_summary">
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
										<input class="form-control decimal" placeholder="Material Unit Price" name="txt_material_unit_price">
									</div>
								</div>  
								<div class="form-group">
									<div class="col-md-12">
										<label style="white-space:nowrap;">Material Quantity:</label>
									</div>
									<div class="col-md-12">
										<input class="form-control decimal" placeholder="Material Quantity" name="txt_material_quantity">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label style="white-space:nowrap;">Total Amount(USD):</label>
									</div>
									<div class="col-md-12">
										<input class="form-control xover" placeholder="Total Amount(USD)" readonly="true" name="txt_total_amnt_material">
									</div>
								</div>   
								<div class="form-group">
									<div class="col-md-12">
										<label>Transport Total Amount:</label>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<span style="white-space:nowrap"><input id="rdo_included_tta" placeholder="Transport Total Amount" type="radio" value="1" name="rdo_include_tta" checked> Included</span>
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
									<input class="form-control decimal" placeholder="Sorting Quantity" name="txt_sorting_qty">						
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
				</div>
				<div class="modal-footer">
					<button id="submit_create_pmi_bydept" type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"> </i> Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="modal_confirm_create_pmi_bydept">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_create_pmi_bydept">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        System Alert
	      </div>
	      <div class="modal-body">      	
	      	Are you sure you want to save this PMI Charging Report?
	      </div>
	      <div class="modal-footer">        
	        <button type="submit" class="btn btn-success">Yes</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
	      </div>
	    </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="./js/pmicr.fn.js?n=1"></script>
<script type="text/javascript">
	fn_num_with_dot();
	fn_shift_manpower_material();
	fn_modal_computations_cn();
	load_control_number();
	fn_signatories_val();
	$('#input_date').datepicker({
		format: 'mm/dd/yyyy',
		changeMonth: true, 
		changeYear: true
	});
	$("#input_date").datepicker("setDate", new Date());
</script>
