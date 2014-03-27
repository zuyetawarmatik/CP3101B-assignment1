<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	status(200);
	print '{}';
}
?>
