<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<?php include "head.php" ?>
</head>

<body>
<?php include "header.php" ?>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav" id="panelOpcji" style="border-right: 1px solid #ccc;">
      <?php include "panelOpcji.php" ?>
    </div>
    <div class="col-sm-8 text-left"> 
		<?php 
	if (isset($_POST['Pole']))   // if ANY of the options was checked
	  $tableName = $_POST['Pole'];    // echo the choice
	else
	{
	  echo "nothing was selected.";
	  exit();
	}
	require_once 'connect.php';
		
	$sql = "select * from $tableName";
	
	echo '<h3 style="margin-bottom: -10px;">Wstawianie nowego rekordu do tabeli: <strong>'.$tableName.'</strong></h3>';
	echo "<hr/>";
	
	
  
	if ($res = $conn->query($sql))
	{
		echo '<form action="dodaj_rekord.php" method="post">';
	
		$_SESSION['tableName'] = $tableName;
		for($i = 0; $i < mysqli_num_fields($res); $i++) 
		{
			$field_info = mysqli_fetch_field($res);
			echo '<div class="input-group" style="margin-top: 10px;">';
			echo '<span class="input-group-addon" id="basic-addon1">'.$field_info->name.'</span>';
			echo '<input type="text" name="'.$field_info->name.'" class="form-control" aria-describedby="basic-addon1"></br>';
			echo '</div>';
		}
		echo '</br><input type="submit" value="Wstaw rekord" />';
		echo '</form>';
		
	}
	else echo "Query error!";
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