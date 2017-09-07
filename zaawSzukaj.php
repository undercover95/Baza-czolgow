
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
			
			$sql = "select ID, Nazwa from pojazd where ";
			$spojnik = $_POST['spojnik'];
			if(isset($_POST['egzFlag']))
			{
				$liczbaProdOd = $_POST['liczbaProdOd'];
				$liczbaProdDo = $_POST['liczbaProdDo'];
				$sql .= "Ilosc_wyprodukowanych_egzemplarzy>=".$liczbaProdOd." and "."Ilosc_wyprodukowanych_egzemplarzy<=".$liczbaProdDo.' '.$spojnik.' ';
			}
			
			if(isset($_POST['zalogaFlag']))
			{
				$zaloga = $_POST['zaloga'];
				$sql .= 'Liczba_zalogantow='.$zaloga.' '.$spojnik.' ';
			}
			
			if(isset($_POST['lataFlag']))
			{
				$lataProdOd = $_POST['lataProdOd'];
				$lataProdDo = $_POST['lataProdDo'];
				$sql .= 'Poczatek_produkcji>='.$lataProdOd." and ".'Koniec_produkcji<='.$lataProdDo.' '.$spojnik.' ';
			}
			
			if(isset($_POST['kaliberFlag']))
			{
				$kaliberOd = $_POST['kaliberOd'];
				$kaliberDo = $_POST['kaliberDo'];
				$sql .= 'Kaliber>='.$kaliberOd." and ".'Kaliber<='.$kaliberDo.' '.$spojnik.' ';
			}
			
			echo '<h3 style="margin-bottom: -10px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Wyniki wyszukiwania</h3>';
			echo "<hr/>";
			
			if($spojnik == "and")
				$sql = substr($sql,0,strlen($sql)-5);
			else $sql = substr($sql,0,strlen($sql)-4);
			
			if ($res = $conn->query($sql))
			{
				echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Zapytanie:<br/><strong>'.$sql.'</strong></div>';
				
				echo '<p style="font-weight: 700">Znaleziono <span class="badge">'.mysqli_num_rows($res).'</span> rekordów.</p>';
				echo '<div class="container-sql-table" style="margin-bottom: 20px">';
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
				
				while($row = $res->fetch_assoc())
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
			
			
?>