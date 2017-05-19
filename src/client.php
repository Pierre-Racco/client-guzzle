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
				<tr>
					<th>Auteur</th>
					<th>ISBN</th>
					<th>Titre</th>
					<th>Quantité</th>
					<th>Choix</th>
				</tr>
				<?php 
				if(isset($books)) :

					foreach($books as $book){ ?>
				<tr>
					<td><?=$book['author'];?></td>
					<td><?=$book['isbn'];?></td>
					<td><?=$book['title'];?></td>
					<td><?=$book['quantity'];?></td>
					<td><input type="number" min="0" name="isbn_<?=$book['isbn'];?>" value="0"/></td>
					
				</tr>
					<?php } 
				endif;
				?>
			</table>
		 
		    
		    
		    <input type="hidden" name="_method" value="POST">

			<button name="service" type="submit" value="commander">Commander</button>
		</form>

		<?php
		if(isset($_GET['code'])){
		?>
		<p>Code retour : <?php echo $_GET['code'] ;?></p>
		<?php } ?>
		<?php
		if(isset($_GET['reason'])){
		?>
		<p>Message : <?php echo $_GET['reason'] ;?></p>
		<?php } ?>

	</body>
</html>
