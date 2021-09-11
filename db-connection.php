<?php
// Allow access from other websites, not needed if only used on the main site
header('Access-Control-Allow-Origin: *');

// Display the content as JSON
header('Content-Type: application/json');

// Require Coppermine config file
require_once '../include/config.inc.php';

// Your gallery domain
$domain = 'https://yourdomain.com/gallery';

// Connect to the server
$db_connection = new mysqli(
	$CONFIG['dbserver'],
	$CONFIG['dbuser'],
	$CONFIG['dbpass']
);
// Check if there was any error while connecting to the server
if ($db_connection->connect_error) {
	die('Connection failed: ' . $db_connection->connect_error);
}

// Select Coppermine's database
$db_connection->select_db($CONFIG['dbname']);

// Set table variables
$config_table = $CONFIG['TABLE_PREFIX'] . 'config';
$albums_table = $CONFIG['TABLE_PREFIX'] . 'albums';
$pictures_table = $CONFIG['TABLE_PREFIX'] . 'pictures';
$categories_table = $CONFIG['TABLE_PREFIX'] . 'categories';

// Get gallery domain
$domain_query = $db_connection->query(
	'SELECT * FROM ' . $config_table . '
	WHERE name = "ecards_more_pic_target"
	LIMIT 1'
);
$domain = $domain_query->fetch_assoc()['value'];

// EOF
