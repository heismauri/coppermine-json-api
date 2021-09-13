<?php
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

// EOF
