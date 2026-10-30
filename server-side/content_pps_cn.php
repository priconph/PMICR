<?php
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	$control_no = $_GET['control_no'];
	$array_where = array();
	
	$aColumns = array( 	't_pmi_cr_dept_content.pcrdc_id',
						't_pmi_cr_dept_content.pcrdc_control_no',
						't_pmi_cr_dept_content.pcrdc_incharge_section',
						't_pmi_cr_dept_content.pcrdc_detail',
						't_pmi_cr_dept_content.pcrdc_material_product_code',
						't_pmi_cr_dept_content.pcrdc_material_product_name',
						't_pmi_cr_dept_content.pcrdc_billing_summary',
						't_pmi_cr_dept_content.pcrdc_sorting_qty',
						't_pmi_cr_dept_content.pcrdc_tact_time',
						't_pmi_cr_dept_content.pcrdc_cost_mins',
						't_pmi_cr_dept_content.pcrdc_total_amnt_mp',
						't_pmi_cr_dept_content.pcrdc_details_of_indication',
						't_pmi_cr_dept_content.pcrdc_supplier_name',
						't_pmi_cr_dept_content.pcrdc_mt_unit_price',
						't_pmi_cr_dept_content.pcrdc_mt_qty',
						't_pmi_cr_dept_content.pcrdc_total_amount_mt',
						't_pmi_cr_dept_content.pcrdc_department',
						't_pmi_cr_dept_content.pcrdc_adate',
						't_pmi_cr_dept_content.pcrdc_yec_billing',
						't_pmi_cr_dept_content.pcrdc_category',
						't_pmi_cr_dept_content.pcrdc_transport_total_amnt',
						't_pmi_cr_dept_content.pcrdc_total_amount',
						't_pmi_cr_dept_content.pcrdc_type'
						);												
	$array_where[] .= ' pcrdc_department="ppd-cn" AND pcrdc_control_no="'.$control_no.'" AND logdel=0';
	/* used this field for searching data typed in the search box */
	// $array_search = array('empno', 'LastName',
							// 'date', 'date_out');
	// $array_search = array('empno', 'LastName');
							
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "pcrdc_id";
	
	/* DB table to use */
	$sTable = "t_pmi_cr_dept_content";
	
	/* Database connection information */
	require_once('connect.sside.php'); 
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
		
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	 
	 /* wag gagalawin yung sWhere default to para sa searchbox ng datatables check mo sa baba kung pano gagawin mo :) */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			// if( in_array($aColumns[$i],$array_search) ){
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			// }
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	/* 
		dito ka mag add ng where mo, una check mo kung may laman na yung $sWhere pag wala append mo yung where mo na meron
		kasama where kapag naman may laman na AND na syempre diba :)
	*/
	
	if( count($array_where) !=0 ){
		if($sWhere == ""){
			$sWhere .= "WHERE  ";
		}else{
			$sWhere .= "AND ";
		}
		$sWhere .= implode(' AND ',$array_where);
	}
	


	// $date_start = $_GET['date_start'];
	// $date_end 	= $_GET['date_end'];
	
	// $sWhere .= "((date BETWEEN '" . $date_start . "' AND '" . $date_end . "') OR (date_out BETWEEN '" . $date_start . "' AND '" . $date_end . "')) AND `empno` LIKE '%".$empno."%'";
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	// echo $sQuery;
	// echo "limit: ".$sLimit." : ".$sQuery."<hr>";
	$query_used = $sQuery;
	// echo $query_used;
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	$l = 1;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		unset($row);
		if($aRow['pcrdc_type']=='2'){$aRow['pcrdc_cost_mins']='';}
		
		$row[] = '<input type="hidden" value="'.$aRow['pcrdc_id'].'">'.$l;
		$row[] = $aRow['pcrdc_incharge_section'];
		$row[] = $aRow['pcrdc_material_product_code'];
		$row[] = $aRow['pcrdc_material_product_name'];
		$row[] = $aRow['pcrdc_detail'];
		$row[] = $aRow['pcrdc_billing_summary'];
		$row[] = number_format($aRow['pcrdc_mt_unit_price'],4,'.',',');
		$row[] = number_format($aRow['pcrdc_mt_qty']);
		$row[] = number_format($aRow['pcrdc_total_amount_mt'],2,'.',',');
		$row[] = number_format($aRow['pcrdc_sorting_qty']);
		$row[] = number_format($aRow['pcrdc_tact_time'],2,'.',',');
		$row[] = number_format($aRow['pcrdc_cost_mins'],4,'.',',');
		$row[] = number_format($aRow['pcrdc_total_amnt_mp'],2,'.',',');
		$row[] = number_format($aRow['pcrdc_transport_total_amnt'],2,'.',',');
		$row[] = number_format($aRow['pcrdc_total_amount'],2,'.',',');
		$row[] = $aRow['pcrdc_details_of_indication'];
		$row[] = $aRow['pcrdc_supplier_name'];
		$row[] = $aRow['pcrdc_yec_billing'];
		$row[] = $aRow['pcrdc_category'];
		$l++;
		array_push($output['aaData'],$row);
	}
	echo json_encode( $output );
?>