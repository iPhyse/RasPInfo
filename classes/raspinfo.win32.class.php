<?php

class raspinfo
{
	public function getHostname(){
		$sHostname = shell_exec('hostname');
		return $sHostname;
	}
	
	public function getInfo(){
		exec('wmic os get Manufacturer', $win32_dist);
		exec('wmic os get Version', $win32_vers);
		exec('wmic os get Caption', $win32_code);
		exec('wmic os get OSArchitecture', $win32_desc);
		
		return array(
			'distribution' => $win32_dist[1], 
			'version' => $win32_vers[1], 
			'codename' => $win32_code[1], 
			'description' => $win32_desc[1],
		);
	}
	
	public function getCpuData(){
		/*
		 * TODO: CPU temp readings
		 */
		 
		$sTemp = 0;
		
		exec('wmic cpu get Name', $sModel);
		exec('wmic cpu get MaxClockSpeed', $sClock);
		exec('wmic cpu get NumberOfCores', $sCores);
		
		return array(
			'model' => $sModel[1], 
			'clockspeed' => $sClock[1], 
			'corecount' => $sCores[1], 
			'coretemp' => $sTemp,
		);
		
	}
	
	public function getMemInfo(){	
		exec('wmic OS get TotalVisibleMemorySize', $aMemoryTotal);
		exec('wmic OS get FreePhysicalMemory', $aMemoryFree);
		
		$iMemoryTotal = floor($aMemoryTotal[1] / 1000);
		$iMemoryFree = floor($aMemoryFree[1] / 1000);
		$iMemoryUsed = $iMemoryTotal - $iMemoryFree;
		
		$iPercentTotal = 100;
		$iPercentFree = floor((100/$iMemoryTotal )*$iMemoryFree);
		$iPercentUsed = floor((100/$iMemoryTotal )*$iMemoryUsed);
		
		return array(
			'total' => $iMemoryTotal, 
			'used' => $iMemoryUsed, 
			'free' => $iMemoryFree, 
			'totalPerc' => $iPercentTotal, 
			'usedPerc' => $iPercentUsed, 
			'freePerc' => $iPercentFree,
		);
	}

	public function getCpuLoad($cpuCount){
		/*
		 * TODO: Multiple core support
		 */
		
		exec('wmic cpu get LoadPercentage', $aCPULoad);
		
		array_shift($aCPULoad);
		array_pop($aCPULoad);
		
		return $aCPULoad;
	}
	
	public function getUptimeInfo(){
		/*
		 * TODO: uptime for days, hours, minuts and seconds
		 */
		 
		 $iDays = 0;
		 $iHours = 0;
		 $iMinutes = 0;
		 $iSeconds = 0;
		 
		return array(
			'day' => $iDays, 
			'hour' => $iHours, 
			'min' => $iMinutes, 
			'sec' => $iSeconds,
		);
	}	
	
	public function getDiskUsage(){
		exec('wmic /node:"%COMPUTERNAME%" LogicalDisk Where DriveType="3" Get DeviceID,Size|find /I "c:"', $aDiskTotal);
		exec('wmic /node:"%COMPUTERNAME%" LogicalDisk Where DriveType="3" Get DeviceID,FreeSpace|find /I "c:"', $aDiskFree);
		
		$iDiskTotal = trim(explode(':', $aDiskTotal[0])[1]);
		$iDiskTotal = round(($iDiskTotal / 1024 / 1024 / 1024) * 1000);
		$iDiskFree = trim(explode(':', $aDiskFree[0])[1]);
		$iDiskFree = round(($iDiskFree / 1024 / 1024 / 1024) * 1000);
		$iDiskUsed = $iDiskTotal - $iDiskFree;
		
		$iPercentTotal = 100;
		$iPercentFree = round((100 / $iDiskTotal) * $iDiskFree);
		$iPercentUsed = 100 - $iPercentFree;
		
		return array(
			'total' => $iDiskTotal, 
			'free' => $iDiskFree, 
			'used' => $iDiskUsed, 
			'totalPerc' => $iPercentTotal, 
			'freePerc' => $iPercentFree, 
			'usedPerc' => $iPercentUsed,
		);
	}
}
