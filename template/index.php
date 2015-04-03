<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>iPhyse | RasPInfo</title>
    <meta name="description" content="RasPInfo">
    <meta name="author" content="iPhyse">
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/template/css/style.css">
    
	<script>
		// every minute 60sec * 1000 ticks
		setTimeout("location.reload(true);", 60000);
	</script>
    
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
	<div class="col-md-2"></div>
	<section class="col-md-8">
		<div class="interface">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-12">
						<h1><span class="glyphicon glyphicon-comment title-glyph" aria-hidden="true"> </span>Hostname: <?php echo $hostname; ?></h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2><span class="glyphicon glyphicon-info-sign title-glyph" aria-hidden="true"> </span>SYSTEM INFO</h2>
					</div>
					<div class="col-sm-4"> Distribution:</div>
					<div class="col-sm-8">
						<b><?php echo $linuxInfo["distribution"]; ?></b>
					</div>
					
					<div class="col-sm-4"> Codename:</div>
					<div class="col-sm-8">
						<b><?php echo $linuxInfo["codename"]; ?></b>
					</div>
					
					<div class="col-sm-4"> Version:</div>
					<div class="col-sm-8">
						<b><?php echo $linuxInfo["version"]; ?></b>
					</div>
					
					<div class="col-sm-4"> Description:</div>
					<div class="col-sm-8">
						<b><?php echo $linuxInfo["description"]; ?></b>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2><span class="glyphicon glyphicon-info-sign title-glyph" aria-hidden="true"> </span>CPU-DATA</h2>
					</div>					
					<div class="col-sm-4"> Model:</div>
					<div class="col-sm-8">
						<b><?php echo $cpuData["model"]; ?></b>
					</div>
										
					<div class="col-sm-4"> Cores:</div>
					<div class="col-sm-8">
						<b><?php echo $cpuData["corecount"]; ?></b>
					</div>
					
					<div class="col-sm-4"> Clockspeed:</div>
					<div class="col-sm-8">
						<b><?php echo $cpuData["clockspeed"]; ?>Mhz</b>
					</div>
					
					<div class="col-sm-4"> Temperature:</div>
					<div class="col-sm-8">
						<b><?php echo $cpuData["coretemp"]; ?>°C</b>
					</div>
					
				</div>
				
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2><span class="glyphicon glyphicon-tasks title-glyph" aria-hidden="true"> </span>CPU-LOAD</h2>
					</div>
                    <?php
                        $i = 0;
                        foreach($cpuLoad as $value){
							echo "<div class=\"row\">";
                            echo "<div class=\"col-xs-4\">";
                            if($i == 0){
                                echo "<b>Average load:</b> ";
                            } else {
                                echo "Cpu #" . $i . ": ";
                            }
                            echo "</div>";
                            echo "<div class=\"col-xs-8\">";
                            echo "<div class=\"progress\">";
                            echo "<div class=\"progress-bar progress-bar-info\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:". $value . "%;\">";
                            echo "<span class=\"col-md-12 progressbar-text\">" . $value . "% </span>";
                            echo "</div></div></div></div>";
                            
                            $i++;
                        }
                    ?>
				</div>	
					
				
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2><span class="glyphicon glyphicon-tasks title-glyph" aria-hidden="true"> </span>MEMORY</h2>
					</div>
					
					<div class="col-xs-4"> Total:</div>
					<div class="col-xs-8">
						<div class="progress">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $memData["totalPerc"] ?>%;">
								<span class="col-md-12 progressbar-text">
									<?php echo $memData["total"]  ?>M (<?php echo $memData["totalPerc"] ?>%)
								</span>
							</div>
						</div>
					</div>
					
					<div class="col-xs-4"> Used:</div>
					<div class="col-xs-8"> 
						<div class="progress">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $memData["usedPerc"] ?>%;">
								<span class="col-md-12 progressbar-text">
									<?php echo $memData["used"]  ?>M (<?php echo $memData["usedPerc"] ?>%)
								</span>
							</div>
						</div>
					</div>
					
					<div class="col-xs-4"> Free:</div>
					<div class="col-xs-8"> 
						<div class="progress">
							<div class="progress">
								<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $memData["freePerc"] ?>%;">
									<span class="col-md-12 progressbar-text">
										<?php echo $memData["free"]  ?>M (<?php echo $memData["freePerc"] ?>%)
									</span>
								</div>
							</div> 
						</div>
					</div>
				</div>
			
				<div class="col-sm-6">
					<div class="col-md-12">
						<h2><span class="glyphicon glyphicon-flash title-glyph" aria-hidden="true"> </span>UPTIME</h2>
					</div>
					
					<div class="col-xs-4"> Days:</div>
					<div class="col-xs-8">
						<b><?php echo $uptimeData["day"]; ?></b>
						&nbsp;
					</div>
					
					<div class="col-xs-4"> Hours:</div>
					<div class="col-xs-8">
						<b><?php echo $uptimeData["hour"]; ?></b>
						&nbsp;
					</div>
					
					<div class="col-xs-4"> Minutes:</div>
					<div class="col-xs-8">
						<b><?php echo $uptimeData["min"]; ?></b>
						&nbsp;
					</div>
					
					<div class="col-xs-4"> Seconds:</div>
					<div class="col-xs-8">
						<b><?php echo $uptimeData["sec"]; ?></b>
						&nbsp;
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="col-md-2"></div>
</body>
</html>
