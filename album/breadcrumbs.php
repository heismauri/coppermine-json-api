<?php
// Query categories table
$categories_query = $db_connection->prepare(
	'SELECT p.cid, p.name FROM ' . $categories_table . ' c, ' . $categories_table . ' p
	WHERE c.lft
	BETWEEN p.lft
	AND p.rgt
	AND c.cid = ?
	ORDER BY p.lft'
);
$categories_query->bind_param('i', $main_category);
$categories_query->execute();
$categories_result = $categories_query->get_result();

// Process each result
while ($category = $categories_result->fetch_assoc()) {
	$breadcrumbs[] = $category['name'];
}

// Append breadcrumbs' array to the main JSON
$output['breadcrumbs'] = $breadcrumbs;

// EOF
