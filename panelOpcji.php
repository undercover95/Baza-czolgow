<div class="panel panel-default" style="box-shadow: 2px 2px 10px 0px rgba(189,189,189,1);">
  <div class="panel-heading">
	<h3 class="panel-title">Opcje podstawowe</h3>
  </div>
  <div class="panel-body">
	<a href="wybierz_tabele.php" class="btn btn-success" style="width:100%; float:none;">Wstaw rekord</a>
	<a href="wybierz_tabele2.php" class="btn btn-warning" style="width:100%; float:none; margin-top: 10px;">Edytuj rekord</a>
	<a href="wybierz_tabele3.php" class="btn btn-danger" style="width:100%; float:none; margin-top: 10px;">Usuń rekord</a>
  </div>
</div>

<div class="panel panel-default" style="box-shadow: 2px 2px 10px 0px rgba(189,189,189,1);">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Wyszukiwanie</h3>
	</div>
	<div class="panel-body">
	<form action="wyszukiwanie.php" method="post">
		<div class="input-group">
		  <span class="input-group-btn">
			<button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			</span>
		  <input type="text" class="form-control" placeholder="Wpisz nazwę czołgu..." aria-describedby="basic-addon1" name="nazwa_czolgu">
		</div>
	</form>
	  <a href="zaawSzukForm.php" class="btn btn-default" style="width:100%; float:none; margin-top: 10px;">Szukanie<br>zaawansowane</a>
	</div>
</div>