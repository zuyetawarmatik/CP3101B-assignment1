<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="0">
		<link rel="stylesheet" type="text/css" href="./view/asset/font/Source_Sans_Pro/stylesheet.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/font/Simple_Line_Icons/stylesheet.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/reset.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/shared.css">
		<link rel="stylesheet" type="text/css" href="./view/asset/css/index.view.css">
		<title>Tasaka Managana</title>
	</head>
	<body>
		<section id="top-section">
			<div id="top-section-content">			
				<div id="logo">
					Tasaka Managara&#8482;
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
			<h1>We are Tasaka Managara</h1>
			<p>Simply the best task manager in the world.</p>
		</section>
		<section id="main-section">
			<div id="main-section-content">
				<ul id="feature-list">
					<li>
						<a>
							<h1><i>&#57376;</i></h1>
							<h2>Fast Task Management</h2>
							<p>We maintain a high quality product and aim for consumer productivity.<br>You can create and manage tasks everywhere, everytime in just 1 click.</p>
						</a>
					</li>
					<li>
						<a>
							<h1><i>&#57350;</i></h1>
							<h2>A+ for Usability</h2>
							<p>We will never confuse you.<br>No need for a tutorial kickstart, you can jump straight at creating your schedule.</p>
						</a>
					</li>
					<li>
						<a>
							<h1><i>&#57386;</i></h1>
							<h2>Hey You, It's Free!</h2>
							<p>Free forever. As this is our freebie to the loved world.</p>
						</a>
					</li>
				</ul>
			</div>
		</section>
		<section id="footer-section">
			<div id="footer-section-content">
				<p>Created with love from Team Tasaka Managara. Copyright &#169; 2014.</p>
			</div>
		</section>
	</body>
</html> 