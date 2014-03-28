<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$_SESSION['login'] = null;
	status(200);
	print '{}';
}
?>
