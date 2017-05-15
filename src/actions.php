<?php
require __DIR__ . '/../vendor/autoload.php';

switch($_REQUEST['service']) {

    case 'acheter': 
    	$client = new GuzzleHttp\Client();
    	break;

    case 'commander': 
    	$client = new GuzzleHttp\Client(['base_uri' => '']);
        break;

}

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
$json = json_encode( $post_array );



$response = $client->request('POST', 'http://project-shoppingservice.herokuapp.com/shopping/books', [
	'headers' => ['Content-Type' => 'application/json'],
    'json'    =>  $json,
]);





?>