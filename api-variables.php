<?php
// Allow access from other websites, not needed if only used on the main site
header('Access-Control-Allow-Origin: *');

// Display the content as JSON
header('Content-Type: application/json');

// Initialize the main JSON Array
$output = array();

// Get limit query
$limit_param = isset($_GET['limit']) ? $_GET['limit'] : 8;
// Check if limit param is a number
if (strval($limit_param) !== strval(intval($limit_param))) {
	die('Limit should be a number');
}

// Get categories query
$catogory_ids = $_GET['categories'];
$is_category_ids_set = isset($catogory_ids);
$category_ids_param = ($is_category_ids_set) ? "IN ({$catogory_ids})" : 'IS NOT NULL';
// Check if categories param contains only numbers
$catogory_ids_clean = str_replace(',', '', $catogory_ids);
if ($is_category_ids_set && strval($catogory_ids_clean) !== strval(intval($catogory_ids_clean))) {
	die('Categories should only contain numbers and commas');
}

// Get album id query
$album_id_param = $_GET['id'];
$is_album_id_set = isset($album_id_param);
// Check if album id param is a number
if ($is_album_id_set && strval($album_id_param) !== strval(intval($album_id_param))) {
	die('Album ID should be a number');
}

// EOF
