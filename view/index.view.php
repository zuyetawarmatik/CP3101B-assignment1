<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<link rel="stylesheet" type="text/css" href="./view/asset/font/Source_Sans_Pro/stylesheet.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/reset.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/shared.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/index.view.css">
		<title>Tasaka Managana</title>
	</head>
	<body>
		<section id="top-section">
			<div id="top-section-content">
				<div id="logo">
				</div>
				<nav id="nav-bar">
					<ul>
					<?php if ($login): ?>
						<li><a href="#">Tasks</a></li>
						<li><a href="#">Account</a></li>
						<li><a href="#">Logout</a></li>
					<?php else: ?>
						<li><a href="#">Login</a></li>
						<li><a href="#">About</a></li>
					<?php endif ?>
					</ul>
				</nav>
			</div>
		</section>
		<section id="intro-section">
			<h1>We are Tasaka Managana</h1>
			<p>Simply the best task manager in the world.</p>
		</section>
		<section id="main-section">
			<div id="main-section-content">
			</div>
		</section>
	</body>
</html> 