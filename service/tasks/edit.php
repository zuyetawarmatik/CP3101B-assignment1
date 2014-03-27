<?php
include '../include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	status(200);
	print json_encode(array(
				"id" => 1,
				"description" => "buy milk",
				"num_blocks" => 30
			)
	);
}
?>
