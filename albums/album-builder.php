<?php
// Process each result
while ($row = $result->fetch_assoc()) {
	$album_id = $row['aid'];
	$thumb = $row['thumb'];
	// Get the correct thumbnail, because sometimes it does not match with the one on Coppermine
	include 'album-thumbnail.php';
	$album_data = array();
	$album_data['id'] = (int)$album_id;
	$album_data['title'] = $row['title'];
	$album_data['thumbnail_path'] = "/albums/{$thumb_row['filepath']}thumb_{$thumb_row['filename']}";
	$album_data['path'] = "/thumbnails.php?album={$album_id}";
	if ($is_category_ids_set) {
		$album_data['category_id'] = (int)$row['category'];
	}
	// Append each album to an array
	$albums[] = $album_data;
}

// Append all albums to the main JSON Array
$output['albums'] = $albums;

// EOF
