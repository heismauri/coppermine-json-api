<?php
// Process each result
while ($row = $result->fetch_assoc()) {
	$picture_data = array();
	$picture_data['id'] = (int)$row['pid'];
	if (isset($main_category)) {
		$output['path'] = '/thumbnails.php?album=' . $row['aid'];
		$output['title'] = $row['title'];
		$main_category = $row['category'];
	} else {
		$picture_data['album_title'] = $row['title'];
	}
	$picture_data['thumbnail_path'] = '/albums/' . $row['filepath'] . 'thumb_' . $row['filename'];
	$picture_data['path'] = '/displayimage.php?album=' . $row['aid'] . '&pid=' . $row['pid'];
	// Append each picture to an array
	$pictures[] = $picture_data;
}
// Append all pictures to the main JSON Array
$output['pictures'] = $pictures;

// EOF
