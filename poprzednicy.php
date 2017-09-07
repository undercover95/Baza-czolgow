<?php 
$id = $_COOKIE['pojazd_id']
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<?php include "head.php" ?>
</head>

<body>
<?php include "header.php" ?>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav" id="panelOpcji" style="border-right: 1px solid #ccc; height: 100%">
      <?php include "panelOpcji.php" ?>
    </div>
    <div class="col-sm-8 text-left"> 
		<?php
		require_once 'connect.php';
		
		$getName = "select Nazwa from pojazd where ID = '$id'";
		$getPoprzednik = "select * from pojazd where ID like (select poprzednik from nastepowanie where nastepnik = '$id')";
		$getNastepnik = "select * from pojazd where ID like (select nastepnik from nastepowanie where poprzednik = '$id')";
		
		if($resName = $conn->query($getName))
		{
			if ($resPoprz = $conn->query($getPoprzednik))
			{
				if($resNast = $conn->query($getNastepnik))
				{	
					$rowName = $resName->fetch_assoc();
					$rowPoprz = $resPoprz->fetch_assoc();
					$rowNast = $resNast->fetch_assoc();
					
					echo '<h3 style="margin-bottom: -10px;">'.$rowName['Nazwa'].' - Poprzednicy</h3>';
					echo "<hr/>";
					
					echo 'Poprzednik: ';
					
					if(mysqli_num_rows($resPoprz) == 0) echo "Brak";
					else
						for($i = 0; $i < mysqli_num_rows($resPoprz); $i++) 
							echo $rowPoprz['Nazwa'];
					
					echo '<br>';
					echo 'Następnik: ';
					if(mysqli_num_rows($resNast) == 0) echo "Brak";
					else
						for($i = 0; $i < mysqli_num_rows($resNast); $i++) 
							echo $rowNast['Nazwa'];
					
							
						
					
					$resNast->close();
				}
				$resPoprz->close();
			}
			$resName->close();
		}
		?>
		
    </div>
    <div class="col-sm-2 sidenav" id="panelPojazdu" style="border-left: 1px solid #ccc;">
			<?php include "panelPojazdu.php" ?>
    </div>
  </div>
</div>

<?php include "footer.php" ?>

<script>
	function resizePanels(){
		console.log("asd");
	  $('#panelOpcji, #panelPojazdu').css({ height: $(window).innerHeight() });
	});
</stript>

</body>
</html>
			
			
?>