<?php 
$id = $_COOKIE['pojazd_id'];
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
		
		$sql = 'select egzemplarz.ID, egzemplarz.Rok_produkcji, kolekcjoner.Imie, kolekcjoner.Nazwisko from egzemplarz inner join kolekcjoner on egzemplarz.ID_wlasciciela = kolekcjoner.ID and egzemplarz.Kod_wlasciciela="K" where egzemplarz.ID_pojazdu='.$id;
		
		$sql2 = 'select egzemplarz.ID, egzemplarz.Rok_produkcji, muzeum.Nazwa, muzeum.Kraj from egzemplarz inner join muzeum on egzemplarz.ID_wlasciciela = muzeum.ID and egzemplarz.Kod_wlasciciela="M" where egzemplarz.ID_pojazdu='.$id;
	
		$sql3 = "select Nazwa from pojazd where ID=$id";
		
		if ($res = $conn->query($sql))
		{
			if($res2 = $conn->query($sql2))
			{
				if($res3 = $conn->query($sql3))
				{
					$row3 = $res3->fetch_assoc();
					echo '<h3 style="margin-bottom: -10px;">Egzemplarze pojazdu '.$row3['Nazwa'].' <span class="badge">'.(mysqli_num_rows($res) + mysqli_num_rows($res2)).'</span></h3>';
					echo "<hr/>";
					
					echo '<h4>Egzemplarze których właścicielem jest kolekcjoner <span class="badge">'.mysqli_num_rows($res).'</span></h4>';
					echo '<div class="container-sql-table" style="margin-bottom: 30px">';
					echo '<table class="sql-table">'; // start a table tag in the HTML
					
					for($i = 0; $i < mysqli_num_fields($res); $i++) 
					{
						$field_info = mysqli_fetch_field($res);
						echo "<th>$field_info->name</th>";
					}
					
					while($row = $res->fetch_assoc())
					{   //Creates a loop to loop through results
						echo "<tr>";
						
						foreach($row as $key => $value)
						{
							echo '<td>'.$value.'</td>';
						}	
						echo "</tr>";
					}
					
					echo '</table></div>';
					
					echo '<h4>Egzemplarze których właścicielem jest muzeum <span class="badge">'.mysqli_num_rows($res2).'</span></h4>';
					echo '<div class="container-sql-table" style="margin-bottom: 30px">';
					echo '<table class="sql-table">'; // start a table tag in the HTML
					
					for($i = 0; $i < mysqli_num_fields($res2); $i++) 
					{
						$field_info = mysqli_fetch_field($res2);
						echo "<th>$field_info->name</th>";
					}
					
					while($row2 = $res2->fetch_assoc())
					{   //Creates a loop to loop through results
						echo "<tr>";
						
						foreach($row2 as $key => $value)
						{
							echo '<td>'.$value.'</td>';
						}	
						echo "</tr>";
					}
					
					echo '</table></div>';
					$res3->close();
				}
				$res2->close();
			}
			else echo "Query 2 Error!"; 
			$res->close();
		}
		else echo "Query 1 Error!"; 
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