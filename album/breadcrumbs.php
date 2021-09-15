<?php
// Query categories table
$categories_result = $db_connection->query(
	'SELECT p.cid, p.name FROM ' . $categories_table . ' c, ' . $categories_table . ' p
	WHERE c.lft
	BETWEEN p.lft
	AND p.rgt
	AND c.cid = ' . $main_category . '
	ORDER BY p.lft'
);

// Process each result
while ($category = $categories_result->fetch_assoc()) {
	$category_data = array();
	$category_data['id'] = (int)$category['cid'];
	$category_data['name'] = $category['name'];
	$category_data['path'] = '/galeria/index.php?cat=' . $category['cid'];
	$breadcrumbs[] = $category_data;
}

// Append breadcrumbs' array to the main JSON
$output['breadcrumbs'] = $breadcrumbs;

// EOF
