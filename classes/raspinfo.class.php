<?php

class raspinfo
{
	public function getHostname(){
		$e0 = shell_exec('hostname');
		return $e0;
	}
	
	public function getLinuxInfo(){
		$s0 = explode( ':', shell_exec('lsb_release -i'));
		$s1 = explode( ':', shell_exec('lsb_release -r'));
		$s2 = explode( ':', shell_exec('lsb_release -c'));
		$s3 = explode( ':', shell_exec('lsb_release -d'));
		
		return array(
			'distribution' => $s0[1], 'version' => $s1[1], 'codename' => $s2[1], 'description' => $s3[1]
		);
	}
	
	public function getCpuData(){
				
		$e0 = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
				
		$e1 = shell_exec('cat /proc/cpuinfo | grep \'model name\'');
		$a1 = explode( ':', preg_replace( '!\s+!', ' ', $e1 ) );
		
		$e2 = shell_exec(' cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq');
				
		$e3 = shell_exec('lscpu | grep \'CPU(s)\'');
		$a3 = explode( ':', preg_replace( '!\s+!', ' ', $e3 ) );
		
		return array(
			'model' => $a1[1], 'clockspeed' => $e2/1000, 'corecount' => substr($a3[1], 0, 3), 'coretemp' => substr($e0/1000, 0, 4)
		);
		
	}
	
	public function getMemInfo(){
		$e0 = shell_exec('free -t | grep \'Mem\'');
		$a0 = explode( ' ', preg_replace( '!\s+!', ' ', $e0 ) );

		$i1 = round($a0[1]/1024);
		$i2 = round($a0[2]/1024);
		$i3 = round($a0[3]/1024);
		
		$i4 = round((100/$a0[1] )*$a0[2]);
		$i5 = round((100/$a0[1] )*$a0[3]);
		
		return array(
			'total' => $i1, 'used' => $i2, 'free' => $i3, 'totalPerc' => 100, 'usedPerc' => $i4, 'freePerc' => $i5
		);
	}
	

	public function getCpuLoad($cpuCount){
		$i0 = shell_exec('grep \'cpu \' /proc/stat | awk \'{usage=($2+$4)*100/($2+$4+$5)} END {print usage}\'');
		$a0 = array(round($i0, 2));
		
		for($i = 0; $i < $cpuCount; $i++){
			$i1 = shell_exec('grep \'cpu'. $i .' \' /proc/stat | awk \'{usage=($2+$4)*100/($2+$4+$5)} END {print usage}\'');
			array_push($a0, round($i1 , 2)); 
		}
		return $a0;
	}
	
	public function getUptimeInfo(){
		$e0 = shell_exec('uptime');
		$a0 = explode( ' ', file_get_contents('/proc/uptime'));
		
		$i0 = $a0[0];
		$i1 = floor((($i0/60)/60)/24);
		$i2 = floor($i0/60/60%24);
		$i3 = floor($i0/60%60);
		$i4 = $i0%60;
		
		return array(
			'day' => $i1, 'hour' => $i2, 'min' => $i3, 'sec' => $i4
		);
	}	
	
	public function getDiskUsage(){
		$i0 = round(disk_total_space('/') / 1024 / 1024);
		$i1 = round(disk_free_space('/') / 1024 / 1024);
		$i3 = $i0 - $i1;
		$i4 = round((100 / $i0) * $i1);
		$i5 = 100 - $i4;
		
		return array('total' => $i0, 'free' => $i1, 'used' => $i3, 'totalPerc' => 100, 'freePerc' => $i4, 'usedPerc' => $i5);
	}
}
