	  <?php
		require_once 'connect.php';
		
		$conn = new mysqli($host, $user, $password, $database);
		echo "</br>";
		/* check connection */
		if (@mysqli_connect_errno()) {
			echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Błąd: '.mysqli_connect_error().'</div>';
			exit();
		}
		else echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Połączono z bazą danych.</div>';
		
		$sql = "select * from pojazdy";
		if ($res = $conn->query($sql))
		{
			echo "<table>"; // start a table tag in the HTML

			while($row = $res->fetch_assoc()){   //Creates a loop to loop through results
			echo "<tr><td>" . $row['ID'] ."</td><td>" .  $row['Nazwa'] . '</td><td> <button type="button" class="btn btn-default" style="width:100%; float:none;">Wstaw rekord</button> </td>'. "</tr>";  //$row['index'] the index here is a field name
			}

			echo "</table>"; //Close the table in HTML
			
			$res->close();
		}
		?>