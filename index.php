
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "head.php" ?>
<script type="text/javascript">
 eraseCookie('pojazd_id');
</script>
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
		
		echo "</br>";
		/* check connection */
		if (@mysqli_connect_errno()) {
			//echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Błąd: '.mysqli_connect_error().'</div>';
			exit();
		}
		else echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Połączono z bazą danych.</div>';
		//echo "<hr>";
		
		$sql = "select ID, Nazwa from pojazd";
		if ($res = $conn->query($sql))
		{
			echo '<h3 style="margin-bottom: -10px;">Lista pojazdów w bazie <span class="badge">'.mysqli_num_rows($res).'</span></h3>';
			echo "<hr/>";
			
			echo '<div class="container-sql-table">';
			echo '<table class="sql-table">'; // start a table tag in the HTML

			for($i = 0; $i < mysqli_num_fields($res); $i++) {
				$field_info = mysqli_fetch_field($res);
				echo "<th>$field_info->name</th>";
			}
			echo "<th></th>";
			
			while($row = $res->fetch_assoc()){   //Creates a loop to loop through results
				echo "<tr><td>" . $row['ID'] ."</td><td>" .  $row['Nazwa'] . '</td><td> <a href="pojazd.php" class="btn btn-default"  style="width:100%; float:none;" onclick="zobaczPojazd(this)">Zobacz</a> </td>'. "</tr>";  //$row['index'] the index here is a field name
			}

			echo "</table></div>"; //Close the table in HTML
			echo '<div style="clear: both;"></div>';
			$res->close();
		}
		?>
		
    </div>
    <div class="col-sm-2 sidenav" id="panelPojazdu" style="border-left: 1px solid #ccc;">
			<?php include "panelPojazdu.php" ?>
    </div>
  </div>
</div>

<?php include "footer.php" ?>

<script>
	$(function(){
	  $('#panelOpcji, #panelPojazdu').css({ height: $(window).innerHeight() });
	  $(window).resize(function(){
		$('#panelOpcji, #panelPojazdu').css({ height: $(window).innerHeight() });
	  });
	});
</script>

</body>
</html>
