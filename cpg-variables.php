<?php
// Set table variables
$config_table = $CONFIG['TABLE_PREFIX'] . 'config';
$albums_table = $CONFIG['TABLE_PREFIX'] . 'albums';
$pictures_table = $CONFIG['TABLE_PREFIX'] . 'pictures';
$categories_table = $CONFIG['TABLE_PREFIX'] . 'categories';

// Get gallery domain
$domain_query = $db_connection->query(
	"SELECT * FROM {$config_table}
	WHERE name = 'ecards_more_pic_target'
	LIMIT 1"
);
$domain = $domain_query->fetch_assoc()['value'];

// Get limit query
$limit_param = isset($_GET['limit']) ? $_GET['limit'] : 8;
// Check if limit param is a number
if (strval($limit_param) !== strval(intval($limit_param))) {
	die("Limit should be a number");
}

// GET categories
$catogory_ids = $_GET['categories'];
$is_categories_set = isset($catogory_ids);
$categories_param = ($is_categories_set) ? "IN ({$catogory_ids})" : 'IS NOT NULL';
// Check if categories param contains only numbers
$catogory_ids_clean = str_replace(',', '', $catogory_ids);
if ($is_categories_set && strval($catogory_ids_clean) !== strval(intval($catogory_ids_clean))) {
	die("Categories should only contain numbers and commas");
}

// Initialize the main JSON Array
$output = array();
$output['domain'] = substr_replace($domain, '', -1);

// EOF
