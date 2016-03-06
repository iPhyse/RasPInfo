<?php
	$host_os = strtolower(substr(PHP_OS, 0, 3));
	switch($host_os){
		case 'win':
			include('./classes/raspinfo.win32.class.php');
			break;
		case 'lin':
			include('./classes/raspinfo.linux.class.php');
			break;
	}
	
	//Small bootstrap progressbar type return (color)
	function bsProgressColor($val, $option){
		$color = "";
		if($val < 50 && $option == "asc" || $val > 50 && $option == "desc" ){ $color = "success";
		} elseif( $val < 75 && $option == "asc" || $val > 25 && $option == "desc" ){ $color = "warning";
		} else{ $color = "danger"; }
		return $color;
	}
	
	$raspinfo = new raspinfo();
	
	$hostname = $raspinfo->gethostname();
	$Info = $raspinfo->getInfo();
	$cpuData = $raspinfo->getCpuData();
	$cpuLoad = $raspinfo->getCpuLoad(1);
	$memData = $raspinfo->getMemInfo();
	$uptimeData = $raspinfo->getUptimeInfo();
	$diskData = $raspinfo->getDiskUsage();
	
	include("template/index.php");
?>
