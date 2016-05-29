<?php
date_default_timezone_set('UTC');

require_once __DIR__ . '/vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function() use($app) {
	return 'Try /hello/:name';
});

$app->get('/hello/{name}', function($name) use($app) {
	return 'Hello ' . $app->escape($name);
});

$app->get('/histogram/{username}', function($username) use($app) {
	return 'Testing ' . $app->escape($username);
});

$app->run();

?>