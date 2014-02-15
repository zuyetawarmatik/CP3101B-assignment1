<section id="top-section">
	<div id="top-section-content">
		<div id="logo"><a href="<?php echo __BASE_URL?>home/index">Tasaka Managara&#8482;</a></div>
		<nav id="nav-bar">
			<ul>
				<?php if (isset($_SESSION['login'])): ?>
				<li <?php if ($highlight == 'tasks') echo 'class="selected"' ?>><a href="#">Tasks</a></li>
				<li <?php if ($highlight == 'account') echo 'class="selected"' ?>><a href="#">Account</a></li>
				<li><a href="#">Logout</a></li>
				<?php else: ?>
<<<<<<< HEAD
				<li><a href="<?php echo __BASE_URL?>home/login">Login</a></li>
				<?php endif ?>
				<li><a href="<?php echo __BASE_URL?>home/about">About</a></li>
=======
				<li <?php if ($highlight == 'login') echo 'class="selected"' ?>><a href="../index/login">Login</a></li>
				<li <?php if ($highlight == 'register') echo 'class="selected"' ?>><a href="../index/register">Register</a></li>
				<?php endif ?>
				<li <?php if ($highlight == 'about') echo 'class="selected"' ?>><a href="../index/about">About</a></li>
>>>>>>> 4f1b561028d8b5d3093871daf310324e62584d2b
			</ul>
		</nav>
	</div>
</section>
