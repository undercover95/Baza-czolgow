
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
		$tableName = $_COOKIE['tableName'];
		$row_id = $_COOKIE['row_id'];
		$key_column = $_COOKIE['key_column'];

		
		
		
		$sql = "select * from $tableName where $key_column = '".$row_id."'";
		//echo $sql;
		
	  
		if ($res = $conn->query($sql))
		{
			$row = $res->fetch_assoc();
			
			echo '<h3 style="margin-bottom: -10px;">Edycja rekordu w tabeli: <strong>'.$tableName.'</strong> <span class="badge">'.mysqli_num_rows($res).'</span></h3>';
			echo "<hr/>";
			
			echo '<form action="finalize_edytuj_rekord.php" method="post">';
			
			for($i = 0; $i < mysqli_num_fields($res); $i++) 
			{
				$field_info = mysqli_fetch_field($res);
				echo '<div class="input-group" style="margin-top: 10px;">';
				echo '<span class="input-group-addon" id="basic-addon1">'.$field_info->name.'</span>';
				if($field_info->name == $key_column) 
					echo '<input type="text" name="'.$field_info->name.'" value="'.$row[$field_info->name].'" class="form-control" aria-describedby="basic-addon1" readonly="readonly"></br>';
				else 
					echo '<input type="text" name="'.$field_info->name.'" value="'.$row[$field_info->name].'" class="form-control" aria-describedby="basic-addon1"></br>';
				echo '</div>';
			}
			echo '</br><input type="submit" value="Wykonaj" />';
			echo '</form>';
		}
		else echo "Query Error!"; 
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