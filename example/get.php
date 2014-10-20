<?php
require "twitteroauth/twitteroauth.php";
$consumerkey = "XXXXXXXXXXXXXXXXXXX";
$consumersecret = "XXXXXXXXXXXXXXXXXXXXXXXX";
$accesstoken = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$accesstokensecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

function getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret) {
  $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
  return $connection;
}
  
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
$tweets = $connection->get('search/tweets', array(
		'q' => '@FIME_Oficial', // Nuestra consulta
		'lang' => 'es', 
		'count' =>100, // Número de tweets
		'include_entities' => false, // No nos interesa información adicional
		));

echo json_encode($tweets);
?>
