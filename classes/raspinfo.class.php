<?php

class raspinfo
{
	public function getHostname(){
		$sHostname = shell_exec('hostname');
		return $sHostname;
	}
	
	public function getLinuxInfo(){
		$sLsbi_dist = explode( ':', shell_exec('lsb_release -i'));
		$sLsbr_vers = explode( ':', shell_exec('lsb_release -r'));
		$sLsbc_code = explode( ':', shell_exec('lsb_release -c'));
		$sLsbd_desc = explode( ':', shell_exec('lsb_release -d'));
		
		return array(
			'distribution' => $sLsbi_dist[1], 'version' => $sLsbr_vers[1], 'codename' => $sLsbc_code[1], 'description' => $sLsbd_desc[1]
		);
	}
	
	public function getCpuData(){
		$sTemp = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
		$sModel = shell_exec('cat /proc/cpuinfo | grep \'model name\'');
		$aModel = explode( ':', preg_replace( '!\s+!', ' ', $sModel ) );
		$sClock = shell_exec(' cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq');
		$sCores = shell_exec('lscpu | grep \'CPU(s)\'');
		$aCores = explode( ':', preg_replace( '!\s+!', ' ', $sCores ) );
		
		return array(
			'model' => $sModel[1], 'clockspeed' => $sClock/1000, 'corecount' => substr($aCores[1], 0, 3), 'coretemp' => substr($sTemp/1000, 0, 4)
		);
		
	}
	
	public function getMemInfo(){
		$sMemInfo = shell_exec('free -t | grep \'Mem\'');
		$aMemInfo = explode( ' ', preg_replace( '!\s+!', ' ', $sMemInfo ) );
		$iMemoryTotal = round($aMemInfo[1]/1024);
		$iMemoryUsed = round($aMemInfo[2]/1024);
		$iMemoryFree = round($aMemInfo[3]/1024);
		$iPercentTotal = 100;
		$iPercentUsed = round((100/$aMemInfo[1] )*$aMemInfo[2]);
		$iPercentFree = round((100/$aMemInfo[1] )*$aMemInfo[3]);
		
		return array(
			'total' => $iMemoryTotal, 'used' => $iMemoryUsed, 'free' => $iMemoryFree, 'totalPerc' => $iPercentTotal, 'usedPerc' => $iPercentUsed, 'freePerc' => $iPercentFree
		);
	}
	

	public function getCpuLoad($cpuCount){
		$iCPUData = shell_exec('grep \'cpu \' /proc/stat | awk \'{usage=($2+$4)*100/($2+$4+$5)} END {print usage}\'');
		$aCPULoad = array(round($iCPUData, 2));
		
		for($i = 0; $i < $cpuCount; $i++){
			$iNewCPULoad = shell_exec('grep \'cpu'. $i .' \' /proc/stat | awk \'{usage=($2+$4)*100/($2+$4+$5)} END {print usage}\'');
			array_push($aCPULoad, round($iNewCPULoad , 2)); 
		}
		return $aCPULoad;
	}
	
	public function getUptimeInfo(){
		//$e0 = shell_exec('uptime');
		$aUptimeData = explode( ' ', file_get_contents('/proc/uptime'));
		$iUptime = $aUptimeData[0];
		$iDays = floor((($iUptime/60)/60)/24);
		$iHours = floor($iUptime/60/60%24);
		$iMinutes = floor($iUptime/60%60);
		$iSeconds = $iUptime%60;
		
		return array(
			'day' => $iDays, 'hour' => $iHours, 'min' => $iMinutes, 'sec' => $iSeconds
		);
	}	
	
	public function getDiskUsage(){
		$iDiskTotal = round(disk_total_space('/') / 1024 / 1024);
		$iDiskFree = round(disk_free_space('/') / 1024 / 1024);
		$iDiskUsed = $iDiskTotal - $iDiskFree;
		$iPercentTotal = 100;
		$iPercentFree = round((100 / $iDiskTotal) * $iDiskFree);
		$iPercentUsed = 100 - $iPercentFree;
		
		return array(
			'total' => $iDiskTotal, 'free' => $iDiskFree, 'used' => $iDiskUsed, 'totalPerc' => $iPercentTotal, 'freePerc' => $iPercentFree, 'usedPerc' => $iPercentUsed
		);
	}
}
