<?php
// DB Connection and variables
require_once '../db-connection.php';

// Get limit query
$limit = $_GET['limit'];

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.aid, a.title FROM ' . $pictures_table . ' p
	JOIN ' . $albums_table . ' a ON p.aid = a.aid
	GROUP BY p.aid
	ORDER BY MAX(ctime) DESC
	LIMIT ?'
);
$albums_pictures_query->bind_param('i', $limit);
$albums_pictures_query->execute();
$result = $albums_pictures_query->get_result();

// Process each result
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
	$album_data['thumbnail'] = 'albums/' . $thumb_row['filepath'] . 'thumb_' . $thumb_row['filename'];
	// Append each album to an array
	$albums[] = $album_data;
}

// Append each album to the main object
$output['albums'] = $albums;
$output['domain'] = $domain;

// Close the connection
$result->free_result();
$db_connection->close();

// Print the results
echo json_encode($output);

// EOF
