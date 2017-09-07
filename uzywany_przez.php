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
		$getCountryID = "select Kod_panstwa from uzytkowanie where ID_pojazdu='$id'";
		
		if($resName = $conn->query($getName))
		{
			if ($resCountryID = $conn->query($getCountryID))
			{
				$rowName = $resName->fetch_assoc();
				
				echo '<h3 style="margin-bottom: -10px;"> Państwa używające pojazdu '.$rowName['Nazwa'].' <span class="badge">'.mysqli_num_rows($resCountryID).'</span></h3>';
				echo "<hr/>";
				
				echo '<div class="container-sql-table" style="width: 100%">
					<table class="sql-table">';
		
				while($rowCountryID = $resCountryID->fetch_assoc())
				{
					$kod = $rowCountryID['Kod_panstwa'];
					$getCountryName = "select Nazwa, Flaga from Panstwo where Kod = '$kod'";
					if ($resCountryName = $conn->query($getCountryName))
					{
						$rowCountryName = $resCountryName->fetch_assoc();
						echo '<tr><td>'.$rowCountryName['Nazwa'].'</td><td>'.'<img style="border: 1px solid #ccc" height="20px" width="auto" src="'.$rowCountryName['Flaga'].'"></td></tr>';
					}
					else echo "Query error!<br>";
				}
				echo '</table></div>';
					
			}
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