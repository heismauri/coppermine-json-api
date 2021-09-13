<?php
// DB Connection
require_once '../db-connection.php';
// CPG Variables
require_once '../cpg-variables.php';

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.aid, a.title FROM ' . $pictures_table . ' p
	JOIN ' . $albums_table . ' a ON p.aid = a.aid
	WHERE visibility = 0
	AND approved = "YES"
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
		AND approved = "YES"
		ORDER BY ctime DESC
		LIMIT 1'
	);
	$thumb_row = $thumb_query->fetch_array();
	$album_data = array();
	$album_data['id'] = (int)$album_id;
	$album_data['title'] = $row['title'];
	$album_data['thumbnail'] = '/albums/' . $thumb_row['filepath'] . 'thumb_' . $thumb_row['filename'];
	$album_data['url'] = '/thumbnails.php?album=' . $album_id;
	// Append each album to an array
	$albums[] = $album_data;
}

// Append all albums to the main JSON Array
$output['albums'] = $albums;

// Close the connection
$result->free_result();
$db_connection->close();

// Print the results
echo json_encode($output);

// EOF
