<?php
// DB Connection
require_once '../db-connection.php';
// CPG Variables
require_once '../cpg-variables.php';

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.aid, a.title, a.thumb FROM ' . $pictures_table . ' p
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

// Build albums' JSON
include 'album-builder.php';

// Close the connection
$result->free_result();
$db_connection->close();

// Print the results
echo json_encode($output);

// EOF
