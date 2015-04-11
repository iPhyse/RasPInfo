# RasPInfo
Simple Raspberry Pi info script

Demo: http://pi.rickrichter.nl/

#####Note: script does only work for linux distributions!

######raspinfo.class.php Includes:

| data | function |
| ------------- | ----------- |
| [OS] Hostname | raspinfo->getHostname() |
| [OS] Distribution name | raspinfo->getLinuxInfo()->['distribution'] |
| [OS] Codename | raspinfo->getLinuxInfo()->['codename'] |
| [OS] Version | raspinfo->getLinuxInfo()->['version'] |
| [OS] Description | raspinfo->getLinuxInfo()->['description'] |
| | |
| [CPU] model | raspinfo->getCpuData()->['model'] |
| [CPU] Cores | raspinfo->getCpuData()->['corecount'] |
| [CPU] Clockspeed | raspinfo->getCpuData()->['clockspeed'] |
| [CPU] Temperature | raspinfo->getCpuData()->['coretemp'] |
| | |
| [CPU] Everage load | raspinfo->getCpuLoad($cpuCount)->[0] |
| [CPU] CPU's| raspinfo->getCpuLoad($coreCount)->[$i] |
| | |
| [MEM] Total | raspinfo->getMemInfo()->['total'] |
| [MEM] Total percentage| raspinfo->getMemInfo()->['totalPerc'] |
| [MEM] Used| raspinfo->getMemInfo()->['used'] |
| [MEM] Used percentage| raspinfo->getMemInfo()->['usedPerc'] |
| [MEM] Free| raspinfo->getMemInfo()->['free'] |
| [MEM] Free percentage| raspinfo->getMemInfo()->['freePerc'] |
| | |
| [DISK] Total | raspinfo->getDiskUsage()->['total'] |
| [DISK] Total percentage| raspinfo->getDiskUsage()->['totalPerc'] |
| [DISK] Used| raspinfo->getDiskUsage()->['free'] |
| [DISK] Used percentage| raspinfo->getDiskUsage()->['freePerc'] |
| [DISK] Free| raspinfo->getDiskUsage()->['used'] |
| [DISK] Free percentage| raspinfo->getDiskUsage()->['usedPerc'] |
| | |
| [UPTIME] Days| raspinfo->getUptimeInfo()->['day'] |
| [UPTIME] Hours | raspinfo->getUptimeInfo()->['hour'] |
| [UPTIME] Minutes | raspinfo->getUptimeInfo()->['min'] |
| [UPTIME] Seconds | raspinfo->getUptimeInfo()->['sec'] |
