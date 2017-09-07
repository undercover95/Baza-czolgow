
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
		
		$delete = "delete from $tableName where $key_column='$row_id'";
		//echo $delete;
		if ($conn->query($delete) == TRUE)
		{
			echo '<br><div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pomyślnie usunięto rekord.</div>';
			header( "refresh:3;url=wybierz_tabele3.php" );
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