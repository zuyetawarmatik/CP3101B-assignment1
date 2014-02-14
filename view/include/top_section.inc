<section id="top-section">
	<div id="top-section-content">
		<div id="logo"><a href="../index/index">Tasaka Managara&#8482;</a></div>
		<nav id="nav-bar">
			<ul>
				<?php if ($_SESSION['login']): ?>
				<li><a href="#">Tasks</a></li>
				<li><a href="#">Account</a></li>
				<li><a href="#">Logout</a></li>
				<?php else: ?>
				<li><a href="../index/login">Login</a></li>
				<?php endif ?>
				<li><a href="#">About</a></li>
			</ul>
		</nav>
	</div>
</section>
