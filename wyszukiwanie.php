<?php
	$nazwa_czolgu = $_POST['nazwa_czolgu'];
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
		try
		{
			require_once 'connect.php';
			
			$sql = "select ID, Nazwa from pojazd where Nazwa like '$nazwa_czolgu'";
			
			echo '<h3 style="margin-bottom: -10px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Wyniki wyszukiwania</h3>';
			echo "<hr/>";
			
			if ($res = $conn->query($sql))
			{
				echo '<div class="container-sql-table">';
				echo '<table class="sql-table">'; // start a table tag in the HTML
		
				if(mysqli_num_rows($res) == 0)
				{
					echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Nic nie znaleziono!</div>';
					echo "</table></div>"; //Close the table in HTML
					echo '<div style="clear: both;"></div>';
					$res->close();
					throw new Exception();
				}
				
				for($i = 0; $i < mysqli_num_fields($res); $i++) {
					$field_info = mysqli_fetch_field($res);
					echo "<th>$field_info->name</th>";
				}
				echo "<th></th>";
				
				$row = $res->fetch_assoc();  //Creates a loop to loop through results
					echo "<tr><td>" . $row['ID'] ."</td><td>" .  $row['Nazwa'] . '</td><td> <a href="pojazd.php" class="btn btn-default"  style="width:100%; float:none;" onclick="zobaczPojazd(this)">Zobacz</a> </td>'. "</tr>";  //$row['index'] the index here is a field name
				

				echo "</table></div>"; //Close the table in HTML
				echo '<div style="clear: both;"></div>';
				$res->close();
			}
			else echo "Query error!";
		}
		catch(Exception $e) {}
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