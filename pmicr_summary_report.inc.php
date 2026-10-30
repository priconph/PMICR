<div class="col-md-12">
	<div class="col-md-12" style="margin-top:1.5%;width:30%;">
		<div class="input-group" class="pull-left">
	      <input type="text" class="form-control" placeholder="Search Date Range..." id="input_search_date_range">
	      <span class="input-group-btn">
	        <button class="btn btn-default grow" id="btn_search_export" type="button" title="search">&nbsp;<i style="color:black;" class="fa fa-search"></i>&nbsp;</button>
	      </span>
	      <button id="btn_export_summaryreport" style="margin-left:13%;" class="btn btn-danger btn-md pull-left grow"><i class="fa fa-file-excel-o"></i> Export</button>	
	    </div>
	</div>
	<div class="col-md-12" style="margin-top:1.5%;font-family:Segoe UI;">
   		<div class="box box-primary" style="background-color:#eff3f9;padding:3%;height:78%;padding-top:2%;">
			<table id="t_summary_report" class="display table-bordered stripe compact cell-border table-hover" style="border-color:#ccd4e2;border-radius:7px;font-size:14px;">
				<thead>
					<tr style="height:50px;font-size:11px;">	
						<th style="text-align:center;"><i class="fa fa-hashtag"></i></th>
						<th style="text-align:center;">Department</th>
						<th style="text-align:center;white-space:nowrap;">Control Number</th>
						<th style="text-align:center;">Issued Date</th>
						<th style="text-align:center;"><span style="white-space:nowrap;">In-Charge</span> Section</th>
						<th style="text-align:center;white-space:nowrap;">Material/ Product Code</th>
						<th style="text-align:center;white-space:nowrap;">Material/ Product Name</th>
						<th style="text-align:center;min-width:100px;">Detail</th>
						<th style="text-align:center;white-space:nowrap;">Billing Summary</th>	
						<th style="text-align:center;background-color:#074fc1;color:#fcfcfc;">Material Unit Price</th>
						<th style="text-align:center;background-color:#074fc1;color:#fcfcfc;">Material Qty.</th>
						<th style="text-align:center;background-color:#074fc1;color:#fcfcfc;">Total Amount</th>		
						<th style="text-align:center;background-color:#13a529;color:#fcfcfc;">Sorting Qty.</th>
						<th style="text-align:center;background-color:#13a529;color:#fcfcfc;">Tact Time</th>		
						<th style="text-align:center;background-color:#13a529;color:#fcfcfc;">Cost/ Mins.</th>		
						<th style="text-align:center;background-color:#13a529;color:#fcfcfc;">Total Amount</th>		
						<th style="text-align:center;background-color:#ff9d00;color:black;">Transport Total Amnt.</th>
						<th style="text-align:center;background-color:#fffa00;color:black;"><span style="white-space:nowrap;">Total Amnt.</span> (Transport Included)</th>
						<th style="text-align:center;">Detail of Indication</th>
						<th style="text-align:center;">Supplier Name</th>	
						<th style="text-align:center;">YEC Billing Request</th>
						<th style="text-align:center;">Category</th>	
						<th style="text-align:center;">Date Encoded</th>			
					</tr>
				</thead>
				<tbody style="font-size:13px;"> 
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_choose_dept_export">
  <div class="modal-dialog" style="width:30%;margin-top:12%;">
  	<form method="post" id="frm_choose_dept_export" target="_blank" action="./export/excel.export.php">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export to Excel</h4>
      </div>
      <div class="modal-body">
      	<span style="font-size:16px;" class="text-muted"><strong>Section/s to be included:</strong></span>
      	<br><br>
		  <input type="hidden" name="hdn_date_range_export">

		  <!-- START - CHAN 01-30-2025 -->
			<div class="row" style="margin-left:20px;">
				<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_pm_export" value="1"> PMICR
					</label>
				</div>
				<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_ts_export" value="1"> TS
					</label>
				</div>
				<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_cn_export" value="1"> CN
					</label>
				</div>
			</div>

			<div class="row" style="margin-left:20px;">
			<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_yf_export" value="1"> YF
					</label>
				</div>

				<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_ppd_ts_export" value="1"> PPD-TS
					</label>
				</div>
				<div class="col-md-4">
					<label>
						<input type="checkbox" class="form-check-input pointer" name="chk_ppd_cn_export" value="1"> PPD-CN
					</label>
				</div>
			</div> <!-- END - CHAN 01-30-2025 -->

			<!-- OLD CODE -->
			<!-- <label class="pointer">
				<input type="checkbox" class="pointer" name="chk_pm_export" value="1">
			</label class="form-check-label pointer">PMICR&nbsp;&nbsp;&nbsp;&nbsp;

	    	<label class="pointer">
				<input type="checkbox" class="pointer" name="chk_ts_export" value="1">
			</label class="form-check-label pointer">TS&nbsp;&nbsp;&nbsp;&nbsp;

			<label class="pointer">
				<input type="checkbox" class="pointer" name="chk_cn_export" value="1">
			</label class="form-check-label pointer">CN&nbsp;&nbsp;&nbsp;&nbsp;

			<label class="pointer">
				<input type="checkbox" class="pointer" name="chk_yf_export" value="1">
			</label class="form-check-label pointer">YF&nbsp;&nbsp;&nbsp;&nbsp; -->

			<!-- <label class="pointer">
				<input type="checkbox" class="pointer" name="chk_pps_export" value="1">
			</label class="pointer">PPD -->
		<!-- </div> -->
      </div>
      <div class="modal-footer">        
        <button id="choose_dept_export_yes" type="button" class="btn btn-success"><i class="fa fa-download"></i>&nbsp;Export</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Close</button>	
      </div>
    </div>
    </form>
  </div>
</div>
<script type="text/javascript" src="./js/pmicr.fn.js?n=1"></script>
<script type="text/javascript">
	fn_search_export();
	date_time_picker('input_search_date_range');
</script>