<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo __BASE_URL?>/view/asset/css/tasks.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="title-section">
			<h1><?php echo 'username' ?> To-do List</h1>
		</section>
		<section id="main-section">
			<div id="main-section-content">
				<ul id="tasks-list">
					<li>
						<h2>Task name</h2>
						<p>This is for task description</p>
						<form method='POST' action='/task/finish1block'>
							<input type="hidden" value="task_id">
							<ul class="task-blocks-list">
							<?php for ($i = 0; $i < 10; $i++):?>
								<li><button class="task-done-block" type="button"></button></li>
							<?php endfor;?>
								<li><button class="task-current-block" type="submit"></button></li>
							<?php for ($i = 0; $i < 5; $i++):?>
								<li><button class="task-undone-block" type="button"></button></li>
							<?php endfor;?>
							</ul>
						</form>
					</li>
					<li>
						<h2>Task name</h2>
						<p>This is for task description</p>
						<form method='POST' action='/task/finish1block'>
							<input type="hidden" value="task_id">
							<ul class="task-blocks-list">
							<?php for ($i = 0; $i < 10; $i++):?>
								<li><button class="task-done-block" type="button"></button></li>
							<?php endfor;?>
								<li><button class="task-current-block" type="submit"></button></li>
							<?php for ($i = 0; $i < 5; $i++):?>
								<li><button class="task-undone-block" type="button"></button></li>
							<?php endfor;?>
							</ul>
						</form>
					</li>
				</ul>
			</div>
		</section>
		<?php include('include/footer_section.inc'); ?>
	</body>
</html> 
