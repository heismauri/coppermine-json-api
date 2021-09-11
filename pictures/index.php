<?php
// DB Connection and variables
require_once '../db-connection.php';

// Get limit query
$limit = $_GET['limit'];

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.filename, p.filepath, p.aid, p.pid, a.title FROM ' . $pictures_table . ' p
	JOIN ' . $albums_table . ' a ON p.aid = a.aid
	ORDER BY ctime DESC
	LIMIT ?'
);
$albums_pictures_query->bind_param('i', $limit);
$albums_pictures_query->execute();
$result = $albums_pictures_query->get_result();

// Process each result
while ($row = $result->fetch_assoc()) {
	$picture_data = array();
	$picture_data['id'] = (int)$row['pid'];
	$picture_data['album_id'] = $row['aid'];
	$picture_data['title'] = $row['title'];
	$picture_data['thumbnail'] = 'albums/' . $row['filepath'] . 'thumb_' . $row['filename'];
	// Append each album to an array
	$pictures[] = $picture_data;
}

// Append each album to the main object
$output['pictures'] = $pictures;
$output['domain'] = $domain;

// Close the connection
$result->free_result();
$db_connection->close();

// Print the results
echo json_encode($output);

// EOF
