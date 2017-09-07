
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
		<h3 style="margin-bottom: -10px;">Wybieranie tabeli</h3>
		<hr/>
		
		<form action="displayTable1.php" method="post">
		<div class="form-group">
		  <?php include "pokazTabele.php" ?>
		  </br><input type="submit" value="Dalej" />
		 </div>
		</form>	

		 
		 
		
	
		
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
			