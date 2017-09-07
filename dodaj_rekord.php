
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
    <div class="col-sm-2 sidenav" id="panelOpcji" style="border-right: 1px solid #ccc; height: 100%">
      <?php include "panelOpcji.php" ?>
    </div>
    <div class="col-sm-8 text-left">
		<h3 style="margin-bottom: -10px;">Wstawianie rekordu do tabeli</h3>
		<hr/>
		<?php 
			if (isset($_SESSION['tableName']))   // if ANY of the options was checked
			  $tableName = $_SESSION['tableName'];    // echo the choice
			else
			{
			  echo "nothing was selected.";
			  exit();
			}
			unset($_SESSION['tableName']);
			
			require_once 'connect.php';
				
			$getFields = "select * from $tableName";
			
			$fields = "";
			$values = "";
			if ($resFields = $conn->query($getFields))
			{
				for($i = 0; $i < mysqli_num_fields($resFields); $i++) 
				{
					$field_info = mysqli_fetch_field($resFields);
					if($i == mysqli_num_fields($resFields)-1)
					{
						$fields .= $field_info->name;
						$values .= '"'.$_POST[$field_info->name].'"';
					}
					else
					{
						$fields .= $field_info->name.', ';
						$values .= '"'.$_POST[$field_info->name].'", ';
					}
				}
			}
			else echo "Query error!";
			
			$insert_values = "insert into $tableName (".$fields.") values (".$values.")";
			if ($conn->query($insert_values) == TRUE)
			{
				echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pomyślnie dodano rekord.</div>';
				header( "refresh:3;url=wybierz_tabele.php" );
			}
			else echo "failed!";
		?>
		
    </div>
    <div class="col-sm-2 sidenav" id="panelPojazdu" style="border-left: 1px solid #ccc;">
			<?php include "panelPojazdu.php" ?>
    </div>
  </div>
</div>

<?php include "footer.php" ?>

<script type="text/javascript">
	function resizePanels()
	{
	  $('#panelOpcji, #panelPojazdu').css({ height: $(window).innerHeight() });
	};
	
	function wyswietlPola()
	{
		var selectedTable = document.getElementById("selectTable").value;
		console.log(selectedTable);
		
		document.cookie = "selectedTable=" + selectedTable + ";" + "path=/;";
		
		
	}
	
</script>

</body>
</html>
			