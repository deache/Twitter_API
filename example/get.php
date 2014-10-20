<?php
require "twitteroauth/twitteroauth.php";
$consumerkey = "zM28XVkmrtPQQi1HhSSKQ";
$consumersecret = "yIyqbpPHybzVVzt4SQ4IMxR3WwYl9o2RK6ASP19AE";
$accesstoken = "128752572-RwxH1lXl5t8xp9ox1yrR58j93zFiOGXP3rtJso";
$accesstokensecret = "ec0zhXrGatNXEJJjFOaPVmojjdjwOa7vIoMA0pu0ug";

function tweet_text($text) {
	// urls: lo primero para que no conviertan los links posteriores
	$text =  preg_replace("/(http:\/\/[^\s]+)/", '<a href="$1" class="tweet-link" target="_blank">$1</a>', $text);
	// menciones
	$text =  preg_replace("/(^|\W)@([A-Za-z0-9_]+)/", '$1<a href="http://twitter.com/$2" class="tweet-mention" target="_blank">@$2</a>', $text);
	// hashtags
	$text =  preg_replace("/(^|\W)#([^\s]+)/", '$1<a href="?q=%23$2" class="tweet-hash" target="_blank">#$2</a>', $text);
	return $text;
}
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
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