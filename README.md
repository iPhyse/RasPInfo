# RasPInfo
Simple Raspberry Pi info script - Written in PHP

Monitor your Raspberry Pi via any browser.

Required:
- Any version of a Raspberry Pi
- Windows IoT or a Linux Distribution ( Tested on Ubuntu/Debian )
- Apache, Nginx or simular.
- PHP up to 5.6.x. ( not tested on 7.x.x )

Demo: http://pi.rickrichter.nl/

#####Note: Windows IoT partly supported

######raspinfo class Includes:

| data | function |
| ------------- | ----------- |
| [OS] Hostname | raspinfo->getHostname() |
| [OS] Distribution name | raspinfo->getLinuxInfo()['distribution'] |
| [OS] Codename | raspinfo->getLinuxInfo()['codename'] |
| [OS] Version | raspinfo->getLinuxInfo()['version'] |
| [OS] Description | raspinfo->getLinuxInfo()['description'] |
| | |
| [CPU] model | raspinfo->getCpuData()['model'] |
| [CPU] Cores | raspinfo->getCpuData()['corecount'] |
| [CPU] Clockspeed | raspinfo->getCpuData()['clockspeed'] |
| [CPU] Temperature | raspinfo->getCpuData()['coretemp'] |
| | |
| [CPU] Everage load | raspinfo->getCpuLoad($cpuCount)[0] |
| [CPU] CPU's| raspinfo->getCpuLoad($coreCount)[$i] |
| | |
| [MEM] Total | raspinfo->getMemInfo()['total'] |
| [MEM] Total percentage| raspinfo->getMemInfo()['totalPerc'] |
| [MEM] Used| raspinfo->getMemInfo()['used'] |
| [MEM] Used percentage| raspinfo->getMemInfo()['usedPerc'] |
| [MEM] Free| raspinfo->getMemInfo()['free'] |
| [MEM] Free percentage| raspinfo->getMemInfo()['freePerc'] |
| | |
| [DISK] Total | raspinfo->getDiskUsage()['total'] |
| [DISK] Total percentage| raspinfo->getDiskUsage()['totalPerc'] |
| [DISK] Used| raspinfo->getDiskUsage()['free'] |
| [DISK] Used percentage| raspinfo->getDiskUsage()['freePerc'] |
| [DISK] Free| raspinfo->getDiskUsage()['used'] |
| [DISK] Free percentage| raspinfo->getDiskUsage()['usedPerc'] |
| | |
| [UPTIME] Days| raspinfo->getUptimeInfo()['day'] |
| [UPTIME] Hours | raspinfo->getUptimeInfo()['hour'] |
| [UPTIME] Minutes | raspinfo->getUptimeInfo()['min'] |
| [UPTIME] Seconds | raspinfo->getUptimeInfo()['sec'] |
