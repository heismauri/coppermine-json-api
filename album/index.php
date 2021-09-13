<?php
// DB Connection
require_once '../db-connection.php';
// CPG Variables
require_once '../cpg-variables.php';

// Get album id
$id = $_GET['id'];

// Query albums & pictures tables
$albums_pictures_query = $db_connection->prepare(
	'SELECT p.filename, p.filepath, p.aid, p.pid, a.title, a.category FROM ' . $pictures_table . ' p
	JOIN ' . $albums_table . ' a ON p.aid = a.aid
	WHERE p.aid = ?
	AND visibility = 0
	AND approved = "YES"
	ORDER BY ctime DESC
	LIMIT ?'
);
$albums_pictures_query->bind_param('ii', $id, $limit);
$albums_pictures_query->execute();
$result = $albums_pictures_query->get_result();
$main_category = 0;

include '../pictures/picture-builder.php';
include 'breadcrumbs.php';

// Close the connection
$result->free_result();
$db_connection->close();

// Print the results
echo json_encode($output);

// EOF
