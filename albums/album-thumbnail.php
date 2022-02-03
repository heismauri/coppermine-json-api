<?php
// Select lasted uploaded picture
if ($thumb == 0) {
	$query = 'SELECT * FROM ' . $pictures_table . '
	WHERE aid = ' . $album_id . '
	AND approved = "YES"
	ORDER BY ctime DESC
	LIMIT 1';
// Select random picture
} elseif ($thumb == -1) {
	$query = 'SELECT * FROM ' . $pictures_table . '
	WHERE aid = ' . $album_id . '
	AND approved = "YES"
	ORDER BY RAND()
	LIMIT 1';
// Select an specific album picture thumbnail
} else {
	$query = 'SELECT * FROM ' . $pictures_table . '
	WHERE aid = ' . $album_id . '
	AND approved = "YES"
	AND pid = ' . $thumb . '
	LIMIT 1';
}

$thumb_query = $db_connection->query($query);
$thumb_row = $thumb_query->fetch_array();

// EOF
