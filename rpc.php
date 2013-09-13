<?php
	
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	$db = new mysqli('localhost', 'root' ,'', 'filmes');
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			
			if(strlen($queryString) >0) {
				// Run the query: We use LIKE '$queryString%'
				// The percentage sign is a wild-card, in my example of countries it works like this...
				// $queryString = 'Uni';
				// Returned data = 'United States, United Kindom';
				
				// YOU NEED TO ALTER THE QUERY TO MATCH YOUR DATABASE.
				// eg: SELECT yourColumnName FROM yourTable WHERE yourColumnName LIKE '$queryString%' LIMIT 10
				
				$query = $db->query("SELECT * FROM filmes WHERE titulo LIKE '%$queryString%' OR titulo_original LIKE '%$queryString%' LIMIT 5");
				$query2 = $db->query("SELECT * FROM series WHERE serie LIKE '%$queryString%' LIMIT 5") or die (mysql_error());
				if($query || $query2) {
					// While there are results loop through them - fetching an Object (i like PHP5 btw!).
					while ($result = $query ->fetch_object()) {
						// Format the results, im using <li> for the list, you can change it.
						// The onClick function fills the textbox with the result.
						
						// YOU MUST CHANGE: $result->value to $result->your_colum
						$titulo = utf8_encode($result->titulo);
						$data  = utf8_encode($result->ano);
						$genero = utf8_encode($result->genero);
						$imagem = $result->formato_imagem;
	         				$idFilm = $result->id;

	         			echo "<li><a href='?single=true&id=$idFilm'>";
					echo "<span class='img'><img src='painel/imagens-posts/capas/$imagem' width=\"40px\" height=\"54px\" alt=''></span>";
					echo "<span class='titulo'>$titulo</span><span class='year'>$data</span><span class='info'>$genero</span>";
					echo "</a></li>";
	         		}while ($result = $query2 ->fetch_object()) {
						$titulo = utf8_encode($result->serie);
						$data  = utf8_encode($result->ano);
						$genero = utf8_encode($result->genero);
						$imagem = $result->formato_imagem;
	         				$idFilm = $result->id;

	         			echo "<li><a href='?serie=true&id=$idFilm'>";
					echo "<span class='img'><img src='painel/imagens-posts/capas/$imagem' width=\"40px\" height=\"54px\" alt=''></span>";
					echo "<span class='titulo'>$titulo</span><span class='year'>$data</span><span class='info'>$genero</span>";
					echo "</a></li>";

	         		}
	         			
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>