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
		
		echo '<div class="pojazd-wrapper">';
		$sql = "select * from pojazd where id='$id'";
		
		if ($res = $conn->query($sql))
		{
			//echo '<div class="container-sql-table">';
			//echo '<table class="sql-table">'; // start a table tag in the HTML
			
			$row = $res->fetch_assoc();
			$nacja = $row['Nacja'];
			$sql2 = "select Nazwa, Flaga from Panstwo where Kod='$nacja'"; // chce flage nacji czolgu
			
			if ($res2 = $conn->query($sql2))
			{
				$row2 = $res2->fetch_assoc();
				echo '<h3 style="margin-bottom: -10px;">'.$row['Nazwa'].'</h3>';
				echo "<hr/>";
				
				echo '<div class="container-cechy-pojazdu">
				<table class="cechy-pojazdu">
					<caption style="background-color: #4CAF50; color: white; text-align: center;">
						<strong>Charakterystyka pojazdu</strong>
					</caption>';
					for($i = 0; $i < mysqli_num_fields($res); $i++) 
					{
						$field_info = mysqli_fetch_field($res);
						if($i == 3) {
							echo "<tr><td><strong>$field_info->name</strong></td><td>".$row2['Nazwa'].'   <img style="border: 1px solid #ccc" height="20px" width="auto" src="'.$row2['Flaga'].'"></td></tr>';
							continue;
						}
						if($i == mysqli_num_fields($res)-1) continue; // pomijamy sciezke do zdj
						echo "<tr><td><strong>$field_info->name</strong></td><td>".$row[$field_info->name]."</td></tr>";
					}
				
				echo '</table></div>';
				if($row['Zdjecie'] == "")
					echo '<div class="crop" style="float:right;"><img style="border: 1px solid #a5a5a5;" width="100%" height="auto" src="http://placehold.it/1024x768"></div>';
				else
					echo '<div class="crop" style="float:right;"><img style="border: 1px solid #a5a5a5;" width="100%" height="auto" src="'.$row['Zdjecie'].'"></div>';
				
				$res2->close();
			}
			$res->close();
		}
		echo "</div>"
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