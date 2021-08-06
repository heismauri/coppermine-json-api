<?php
// Allow access from other websites, not needed if only used on the main site
header('Access-Control-Allow-Origin: *');

// Display the content as JSON
header('Content-Type: application/json');

// Require Coppermine config file
require_once 'include/config.inc.php';

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

// Get limit query
$limit = $_GET['limit'];

// Get albums & pictures table
$albums_table = $CONFIG['TABLE_PREFIX'] . 'albums';
$pictures_table = $CONFIG['TABLE_PREFIX'] . 'pictures';

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.aid, a.title FROM ' . $pictures_table . ' p
	JOIN ' . $albums_table . ' a ON p.aid = a.aid
	GROUP BY p.aid
	ORDER BY MAX(ctime)
	DESC LIMIT ?'
);
$albums_pictures_query->bind_param('i', $limit);
$albums_pictures_query->execute();
$result = $albums_pictures_query->get_result();

// Process each album
while ($row = $result->fetch_assoc()) {
	$album_id = $row['aid'];
	// Get the correct thumbnail, because sometimes it does not match with the one on Coppermine
	$thumb_query = $db_connection->query(
		'SELECT * FROM ' . $pictures_table . '
		WHERE aid = ' . $album_id . '
		ORDER BY ctime
		DESC LIMIT 1'
	);
	$thumb_row = $thumb_query->fetch_array();
	$album_data = array();
	$album_data['id'] = $album_id;
	$album_data['title'] = $row['title'];
	$album_data['thumbnail'] = $domain . '/albums/' . $thumb_row['filepath'] . 'thumb_' . $thumb_row['filename'];
	// Append each album to an array
	$albums[] = $album_data;
}

$output['albums'] = $albums;
$output['domain'] = $domain;

// Print the results
echo json_encode($output);

$result->free_result();
$db_connection->close();

// EOF
