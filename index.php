<?php
	include('./classes/raspinfo.class.php');
	
	$bridge = new raspinfo();
	
	$hostname = $bridge->gethostname();
	$linuxInfo = $bridge->getLinuxInfo();
	$cpuData = $bridge->getCpuData();
	$cpuLoad = $bridge->getCpuLoad($cpuData["corecount"]);
	$memData = $bridge->getMemInfo();
	$uptimeData = $bridge->getUptimeInfo();
	
	include("template/index.php");
