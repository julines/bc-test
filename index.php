<?php
date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$app = new Silex\Application();

if (isset($app_env) && in_array($app_env, array('prod','dev','test'))) {
    $app['env'] = $app_env;
}
else {
    $app['env'] = 'prod';
}

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
	//The assumption is that the twitter API "statuses/user_timeline retrieves the users' tweet for the last 2000 tweets"
	$statuses = $connection->get("statuses/user_timeline", ["screen_name" => $username, "include_rts" => 1, "count" => 2000]);
	$result = count($statuses);
	$tweets = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	// $counter = 0;
	foreach ($statuses as $status) {
		$jsonArray = json_encode($status);
		$strArray = json_decode($jsonArray,true);
		//An example of the string format of date returned is Mon May 30 09:48:10 +0000 2016
		$createdAtDate = date_create_from_format('D M j H:i:s O Y', $strArray['created_at']);
		if($createdAtDate->format('Y-m-d') == date('Y-m-d')) {
			// $counter++;
			$createdAtHour = $createdAtDate->format('G');
			$tweets[$createdAtHour]++;
		}
	}
	return json_encode($tweets, JSON_FORCE_OBJECT);
});

if ('test' == $app['env'])
    return $app;
else
    $app->run();

?>