<html>
	<body>
		<h1>Client Guzzle : book store service</h1>
		<h2>Etat du stock :</h2>
		<?php
			require __DIR__ . '/../vendor/autoload.php';

			//todo : appeler /books de shoppingService
			
				$clientShoppingService = new GuzzleHttp\Client(['base_uri' => 'http://localhost:5000/']);
			try {
				$responseShoppingService = $clientShoppingService->request('GET', 'books');
				$body = $responseShoppingService->getBody();
				echo $body;
			} catch (Exception $e) {
				echo "<p> Service indisponible.</p>";
			}
		?>
	</body>
</html>
