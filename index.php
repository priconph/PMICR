<?php
	/* If page does not exist load home page */
	require_once('../common_functions/get_username.php');
	echo '<input type="hidden" id="hd_username" value="'.$username.'">';
	// echo '<input type="hidden" id="hd_username" value="marilag">';
	if(!isset($_GET['page'])){
		$page = "pmicr.inc.php";
	}
	else{
		$page = $_GET['page'];
	}
	require_once("page_header.php");
	require_once($page);
	require_once("page_footer.php");
?>
