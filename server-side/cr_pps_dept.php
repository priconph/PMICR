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

	
	$array_where = array();
	
	$aColumns = array( 	't_pmi_cr_dept.pcrd_id',
						't_pmi_cr_dept.pcrd_control_no',
						't_pmi_cr_dept.pcrd_to',
						't_pmi_cr_dept.pcrd_attention',
						't_pmi_cr_dept.pcrd_cc',
						't_pmi_cr_dept.pcrd_issued_date',
						't_pmi_cr_dept.pcrd_approved_by1',
						't_pmi_cr_dept.pcrd_approved_by2',
						't_pmi_cr_dept.pcrd_noted_by2',
						't_pmi_cr_dept.pcrd_noted_by1',
						't_pmi_cr_dept.pcrd_prepared_by',
						't_pmi_cr_dept.pcrd_department'
						);
	
	$array_where[] .= ' (pcrd_department="pps" or pcrd_department="ppd-ts") AND logdel=0 ORDER BY pcrd_id DESC';
	/* used this field for searching data typed in the search box */
	// $array_search = array('empno', 'LastName',
							// 'date', 'date_out');
	// $array_search = array('empno', 'LastName');
							
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "pcrd_id";
	
	/* DB table to use */
	$sTable = "t_pmi_cr_dept";
	
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
	$i=1;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{

		$row = array();
		unset($row);

		$row[] = '<input type="hidden" value="'.$aRow['pcrd_id'].'">'.$i;
		$row[] = date("M d, Y", strtotime($aRow['pcrd_issued_date']));
		$row[] = $aRow['pcrd_control_no'];
		$row[] = $aRow['pcrd_to'];
		$row[] = $aRow['pcrd_attention'];
		$row[] = $aRow['pcrd_cc'];
		if($aRow['pcrd_approved_by2']==''){
			$row[] = $aRow['pcrd_approved_by1'];			
		}
		else{
			$row[] = $aRow['pcrd_approved_by1'].'/ '.$aRow['pcrd_approved_by2'];			
		}
		$row[] = $aRow['pcrd_noted_by1'];
		$row[] = $aRow['pcrd_prepared_by'];

		$i++;
		array_push($output['aaData'],$row);
	}
	echo json_encode( $output );
?>