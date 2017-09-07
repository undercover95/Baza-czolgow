<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
<?php include "head.php" ?>
</head>
<body>

<?php include "header.php" ?>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav" id="panelOpcji" style="border-right: 1px solid #ccc; height: 100%">
      <?php require "panelOpcji.php" ?>
    </div>
    <div class="col-sm-8 text-left"> 
		<?php
		try
		{
			if (isset($_POST['Pole']))   // if ANY of the options was checked
			  $tableName = $_POST['Pole'];    // echo the choice
			else
			{
			  echo "nothing was selected.";
			  throw new Exception();
			}
			
			require_once 'connect.php';
			
			
			
			$sql = "select * from $tableName";
			$getKey = "show index from $tableName";
			
			if ($res = $conn->query($sql))
			{
				if($resKey = $conn->query($getKey))
				{
					$rowKey = $resKey->fetch_assoc();
					echo '<h3 style="margin-bottom: -10px;">Usuwanie rekordów w tabeli <strong>'.$tableName.'</strong> <span class="badge">'.mysqli_num_rows($res).'</span></h3>';
					echo "<hr/>";
					
					setcookie('tableName', $tableName);
					setcookie('key_column', $rowKey['Column_name']);
					echo '<div class="container-sql-table">';
					echo '<table class="sql-table">'; // start a table tag in the HTML

					for($i = 0; $i < mysqli_num_fields($res); $i++) 
					{
						$field_info = mysqli_fetch_field($res);
						echo "<th>$field_info->name</th>";
					}
					echo "<th></th>";
					
					while($row = $res->fetch_assoc())
					{   //Creates a loop to loop through results
						echo "<tr>";
						
						foreach($row as $key => $value)
						{
							if($key == $rowKey['Column_name']) echo '<td class="keyValue">'.$value.'</td>';
							else echo '<td>'.$value.'</td>';
						}	
						echo '<td><a href="usun_rekord.php" class="btn btn-danger" style="width:100%; float:none;" onclick="saveDataToEdit(this)" >Usuń</a></td>';
						echo "</tr>";
					}

					echo "</table></div>"; //Close the table in HTML
					echo '<div style="clear: both;"></div>';
					$res->close();
					$resKey->close();
				}
				else echo "Query error!";
			}
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

<script type="text/javascript">
function saveDataToEdit(pre_id)
{
	console.log("omg");
	
	var table = document.getElementsByClassName("sql-table")[0];
	var rowID = $(pre_id).parent().parent().children('td.keyValue').text();
	document.cookie = "row_id=" + rowID + ";" + "path=/;";
}
</script>

</body>
</html>
