<html>
<title>PMI Charging Report</title>
<head>
<?php
  require_once('./includes.php');
?>
</head>
<body>
<ul class="nav nav-tabs">
  <li role="presentation" <?php if($page=='pmicr.inc.php'||$page==''){ echo 'class="active"';}?>><a href="./index.php?page=pmicr.inc.php">PMI Charging Report - F3</a></li>
  <li role="presentation" class="dropdown <?php if($page=='pmicr_ts.inc.php'||$page=='pmicr_cn.inc.php'||$page=='pmicr_yf.inc.php'||$page=='pmicr_pps.inc.php'||$page=='pmicr_click_table_ts.php'||$page=='pmicr_click_table_cn.php'||$page=='pmicr_click_table_yf.php'||$page=='pmicr_click_table_pps.php'){echo 'active';}?>">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      PMI Charging Report<span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
	  <li role="presentation" <?php if($page=='pmicr_ts.inc.php'||$page=='pmicr_click_table_ts.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_ts.inc.php">PMI Charging Report (TS)</a></li>
	  <li role="presentation" <?php if($page=='pmicr_cn.inc.php'||$page=='pmicr_click_table_cn.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_cn.inc.php">PMI Charging Report (CN)</a></li>
	  <li role="presentation" <?php if($page=='pmicr_yf.inc.php'||$page=='pmicr_click_table_yf.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_yf.inc.php">PMI Charging Report (YF)</a></li>
	  <li role="presentation" <?php if($page=='pmicr_pps.inc.php'||$page=='pmicr_click_table_pps.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_pps.inc.php">PMI Charging Report (PPD-TS)</a></li>
	  <li role="presentation" <?php if($page=='pmicr_pps_cn.inc.php'||$page=='pmicr_click_table_pps_cn.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_pps_cn.inc.php">PMI Charging Report (PPD-CN)</a></li>
    </ul>
  </li>
  <li role="presentation" <?php if($page=='pmicr_summary_report.inc.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_summary_report.inc.php">Summary Report</a></li>
  <li role="presentation" <?php if($page=='pmicr_signatories.inc.php'){ echo 'class="active"';}?>><a href="./index.php?page=pmicr_signatories.inc.php">Set Signatories</a></li>
  <!-- <li role="presentation"><a target="_blank" href="./manual/download.php?file=test.pdf"><i style="color:#189fe2;" class="fa fa-download"></i> Download User Manual</a></li> -->
</ul>