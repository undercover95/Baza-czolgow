<?php 
	require_once 'connect.php';
		
	$sql = "show tables";
	
	if ($res = $conn->query($sql))
	{
		if(mysqli_num_rows($res) == 0)
		{
			echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Nic nie znaleziono!</div>';
			exit();
		}
		echo "<strong>Wybierz tabelę:</strong><br/>";
		while($row = $res->fetch_assoc())
			echo '<input type="radio" name="Pole" value="'.$row['Tables_in_czolgi'].'"> '.$row['Tables_in_czolgi'].'<br>';
	}
	else echo "Query error!";
?>