<?php
date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$app = new Silex\Application();
$app['debug'] = true;

define('CONSUMER_KEY', "1rIb14Mq5JhoS3CFied4CJQw2");
define('CONSUMER_SECRET', "m9nJnJVP9nxZ7a3zLVzIXvSbQFH4q5OdEJVwNXRJIgzi4xoqlz");

$app->get('/', function() use($app) {
	return 'Try /hello/:name';
});

$app->get('/hello/{name}', function($name) use($app) {
	return 'Hello ' . $app->escape($name);
});

$app->get('/histogram/{username}', function($username) use($app) {
	$access_token = '14450606-Nwh8jjRjhw8zv3yxOAQrsPawZuiClDlhxwcVeePeD';
	$access_token_secret = '5r7ByKymQXLGUeyH4xs8lh4XeeLZFl5pVi63LQAhE1W7c';

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
	// $user = $connection->get("account/verify_credentials");
	//$statuses = $connection->get("search/tweets", ["q" => "arsenal"]);
	$statuses = $connection->get("statuses/user_timeline", ["screen_name" => $username]);
	$result = count($statuses);
	$counter = 0;
	$tweets = array("0"=>0,"1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0,"10"=>0,"11"=>0,"12"=>0,"13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0)
	foreach ($statuses as $status) {
		$jsonArray = json_encode($status);
		$strArray = json_decode($jsonArray,true);
		echo var_dump($strArray["created_at"]).'<br/>';
		//convert string to datetime
		//check the hour and allocate to the $tweets array according to its hours
	}
	//convert $tweets to json
	//return the $tweets in json
	return $result;
	
});

$app->run();

?>