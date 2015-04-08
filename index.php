<?php
	include('./classes/raspinfo.class.php');
	
	//Small bootstrap progressbar type return (color)
	function bsProgressColor($val, $option){
		$color = "";
		if($val < 50 && $option == "asc" || $val > 50 && $option == "desc" ){ $color = "success";
		} elseif( $val < 75 && $option == "asc" || $val > 25 && $option == "desc" ){ $color = "warning";
		} else{ $color = "danger"; }
		return $color;
	}
	
	$bridge = new raspinfo();
	
	$hostname = $bridge->gethostname();
	$linuxInfo = $bridge->getLinuxInfo();
	$cpuData = $bridge->getCpuData();
	$cpuLoad = $bridge->getCpuLoad($cpuData["corecount"]);
	$memData = $bridge->getMemInfo();
	$uptimeData = $bridge->getUptimeInfo();
	$diskData = $bridge->getDiskUsage();
	
	include("template/index.php");
?>
