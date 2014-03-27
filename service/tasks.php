<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	status(200);
	print json_encode(array(
		"tasks" => array(
			array(
				"id" => 1,
				"description" => "buy milk",
				"num_blocks" => 30,
			),
			array(
				"id" => 2,
				"description" => "buy eggs",
				"num_blocks" => 10,
			)
		)
	));
}
?>
