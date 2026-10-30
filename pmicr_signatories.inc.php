<div class="col-md-12">
	<div class="col-md-12" style="margin-top:1.5%;">
		<div class="box" style="border-top:none;">
			<button class="btn btn-success btn-md pull-left grow" style="margin-right:1%;" id="btn_add_signatory" data-toggle="modal"  data-target="#UpdateModal" ><i class="fa fa-plus" ></i> Add Signatory</button>
		</div>
	</div><br><br>
	<div class="col-md-12" style="margin-top:1.5%;">
    <div class="box box-primary" style="background-color:#eff3f9;padding:3%;height:78%;padding-top:2%;">
			<table id="t_signatories" class="display table-bordered table-hover" style="border-color:#ccd4e2;border-radius:7px;">
				<thead>
					<tr>
					<th style="width:10%;text-align:center">Employee Name</th>
          <th style="width:13%;text-align:center">Position</th>          
					<th style="width:7%;text-align:center;background-color:#6FB6B0;">PMICR Approver</th>
					<th style="width:7%;text-align:center;background-color:#6FB6B0;">PMICR Checker</th>
          <th style="width:7%;text-align:center;background-color:#6FB6B0;">PMICR Noter</th>
					<th style="width:10%;text-align:center;background-color:#9AB161;">TS, CN, YF, & PPD Approver</th>
					<th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">TS Noter</th>
          <th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">CN Noter</th>
          <th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">YF Noter</th>
          <!-- <th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">PPD Noter</th> --> <!-- CHAN - 01-28-2025 -->
          <th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">PPD-TS Noter</th> <!-- CHAN - 02-01-2025 -->
          <th style="width:7%;text-align:center;background-color:#0D1B40;color:#fcfcfc;">PPD-CN Noter</th> <!-- CHAN - 02-01-2025 -->
					</tr>
				</thead>
				<tbody class="pointer">
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_add_signatory">
  <div class="modal-dialog" style="width:30%;margin-top:4%;">
  	<form method="post" id="frm_add_signatory">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Signatory</h4>
      </div>
      <div class="modal-body">        
        <div class="form-group">
    			<label for="txt_emp_no">Employee Number:</label><div class="input_required pull-right"></div>
    			<input type="text" class="form-control" name="txt_emp_no" placeholder="Employee Number">
  		  </div>
  		  <div class="form-group">
    		  <label for="txt_emp_no">Employee Name: </label><small class="pull-right"><i>*Note: You can add `Ms.` or `Mr`</i></small>
    			<input class="form-control" name="txt_emp_name" id="input_emp_name" placeholder="Employee Name">
  		  </div>
        <div class="form-group">
          <label for="txt_emp_no">Title/ Position:</label>
          <input class="form-control" name="txt_emp_title" placeholder="Employee Title or Position">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="submit_add_signatory" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>		
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_confirm_add_signatory">
  <div class="modal-dialog" style="width:30%;margin-top:15%;">
  	<form method="post" action="operator_index.php?page=operator.device.php" id="frm_confirm_add_signatory">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body">
      	Are you sure you want to add signatory?
      </div>
      <div class="modal-footer">        
        <button id="submit_add_signatory_yes" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_edit_role">
  <div class="modal-dialog" style="width:30%;margin-top:4%;">
  	<form method="post" id="frm_edit_role">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit Role</h4>
      </div>
      <div class="modal-body" style="height:45%;overflow-y:scroll;">
      	<input type="hidden" id="input_ur_id" name="txt_ur_id">
        <input type="hidden" name="hdn_status_of_pmicrapprover">
        <input type="hidden" name="hdn_status_of_pmicrchecker">
        <input type="hidden" name="hdn_status_of_signatories1">
        <input type="hidden" name="hdn_status_of_signatories2">   
        <p id="paragraph_dept" style="position:absolute;" hidden>all</p>
  	    <div class="form-group">
  		    <input style="text-align:center;font-weight:bold;font-size:120%;margin-bottom:1%;" class="form-control" name="u_txt_emp_name" id="input_ur_name" placeholder="Employee Name">
          <input style="text-align:center;font-weight:bold;font-size:120%;" class="form-control" name="u_txt_emp_title" placeholder="Employee Title">  	 
        </div>
  	    <div class="col-md-6">
    	    <div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_pmic_approver" value="1">PMICR Approver</label></div>
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_pmic_checker" value="1">PMICR Checker</label></div>
          <div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_pmic_noter" value="1">PMICR Noter</label></div>
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_cn_approver" value="1">CN Approver</label></div>
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_ts_approver" value="1">TS Approver</label></div>
          <div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_yf_approver" value="1">YF Approver</label></div>
  	    </div>
  	    <!-- <?php if($cbx_pmic_approver=1){echo 'checked';}?> -->
  	    <div class="col-md-6">
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_ts_noter" value="1">TS Noter</label></div>
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_cn_noter" value="1">CN Noter</label></div>
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_yf_noter" value="1">YF Noter</label></div>
    			<!-- <div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_ppd_noter" value="1">PPD</label></div> --> <!-- CHAN - 01-28-2025 -->
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_ppd_ts_noter" value="1">PPD-TS</label></div> <!-- CHAN - 02-01-2025 -->
    			<div class="form-group"><label class="checkbox-inline"><input type="checkbox" name="cbx_ppd_cn_noter" value="1">PPD-CN</label></div> <!-- CHAN - 02-01-2025 -->
  	    </div>
        <br><br><br><br><br><br>
      </div>
      <div class="modal-footer">        
        <button type="button" id="submit_edit_role" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>		
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_confirm_edit_role">
  <div class="modal-dialog" style="width:30%;margin-top:15%;">
  	<form method="post" action="operator_index.php?page=operator.device.php" id="frm_confirm_edit_role">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        System Alert
      </div>
      <div class="modal-body">
      	Are you sure you want to edit signatory's role?
      </div>
      <div class="modal-footer">        
        <button id="submit_edit_role_yes" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		</form>
      </div>
    </div>
  </div>
</div>
<!-- <script src="./js/pmicr.fn.js" language="javascript"></script> -->
<script type="text/javascript" src="./js/pmicr.fn.js?n=345"></script>
<script type="text/javascript">
    fn_signatories_val();
</script>