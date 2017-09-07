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
	<form action="zaawSzukaj.php" method="POST">
	<div class="form-group">
        <h3 style="margin-bottom: -10px;">Wyszukiwanie zaawansowane</h3>
		<hr/>
		<div class="input-group" style="margin-top: 20px;">
		  <span class="input-group-addon">
			<label><input type="checkbox" name="egzFlag" aria-label="..."> Liczba wyprodukowanych</label>
		  </span>
		  <div class="row">
			<div class="col-sm-6">
				<input type="text" class="form-control" aria-label="..." name="liczbaProdOd" placeholder="Od">
			</div>
			<div class="col-sm-6">
				<input type="text" class="form-control" aria-label="..." name="liczbaProdDo" placeholder="Do">
			</div>
		  </div>
		</div>
		
		<div class="input-group" style="margin-top: 20px;">
		  <span class="input-group-addon">
			<label><input type="checkbox" name="zalogaFlag" aria-label="..." > Liczba załogantów</label>
		  </span>
		  <input type="text" class="form-control" name="zaloga" aria-label="..." placeholder="Wpisz liczbę załogantów">
		</div>
		
		<div class="input-group" style="margin-top: 20px;">
		  <span class="input-group-addon">
			<label><input type="checkbox" name="lataFlag" aria-label="..."> Lata produkcji</label>
		  </span>
		  <div class="row">
			  <div class="col-sm-6">
				<input type="text" class="form-control" name="lataProdOd" aria-label="..." placeholder="Od">
			  </div>
			  <div class="col-sm-6">
				<input type="text" class="form-control" name="lataProdDo" aria-label="..." placeholder="Do">
			  </div>
		  </div>
		</div>
		
		<div class="input-group" style="margin-top: 20px;">
		  <span class="input-group-addon">
			<label><input type="checkbox" name="kaliberFlag" aria-label="..."> Kaliber [mm]</label>
		  </span>
		  <div class="row">
			  <div class="col-sm-6">
				<input type="text" class="form-control" name="kaliberOd" aria-label="..." placeholder="Od">
			  </div>
			  <div class="col-sm-6">
				<input type="text" class="form-control" name="kaliberDo" aria-label="..." placeholder="Do">
			  </div>
		  </div>
		</div>
		
		<div class="input-group pull-right" style="margin-top: 20px;">
		<label for="koniunkcja">Koniunkcja</label>
		<input type="radio" aria-label="..." name="spojnik" id="koniunkcja" value="and" checked>
		<label for="alternatywa">Alternatywa</label>
		<input type="radio" aria-label="..." name="spojnik" id="alternatywa" value="or">
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Szukaj</button>
		</div>
		</div>
	  </form>
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