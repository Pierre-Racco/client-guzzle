<?php
	require __DIR__ . '/../vendor/autoload.php';

		try {
			$client = new GuzzleHttp\Client(['base_uri' => 'http://project-shoppingservice.herokuapp.com/shopping/books']);
			$responseShoppingService = $client->request('GET');
			$books = json_decode($responseShoppingService->getBody(), true);
		} catch (Exception $e) {
			echo "<p> Service indisponible.</p>";
		}
?>
<html>
	<head>
		<link href="./assets/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top">
		  <div class="container">
		    <h1>Book store service</h1>
		  </div>
		</nav>
		
		<h2>Etat du stock :</h2>
		
			
		
		<form action="./actions.php" method="POST" class="input-group">

			<table>
				<?php 
				if(isset($books)) :

					foreach($books as $book){ ?>
				<tr>
					<td><?=$book['author'];?></td>
					<td><?=$book['isbn'];?></td>
					<td><?=$book['title'];?></td>
					<td><?=$book['quantity'];?></td>
					<td><input type="number" min="0" name="isbn_<?=$book['isbn'];?>"/></td>
					
				</tr>
					<?php } 
				endif;
				?>
			</table>
		    
		    <!-- <select name="book_select" required>
				<?php foreach($books as $book){ ?>
					<option value="<?=$book['isbn'];?>"><?=$book['title'];?></option>
				<?php } ?>
			</select> -->
		    
		    
		    <input type="hidden" name="_method" value="POST">

		    <!-- <button name="service" type="submit" value="acheter">Acheter</button> -->
			<button name="service" type="submit" value="commander">Commander</button>
		</form>


	</body>
</html>
