<?php
require __DIR__ . '/../vendor/autoload.php';
use Silex\WebTestCase;

class WebTest extends WebTestCase {
	public function createApplication() {
    	$app_env = 'test';
    	return require __DIR__ . '/../index.php';
		
	}
	public function testBCApp() {
		$client = $this->createClient();
		
		//Testing the front page
		$crawler = $client->request('GET','/');
		$this->assertEquals(
			200,
			$client->getResponse()->getStatusCode(),
			'Front page failed to render'
		);
		
		$this->assertCount(
		    1, 
		    $crawler->filter('html:contains("Try /hello/:name")'), 
		    'Expected text not found'
		);
		
		//Testing /hello/:name
		$crawler = $client->request('GET','/hello/test');
		$this->assertEquals(
		200,
		$client->getResponse()->getStatusCode(),
		'Something went wrong when testing /hello/test'
		);
		
		
		$this->assertCount(
			1,
			$crawler->filter('html:contains("Hello test")'),
			'The expected output failed'
		);
		
		//Testing /histogram/:username by using my twitter handle
		$crawler = $client->request('GET','/histogram/julines');
		$this->assertEquals(
		200,
		$client->getResponse()->getStatusCode(),
		'Something went wrong when testing /histogram/:username'
		);
				
		$this->assertCount(
			1,
			$crawler->filter("html:contains('{\"0\":0,\"1\":0,\"2\":0,\"3\":0,\"4\":0,\"5\":0,\"6\":0,\"7\":0,\"8\":0,\"9\":0,\"10\":0,\"11\":0,\"12\":0,\"13\":0,\"14\":0,\"15\":0,\"16\":0,\"17\":0,\"18\":0,\"19\":0,\"20\":0,\"21\":0,\"22\":0,\"23\":0}')"),
			'The expected output failed'
		);	
	}
}