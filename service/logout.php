<?php
include 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$_SESSION['login'] = null;
	status(200);
	print '{}';
}
?>
