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
	
	$aColumns = array( 	't_user_role.ur_id',
						't_user_role.ur_eid',
						't_user_role.ur_approver_pmicr',
						't_user_role.ur_checker_pmicr',
						't_user_role.ur_notedby_pmicr',
						't_user_role.ur_approver_ts',
						't_user_role.ur_approver_cn',
						't_user_role.ur_approver_yf',
						't_user_role.ur_notedby_ts',
						't_user_role.ur_notedby_yf',
						't_user_role.ur_notedby_cn',
						// 't_user_role.ur_notedby_pps', // CHAN - 02-01-2025 - OLD
						't_user_role.ur_notedby_ppd_ts', // CHAN - 02-01-2025 - NEW
						't_user_role.ur_notedby_ppd_cn', // CHAN - 02-01-2025 - NEW
						't_user_role.ur_name',
						't_user_role.ur_title'
						);
	
	// $array_where[] .= ' ';
	/* used this field for searching data typed in the search box */
	// $array_search = array('empno', 'LastName',
							// 'date', 'date_out');
	// $array_search = array('empno', 'LastName');
							
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "ur_id";
	
	/* DB table to use */
	$sTable = "t_user_role";
	
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
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		unset($row);
		if($aRow['ur_approver_pmicr']=='1'){$aRow['ur_approver_pmicr']='Yes';$color0='green';}else{$aRow['ur_approver_pmicr']='No';$color0='red';}
		if($aRow['ur_checker_pmicr']=='1'){$aRow['ur_checker_pmicr']='Yes';$color1='green';}else{$aRow['ur_checker_pmicr']='No';$color1='red';}
		if($aRow['ur_notedby_pmicr']=='1'){$aRow['ur_notedby_pmicr']='Yes';$color2='green';}else{$aRow['ur_notedby_pmicr']='No';$color2='red';}		
		if($aRow['ur_approver_ts']=='1'){$aRow['ur_approver_ts']='Yes';$color3='green';}else{$aRow['ur_approver_ts']='No';$color3='red';}
		if($aRow['ur_approver_cn']=='1'){$aRow['ur_approver_cn']='Yes';$color4='green';}else{$aRow['ur_approver_cn']='No';$color4='red';}
		if($aRow['ur_approver_yf']=='1'){$aRow['ur_approver_yf']='Yes';$color5='green';}else{$aRow['ur_approver_yf']='No';$color5='red';}
		if($aRow['ur_notedby_ts']=='1'){$aRow['ur_notedby_ts']='Yes';$color6='green';}else{$aRow['ur_notedby_ts']='No';$color6='red';}
		if($aRow['ur_notedby_yf']=='1'){$aRow['ur_notedby_yf']='Yes';$color7='green';}else{$aRow['ur_notedby_yf']='No';$color7='red';}
		if($aRow['ur_notedby_cn']=='1'){$aRow['ur_notedby_cn']='Yes';$color8='green';}else{$aRow['ur_notedby_cn']='No';$color8='red';}
		// if($aRow['ur_notedby_pps']=='1'){$aRow['ur_notedby_pps']='Yes';$color9='green';}else{$aRow['ur_notedby_pps']='No';$color9='red';} // CHAN - 01-28-2025
		if($aRow['ur_notedby_ppd_ts']=='1'){$aRow['ur_notedby_ppd_ts']='Yes';$color10='green';}else{$aRow['ur_notedby_ppd_ts']='No';$color10='red';} // CHAN - 02-01-2025
		if($aRow['ur_notedby_ppd_cn']=='1'){$aRow['ur_notedby_ppd_cn']='Yes';$color11='green';}else{$aRow['ur_notedby_ppd_cn']='No';$color11='red';} // CHAN - 02-01-2025

		$row[] = '<input type="hidden" value="'.$aRow['ur_id'].'">'.$aRow['ur_name'];
		$row[] = $aRow['ur_title'];
		$row[] = '<span style="color:'.$color0.'";>'.$aRow['ur_approver_pmicr'].'</span>';
		$row[] = '<span style="color:'.$color1.'";>'.$aRow['ur_checker_pmicr'].'</span>';
		$row[] = '<span style="color:'.$color2.'";>'.$aRow['ur_notedby_pmicr'].'</span>';
		$row[] = '<span style="color:'.$color3.'";>'.$aRow['ur_approver_ts'].'</span>';
		// $row[] = '<span style="color:'.$color4.'";>'.$aRow['ur_approver_cn'].'</span>';
		// $row[] = '<span style="color:'.$color5.'";>'.$aRow['ur_approver_yf'].'</span>';
		$row[] = '<span style="color:'.$color6.'";>'.$aRow['ur_notedby_ts'].'</span>';
		$row[] = '<span style="color:'.$color8.'";>'.$aRow['ur_notedby_cn'].'</span>';
		$row[] = '<span style="color:'.$color7.'";>'.$aRow['ur_notedby_yf'].'</span>';
		// $row[] = '<span style="color:'.$color9.'";>'.$aRow['ur_notedby_pps'].'</span>'; // CHAN - 01-28-2025
		$row[] = '<span style="color:'.$color10.'";>'.$aRow['ur_notedby_ppd_ts'].'</span>'; // CHAN - 02-01-2025
		$row[] = '<span style="color:'.$color11.'";>'.$aRow['ur_notedby_ppd_cn'].'</span>'; // CHAN - 02-01-2025

		array_push($output['aaData'],$row);
	}
	echo json_encode( $output );
?>