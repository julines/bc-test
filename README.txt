Dependencies: 
 - create a folder for the Silex application.  Go into the folder
 - I use Composer to install my dependencies, using the file called composer.json
 - The following library were included:
 	- Silex 1.3, 
	- monolog
	- TwitterOAuth (https://twitteroauth.com/)
	- symfony browser kit
	- symfony css selector
	- phpunit
 - To install the dependencies, run the command "php composer.phar install"
 
Running the application:
 - To run the application, you need to have a twitter account and register your application at https://apps.twitter.com/ to use the twitter API
 	- you should have a consumer key (API Key), consumer secret (API secret), access token and access token secret to let your application authenticate and authorised for the twitter APIs
	
 - Once you create the basic page, you can run the default PHP server by running the command below:
 	- php -e -S localhost:8080 -t bigcommerce bigcommerce/index.php
	
 - To run the test, run the command "vendor/bin/phpunit"
