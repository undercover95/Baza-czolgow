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
		$getGames = "select * from gra_komputerowa where Kod_gry in (select Kod_gry from implementacja where ID_pojazdu='$id')";
		
		if($resName = $conn->query($getName))
		{
			if ($resGames = $conn->query($getGames))
			{
				$rowName = $resName->fetch_assoc();
				
				echo '<h3 style="margin-bottom: -10px;">Gry implementujące pojazd '.$rowName['Nazwa'].' <span class="badge">'.mysqli_num_rows($resGames).'</span></h3>';
				echo "<hr/>";
				
				echo '<div class="container-sql-table">
					<table class="sql-table"  style="text-align: center;">';
		
				for($i = 0; $i < mysqli_num_fields($resGames); $i++) {
					$field_info = mysqli_fetch_field($resGames);
					echo "<th>$field_info->name</th>";
				}
				
				while($rowGames = $resGames->fetch_assoc())
				{
					echo '<tr><td>'.$rowGames['Nazwa'].'</td><td>'.$rowGames['Kod_gry'].'</td><td>'.$rowGames['Gatunek'].'</td><td>'.$rowGames['Rok_wydania'].'</td><td><img height="50px" width="auto" src="'.$rowGames['Logo'].'"></td></tr>';
				}
				echo '</table></div>';
					
			}
			else echo "Query 1 error!<br>";
		}
		else echo "Query 2 error!<br>";
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