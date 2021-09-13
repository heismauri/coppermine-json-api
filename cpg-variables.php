<?php
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

// Get limit query
$limit = $_GET['limit'];

// Initialize the main JSON Array
$output = array();
$output['domain'] = substr_replace($domain, "", -1);;

// EOF
