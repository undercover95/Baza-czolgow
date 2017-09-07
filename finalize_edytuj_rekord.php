
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
		
		setcookie('tableName', "", time() - 3600); // usuwamy cookie 
		setcookie('row_id', "", time() - 3600); // usuwamy cookie 
		setcookie('key_column', "", time() - 3600); // usuwamy cookie 
		
		$getFields = "select * from $tableName";
			
		$fields = "";
		if ($resFields = $conn->query($getFields))
		{
			for($i = 0; $i < mysqli_num_fields($resFields); $i++) 
			{
				$field_info = mysqli_fetch_field($resFields);
				if($i == mysqli_num_fields($resFields)-1)
				{
					$fields .= $field_info->name."='".$_POST[$field_info->name]."'";
				}
				else
				{
					$fields .= $field_info->name."='".$_POST[$field_info->name]."', ";
				}
			}
		}
		else echo "Query error!";
		
		$update_values = "update $tableName set $fields where $key_column = '".$row_id."'";
		//echo $update_values;
		if ($conn->query($update_values) == TRUE)
		{
			echo '<br><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pomyślnie zmodyfikowano rekord.</div>';
			header( "refresh:3;url=wybierz_tabele2.php" );
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

<script>
	function resizePanels(){
		console.log("asd");
	  $('#panelOpcji, #panelPojazdu').css({ height: $(window).innerHeight() });
	});
</stript>

</body>
</html>