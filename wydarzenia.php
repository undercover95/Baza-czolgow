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
		
		$sql = 'select * from wydarzenie where ID in (select ID_wydarzenia from udzial_w_wydarzeniu  where ID_pojazdu='.$id.')';
	
		$sql3 = "select Nazwa from pojazd where ID=$id";
		
		if ($res = $conn->query($sql))
		{
			if($res3 = $conn->query($sql3))
			{
				$row3 = $res3->fetch_assoc();
				echo '<h3 style="margin-bottom: -10px;">Wydarzenia w których brał udział pojazd '.$row3['Nazwa'].' <span class="badge">'.mysqli_num_rows($res).'</span></h3>';
				echo "<hr/>";
				
				echo '<div class="container-sql-table">';
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
				$res3->close();
			}
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