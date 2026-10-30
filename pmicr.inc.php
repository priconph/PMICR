<!-- <i style="position:absolute;right:2%;" class="fa fa-renren fa-5x fa-spin"></i> -->
<div class="col-md-12">
	<div class="col-md-12" style="margin-top:1.5%;">
		<div class="box" style="border-top:none;">

			<button class="btn btn-success btn-md pull-left grow" style="margin-right:1%;" data-toggle="modal" data-target="#modal_create_pmi" name="btn_create"><i class="fa fa-plus" ></i> Create</button>	
		</div>
	</div><br><br>
	<div class="col-md-12" style="margin-top:1.5%;font-family:Segoe UI;">
		<div class="box box-primary" style="background-color:#eff3f9;padding:3%;height:78%;padding-top:2%;">
			<table id="t_main" class="display table-bordered stripe compact cell-border table-hover" style="border-color:#ccd4e2;border-radius:4px;">
				<thead>
					<tr style="height:50px;background-color:#11418e;color:#fcfcfc;">	
						<th style="width:2.5%;text-align:center;padding-left:10px;padding-right:10px;"><i class="fa fa-cog fa-spin"></i></th>
						<th style="width:17.5%;text-align:center;">Charge to</th>
						<th style="width:17.5%;text-align:center;">Attention</th>
						<th style="width:17.5%;text-align:center;">CC</th>
						<th style="width:15%;text-align:center;">Date</th>
						<th style="width:15%;text-align:center;">Control No.</th>	
						<th style="width:15%;text-align:center;">Debit/Credit No.</th>								
					</tr>
				</thead>
				<tbody class="pointer" style="font-size:90%;">
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_create_pmi">
  <div class="modal-dialog" style="width:98%;margin-top:.8%;">
  	<form method="post" id="frm_create_pmi">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;&nbsp; Create PMI Charging Report</h4>
      </div>
      <div class="modal-body" style="overflow-y:scroll;height:73%;">
        <div style="border:none;text-align:center;font-weight:bold;font-size:120%;" class="col-md-12">
        	PMI CHARGING REPORT FOR F3
        	<hr class="style7">
        </div>
		 <div class="form-group">
	    	  <div class="col-md-12" style="text-align:center;padding-bottom:1.5%;">
	    	  	<div class="col-md-6" style="margin-right:0;padding:0;">
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-top-left-radius: 1em;border-bottom-left-radius: 1em;">
				    	<label>
							<input type="radio" class="pointer" name="pcr_dept" value="1">
						</label> TS
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_dept" value="2">
						</label> CN
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_dept" value="3">
						</label> YF
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_dept" value="4">
						</label> PPD
				  	</div>
				</div>
				<div class="col-md-3" style="margin-left:0;padding:0;">
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-right:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_type_mh_mp" value="1" checked>
						</label> Man-hour
				  	</div>
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-left:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_type_mh_mp" value="2">
						</label> Material
				  	</div>
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-left:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_type_mh_mp" value="3">
						</label> Others
				  	</div>
				</div>
				<div class="col-md-3" style="padding:0;">
		    	  	<div class="col-md-6" style="border:1px solid #D3D3D3;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="pcr_where" value="1">
						</label> Local
				  	</div>
		    	  	<div class="col-md-6" style="border:1px solid #D3D3D3;border-left:0;border-top-right-radius: 1em;border-bottom-right-radius: 1em;">
						<label>
							<input type="radio" class="pointer" name="pcr_where" value="2" checked>
						</label> Foreign
				  	</div>
				</div>
			  </div>
		 </div>
		 <div class="form-group">
		  	<div class="col-md-3">
		  		<label>Charge To</label>
		  		<span class="required"></span>
		  	</div>
		  	<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<select class="form-control" name="txt_chargeto" placeholder="Charge to" autocomplete="OFF">
					<option value="ASIA YAMAICHI ELECTRONICS INC.">ASIA YAMAICHI ELECTRONICS INC.</option>		   
					<option value="CN-YF">CN-YF</option>
					<option value="PPD">PPD</option>
					<option value="Service Resources Inc.">Service Resources Inc.</option>
					<option value="SIIX EMS">SIIX EMS</option>
					<option value="SIIX LOGISTICS PHILIPPINES">SIIX LOGISTICS PHILIPPINES</option>
					<option value="TOKAI PRECISION PHILIPPINES, INC.">TOKAI PRECISION PHILIPPINES, INC.</option>
					<option value="TS Manufacturing">TS Manufacturing</option>
					<option value="TS MFG.">TS MFG.</option>
					<option value="YEC OKAYAMA">YEC OKAYAMA</option>
					<option value="YEC SAKURA">YEC SAKURA</option>
					<option value="YEC TOKYO">YEC TOKYO</option>
					<option value="YEU">YEU</option>
					<option value="YF ASSY">YF ASSY</option>
					<option value="YAMAICHI SEIKO PHILIPPINES INC.">YAMAICHI SEIKO PHILIPPINES INC.</option>
					<option value="ENOMOTO PHILIPPINES MANUFACTURING, INC.">ENOMOTO PHILIPPINES MANUFACTURING, INC.</option>
					<option value="SANNO PHILIPPINES MANUFACTURING CORP.">SANNO PHILIPPINES MANUFACTURING CORP.</option>
					<option value="YEC Head Office">YEC Head Office</option>
					<option value="TSS">TSS</option>
					<option value="YAMAICHI ELECTRONICS SINGAPORE PTE LTD.">YAMAICHI ELECTRONICS SINGAPORE PTE LTD.</option>
					<option value="YAMAICHI ELECTRONICS CO. LTD. HONGKONG">YAMAICHI ELECTRONICS CO. LTD. HONGKONG</option>
				</select>
			</div>
      	 </div>
		 <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">In-Charge Section</label>
				<span class="required"></span>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="txt_incharge_section" placeholder="In-charge Section">
			</div>
		 </div>
      	 <div class="form-group">
		  	<div class="col-md-3">
		  		<label>From</label>
		  	</div>
		  	<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input list="devices" class="form-control xover" readonly="true" name="txt_from" value="PPC">
			</div>
      	 </div>
		  <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">Attention</label>
				<span class="required"></span>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input list="maintenance" class="form-control" name="txt_attention" placeholder="Attention">
				<datalist class="txt_maintenance" id="maintenance">			   
				</datalist>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Date</label>
				<span class="required"></span>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" id="input_date" class="form-control" name="txt_date" placeholder="Date" autocomplete="OFF">
			</div>
		  </div>
		  <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">CC</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="txt_cc" placeholder="CC">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Copy For</label>
				<span class="required"></span>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" readonly="true" class="form-control xover" name="txt_copyfor" value="PMI-ACCTNG" autocomplete="OFF">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Control No.</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="txt_controlno" placeholder="Control No." autocomplete="OFF" readonly>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<select style="height:6%;width:127px;padding:0px;" class="form-control" name="txt_debitorcredit"><option value="1">Debit Note No.</option><option value="2">Credit Note No.</option></select>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="txt_debitorcreditnoteno" placeholder="Debit/Credit Note no." autocomplete="OFF">
			</div>
		  </div>
		  <div id="create_modal_table">
			  <div class="col-md-12" style="text-align:center;">
			  	<hr class="style7">
			  	<input type="hidden" name="txt_max_row" id="input_max_row" value="1">
			  	<div class="col-md-1">
			  		Reference
			  	</div>
			  	<div class="col-md-1">
			  		Mat./Product Code
			  	</div>
			  	<div class="col-md-1">
			  		Mat./Product Name
			  	</div>
			  	<div class="col-md-1">
			  		Details
			  	</div>
			  	<div class="col-md-1">
			  		Qty.
			  	</div>
			  	<div class="col-md-1">
			  		Unit Price
			  	</div> 
			  	<div class="col-md-1">
			  		Amount
			  	</div>
			  	<div class="col-md-1">
			  		Type
			  	</div>
			  	<div class="col-md-1">
			  		Category
			  	</div>
			  	<div class="col-md-1">
			  		Detail of indication
			  	</div>
			  	<div class="col-md-1">
			  		Supplier Name
			  	</div>
			  	<!-- <div class="col-md-1">
			  		<i class="fa fa-gear fa-spin" style="margin-top:8%;"></i>
			  	</div> -->
			  </div>

			  <div class="col-md-12" style="text-align:center;">
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" placeholder="Reference" name="txt_reference_1">
			  	</div>
			  	<div class="form-group">
				  	<div class="col-md-1">
				  		<!-- <input class="form-control" list="material_code_list" type="text" placeholder="Mat./Product Code" id="txt_itemcode" name="txt_itemcode"> -->
				  		<!-- <input class="form-control itemcode" list="mcl" type="text" placeholder="Mat./ Product Code" id="txt_itemcode_1" name="txt_itemcode_1" autocomplete="off"> -->
				  		<input class="form-control itemcode" list="mcl" type="text" placeholder="Mat./ Product Code" id="txt_itemcode_1" name="txt_itemcode_1" autocomplete="off">
				  		<datalist id="mcl"></datalist>
						<!-- <select id="mcl"></select> -->
				       	<!-- <div class="form-group">
							<input type="text" class="form-control form-control-sm" id="txt_itemcode_1" name="txt_itemcode_1" list="mcl" placeholder="Mat./Product Code" required>
							<datalist id="mcl"></datalist>
						</div> -->



				  	</div>
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" placeholder="Mat./Product Name" id="txt_itemname_1" name="txt_itemname_1" >
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" placeholder="Details" id="txt_detail_1" name="txt_detail_1">
			  	</div>

			  	<div class="col-md-1">
			  		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="Quantity" name="txt_qty_1">
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.0000" id="txt_unitprice_1" name="txt_unitprice_1" >
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control decimal" type="text" style="text-align:right;" placeholder="0.00" name="txt_amount_1">
			  	</div>
			  	<div class="col-md-1">
			  		<select class="form-control" name="txt_item_type_1">
			  			<option selected disabled>--Select One--</option>
			  			<option value="1">Manpower</option>
			  			<option value="2">Machine Tools</option>
			  			<option value="3">Materials</option>
			  			<option value="4">Other Charges</option>
			  		</select>
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" style="text-align:left;" placeholder="Category" name="txt_category_1">
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" style="text-align:left;" placeholder="Detail of indication" name="txt_indicator_1">
			  	</div>
			  	<div class="col-md-1">
			  		<input class="form-control" type="text" style="text-align:left;" placeholder="Category" name="txt_supplier_1">
			  	</div>
			  	<!-- <div class="col-md-1">
			  	</div> -->
			  </div>
		  </div>

		  <div class="col-md-12" style="margin-top:2%;">
	  		<div style="margin-left:1.5%;">
	  			<a class="pointer" id="a_add_row"><i class="fa fa-plus"></i> Add Row</a>	
	  		</div>
	  		<hr class="style7">
		  </div>

		  <div class="col-md-12" style="text-align:center;">
	  		<hr class="style7">
		  	<div class="col-md-3">
		  		<span style="font-weight:bold;">Prepared by:</span><br>
		  		<p id="c_span_prepared_by" style="margin-bottom:0%;font-weight:bold;" class="span_prepared_by"></p>
		  		PPC Clerk
		  	</div>
		  	<div class="col-md-3">
		  		<span style="font-weight:bold;">Checked by:</span><br>
		  		<!-- <select class="form-control select_checked" type="text" name="txt_checkedby"> -->
		  		<!-- </select> -->
		  		<!-- <p id="c_span_checked_by" style="margin-bottom:0%;font-weight:bold;" class="span_checked_by"></p> -->
		  		<!-- PPC General Manager. -->
		  		<select class="form-control select_checker" type="text" name="txt_checkedby" required>
		  		</select>
		  	</div>
		  	<div class="col-md-3">
		  		<span style="font-weight:bold;">Approved by:</span><br>
		  		<select class="form-control select_approver" type="text" name="txt_approvedby" required>
		  		</select>
		  	</div>	
		  	<div class="col-md-3">
		  		<span style="font-weight:bold;">Noted by:</span><br>
		  		<select class="form-control select_notedby" type="text" name="txt_notedby" required>
		  			
		  		</select>
			  	</div>			  	
		  </div>
      </div>
      <div class="modal-footer">
      	<!-- <button id="submit_printandcreate_pmi" type="button" class="btn btn-warning"><i class="fa fa-print"></i> Save & Print</button> --> <!-- 11192024 by Nessa -->
        <button type="button" class="btn btn-success submit_create_pmi"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal fade" id="modal_update_pmi">
  <div class="modal-dialog" style="width:98%;margin-top:.8%;">
  	<form method="post" id="frm_update_pmi">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp&nbspUpdate PMI Charging Report</h4>
      </div>
      <div class="modal-body" style="overflow-y:scroll;height:73%;">
        <div style="border:none;text-align:center;font-weight:bold;font-size:120%;" class="col-md-12">
        	PMI CHARGING REPORT
        	<hr class="style7">
        </div>
         <div class="form-group">
         	  <div class="col-md-12" style="text-align:center;padding-bottom:1.5%;">
	    	  	<div class="col-md-6" style="margin-right:0;padding:0;">
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-top-left-radius: 1em;border-bottom-left-radius: 1em;">
				    	<label>
							<input type="radio" class="pointer" name="u_pcr_dept" value="1" id="rdo_pcr_ts">
						</label> TS
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_dept" value="2" id="rdo_pcr_cn">
						</label> CN
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;" id="rdo_pcr_yf">
						<label>
							<input type="radio" class="pointer" name="u_pcr_dept" value="3" id="rdo_pcr_yf">
						</label> YF
				  	</div>
		    	  	<div class="col-md-3" style="border:1px solid #D3D3D3;border-right:0;border-left:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_dept" value="4" id="rdo_pcr_pps">
						</label> PPD
				  	</div>
				</div>
				<div class="col-md-3" style="margin-left:0;padding:0;">
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-right:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_type_mh_mp" value="1" id="rdo_pcr_type_mh">
						</label> Man-hour
				  	</div>
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-left:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_type_mh_mp" value="2" id="rdo_pcr_type_mp">
						</label> Material
				  	</div>
		    	  	<div class="col-md-4" style="border:1px solid #D3D3D3;border-left:0;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_type_mh_mp" value="3" id="rdo_pcr_type_others">
						</label> Others
				  	</div>
				</div>
				<div class="col-md-3" style="margin-left:0;padding:0;">
		    	  	<div class="col-md-6" style="border:1px solid #D3D3D3;border-right:0;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_where" value="1" id="rdo_pcr_local">
						</label> Local
				  	</div>
		    	  	<div class="col-md-6" style="border:1px solid #D3D3D3;border-left:0;border-top-right-radius: 1em;border-bottom-right-radius: 1em;">
						<label>
							<input type="radio" class="pointer" name="u_pcr_where" value="2" id="rdo_pcr_foreign">
						</label> Foreign
				  	</div>
				</div>
			  </div>
		  </div>
		  <div class="form-group">
		  	<div class="col-md-3">
		  		<label>Charge To</label>
		  		<span class="required"></span>
		  	</div>
		  	<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="u_txt_chargeto" placeholder="Charge to" autocomplete="OFF">
			</div>
      	 </div>
		 <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">In-Charge Section</label>
				<span class="required"></span>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="u_txt_incharge_section" placeholder="In-charge Section">
			</div>
		 </div>
      	 <div class="form-group">
		  	<div class="col-md-3">
		  		<label>From</label>
		  	</div>
		  	<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input list="devices" class="form-control xover" readonly="true" name="u_txt_from" value="PPC">
			</div>
      	 </div>
		  <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">Attention</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input list="maintenance" class="form-control" name="u_txt_attention" placeholder="Attention">
				<datalist class="txt_maintenance" id="maintenance">			   
				</datalist>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Date</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" id="u_input_date" class="form-control" name="u_txt_date" placeholder="Date" autocomplete="OFF">
			</div>
		  </div>
		  <div class="form-group">
		  	<div class="col-md-3">
				<label for="txt_maintenance">CC</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="u_txt_cc" placeholder="CC">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Copy For</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" readonly="true" class="form-control xover" name="u_txt_copyfor" value="PMI-ACCTNG" autocomplete="OFF">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<label for="txt_cavty">Control No.</label>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="u_txt_controlno" placeholder="Control No." autocomplete="OFF" readonly>
				<input type="hidden" name="u_hidden_txt_controlno">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-3">
				<select style="height:6%;width:127px;padding:0px;" class="form-control" name="u_txt_debitorcredit"></select>
			</div>
			<div class="col-md-1">
		  		<label class="pull-right">:</label>
		  	</div>
			<div class="col-md-8" style="margin-bottom:.5%;">
				<input type="text" class="form-control" name="u_txt_debitorcreditnoteno" placeholder="Debit/Credit Note no." autocomplete="OFF">
			</div>
		  </div>
		  <div id="update_modal_table">
			  <div class="col-md-12" style="text-align:center;">
			  	<hr class="style7">
			  	<input type="hidden" name="u_txt_max_row" value="1">
			  	<input type="hidden" name="additional_row" value="0">
			  	<div class="col-md-1">
			  		Reference
			  	</div>
			  	<div class="col-md-1">
			  		Mat./ Product Code
			  	</div>
			  	<div class="col-md-1">
			  		Mat./ Product Name
			  	</div>
			  	<div class="col-md-1">
			  		Details
			  	</div>
			  	<div class="col-md-1">
			  		Qty.
			  	</div>
			  	<div class="col-md-1">
			  		Unit Price
			  	</div> 
			  	<div class="col-md-1">
			  		Amount
			  	</div>
			  	<div class="col-md-1">
			  		Type
			  	</div>
			  	<div class="col-md-1">
			  		Category
			  	</div>
			  	<div class="col-md-1">
			  		Detail of indication
			  	</div>
			  	<div class="col-md-1">
			  		Supplier Name
			  	</div>

			  	<!-- <div class="col-md-1">
			  		<i class="fa fa-gear fa-spin" style="margin-top:8%;"></i>
			  	</div> -->
			  </div>
			  <div id="content_loop"></div>
			  <div class="col-md-12" style="margin-top:2%;">
		  		<div style="margin-left:1.5%;">
		  			<a class="pointer" id="u_a_add_row"><i class="fa fa-plus"></i> Add Row</a>	
		  		</div>
		  		<hr class="style7">
			  </div>
		  </div>
		  <div class="col-md-12" style="text-align:center;">
		  		<hr class="style7">
			  	<div class="col-md-3">
			  		<span style="font-weight:bold;">Prepared by:</span><br>
			  		<p id="u_span_prepared_by" style="font-weight:bold;margin-bottom:0%;" class="span_prepared_by"></p>
			  		PPC Clerk
			  	</div>
			  	<div class="col-md-3">
			  		<span style="font-weight:bold;">Checked by:</span><br>
			  		<!-- <p id="u_span_checked_by" style="font-weight:bold;margin-bottom:0%;" class="span_checked_by"></p>
			  		PPC General Manager -->
			  			<select id="checked_by" class="form-control" name="u_txt_checkedby">
			  			</select>
			  	</div>
			  	<div class="col-md-3">
			  		<span style="font-weight:bold;">Approved by:</span><br>
				  		<select id="approved_by" class="form-control" name="u_txt_approvedby">
			  			</select>
			  	</div>
			  	<div class="col-md-3">
			  		<span style="font-weight:bold;">Noted by:</span><br>
			  			<select id="noted_by" class="form-control" name="u_txt_notedby">
			  			</select>
			  	</div>			  	
		  </div>	
      </div>
      <div class="modal-footer">
      	<a id="a_pmicr_print" style="margin-right:.7%;"><button type="button" class="btn btn-warning"><i class="fa fa-print"></i> Print</button></a>
        <button type="button" class="btn btn-success submit_update_pmi"><i class="fa fa-save"></i> Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div><!-- /.modal-content -->
    </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div class="modal fade" id="modal_confirm_remove_existingrow">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_remove_existingrow">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body" id="modal_body_content">
      	<input type="hidden" name="hdn_pmicrc_id">      	
      	Are you sure you want to delete this?
      </div>
      <div class="modal-footer">        
        <button class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_confirm_create_pmi">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_create_pmi">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body">      	
      	Are you sure you want to save this PMI Charging Report?
      </div>
      <div class="modal-footer">        
        <button id="submit_create_pmi_yes" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_confirm_printandcreate_pmi">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_printandcreate_pmi">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body">      	
      	Are you sure you want to save and print this PMI Charging Report?
      </div>
      <div class="modal-footer">        
        <button type="submit" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_confirm_update_pmi">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_confirm_update_pmi">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body">      	
      	Are you sure you want to update this PMI Charging Report?
      </div>
      <div class="modal-footer">        
        <button id="submit_update_pmi_yes" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="mdl_add_ons">
  <div class="modal-dialog" style="width:40%;margin-top:5%;">
  	<form method="post" id="frm_add_ons">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-print"></i>&nbsp;&nbsp;Print Add-ons
      </div>
      <div class="modal-body">
      	  <label for="txt_add_control_no">Control Number (Add Text):</label>      	
      	  <div class="input-group">			
			<input type="text" class="form-control" name="txt_add_control_no" placeholder="Control Number (Add Text)" disabled>
			<span class="input-group-btn"><button class="btn btn-default grow" id="btn_edit_add_ons_a" type="button" title="Edit">&nbsp;<i style="color:black;" class="fa fa-edit"></i>&nbsp;</button></span>
		  </div>
		  <label for="txt_add_control_no">Machine Tools or Equipment (Add Text):</label>    	
      	  <div class="input-group">			
			<input type="text" class="form-control" name="txt_add_machine_tools" placeholder="Machine Tools or Equipment (Add Text)" disabled>
			<span class="input-group-btn"><button class="btn btn-default grow" id="btn_edit_add_ons_b" type="button" title="Edit">&nbsp;<i style="color:black;" class="fa fa-edit"></i>&nbsp;</button></span>
		  </div>
		  <label for="txt_add_control_no">Materials (Add Text):</label>   	
      	  <div class="input-group">			
			<input type="text" class="form-control" name="txt_add_materials" placeholder="Materials (Add Text)" disabled>
			<span class="input-group-btn"><button class="btn btn-default grow" id="btn_edit_add_ons_c" type="button" title="Edit">&nbsp;<i style="color:black;" class="fa fa-edit"></i>&nbsp;</button></span>
		  </div> 
		  <label for="txt_add_control_no">Other Charges (Add Text):</label>   	
      	  <div class="input-group">			
			<input type="text" class="form-control" name="txt_add_other_charges" placeholder="Other Charges (Add Text)" disabled>
			<span class="input-group-btn"><button class="btn btn-default grow" id="btn_edit_add_ons_d" type="button" title="Edit">&nbsp;<i style="color:black;" class="fa fa-edit"></i>&nbsp;</button></span>
		  </div>
		  <input type="hidden" name="hdn_user_emp_id">
      </div>
      <div class="modal-footer">        
        <button id="submit_add_ons" class="btn btn-success"><i class="fa fa-check"></i>&nbsp;Proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<script src="./js/pmicr.fn.js?n=657" language="javascript"></script>
<script type="text/javascript">
	fn_num_with_dot();
	load_signatories_select();
	load_control_number();
	fn_get_amount();
	fn_get_total_charges();
	fn_add_remove_row();
	fn_remove_disable_addons();
	$('#input_date').datepicker({
	    format: 'mm/dd/yyyy',
	    changeMonth: true, 
		changeYear: true
	});
	$('#u_input_date').datepicker({
	    format: 'mm/dd/yyyy',
	    changeMonth: true, 
		changeYear: true
	});
	$("#input_date").datepicker("setDate", new Date());
</script>