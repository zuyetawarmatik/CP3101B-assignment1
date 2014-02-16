<section id="top-section">
	<div id="top-section-content">
		<div id="logo"><a href="<?php echo __BASE_URL?>home/index">Tasaka Managara&#8482;</a></div>
		<nav id="nav-bar">
			<ul>
				<?php if (isset($_SESSION['login'])): ?>
				<li <?php if ($highlight == 'tasks') echo 'class="selected"' ?>><a href="<?php echo __BASE_URL . 'task/index'?>">Tasks</a></li>
				<li <?php if ($highlight == 'account') echo 'class="selected"' ?>><a href="<?php echo __BASE_URL . 'user/profile'?>">Account</a></li>
				<li><a href="<?php echo __BASE_URL . 'home/logout'?>">Logout</a></li>
				<?php else: ?>
				<li <?php if ($highlight == 'login') echo 'class="selected"' ?>><a href="<?php echo __BASE_URL?>home/login">Login</a></li>
				<li <?php if ($highlight == 'register') echo 'class="selected"' ?>><a href="<?php echo __BASE_URL?>home/register">Register</a></li>
				<?php endif ?>
				<li <?php if ($highlight == 'about') echo 'class="selected"' ?>><a href="<?php echo __BASE_URL?>home/about">About</a></li>
			</ul>
		</nav>
	</div>
</section>
