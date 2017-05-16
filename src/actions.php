<?php
require __DIR__ . '/../vendor/autoload.php';
$client = new GuzzleHttp\Client(
	[
	'base_uri' => 'http://project-shoppingservice.herokuapp.com/shopping/books',
	'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
	]
);

// $client = new GuzzleHttp\Client();
if( !empty( $_POST ) ){

	$post_array = array();

	foreach ($_POST as $isbn => $quantity) {

		// Nettoyer le $_POST
		if (preg_match('#^isbn_#', $isbn)) {

			$prefix = 'isbn_';

			// Formater la chaine isbn
			if (substr($isbn, 0, strlen($prefix)) == $prefix) {
			    $isbn = substr($isbn, strlen($prefix));
			}

			// Préparer l'array pour le format json
		   	$array_temp = array(
		      "isbn" => $isbn,
		      "quantity" => $quantity,
		    );
		    array_push($post_array, $array_temp);
		}
	}
}

// $json = json_encode( $post_array );
// var_dump($json);
try{
$response = $client->request('POST', 'http://project-shoppingservice.herokuapp.com/shopping/books/order', [
 	//todo à tester
 	//'headers' => ['Content-Type' => 'application/json', 'Accept' => 'text/plain'],
 	'json' => $post_array
]);
var_dump($response);
} catch (Exception $e) {
	var_dump($e);
}

header('Location: ./client.php'); 





?>