<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo __BASE_URL?>view/asset/css/tasks.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="title-section">
			<div id="title-section-content">
				<div id="title-box">

					<!-- TODO: css to highlight username -->
					<h1><?php echo $username ?>'s to-do list</h1>
				</div>
				<div id="btn-box">
					<a class="button" href='<?php echo __BASE_URL?>task/create'>Add new task</a>
				</div>
			</div>
		</section>
		<section id="main-section">
			<div id="main-section-content">
				<ul id="tasks-list">
				<?php
					foreach ($tasks as $task) {
				?>
					<li>
					<h2><?php echo $task->name ?></h2>
					<p><?php echo $task->description ?></p>
					<form method='POST' action='<?php echo __BASE_URL ?>task/nextblock'>
						<input type="hidden" name="task_id" value="<?php echo $task->id?>">
							<ul class="task-blocks-list">
							<?php for ($i = 0; $i < $task->blocks; $i++):?>
								<?php if ($i<$task->current_block): ?>
									<li><button class="task-done-block" type="button"></button></li>
								<?php elseif ($i==$task->current_block): ?>
									<li><button class="task-current-block" type="submit"></button></li>
								<?php else: ?>
									<li><button class="task-undone-block" type="button"></button></li>
								<?php endif;?>
							<?php endfor;?>
							</ul>
						</form>
					</li>
				<?php
					}
				?>
			<!-- 		<li> -->
			<!-- 			<h2>Task name</h2> -->
			<!-- 			<p>This is for task description<br>Start from: Insert datetime here</p> -->
			<!-- 			<form method='POST' action='/task/finish1block'> -->
			<!-- 				<input type="hidden" value="task_id"> -->
			<!-- 				<ul class="task&#45;blocks&#45;list"> -->
			<!-- 				<?php for ($i = 0; $i < 10; $i++):?> -->
			<!-- 					<li><button class="task&#45;done&#45;block" type="button"></button></li> -->
			<!-- 				<?php endfor;?> -->
			<!-- 					<li><button class="task&#45;current&#45;block" type="submit"></button></li> -->
			<!-- 				<?php for ($i = 0; $i < 5; $i++):?> -->
			<!-- 					<li><button class="task&#45;undone&#45;block" type="button"></button></li> -->
			<!-- 				<?php endfor;?> -->
			<!-- 				</ul> -->
			<!-- 			</form> -->
			<!-- 		</li> -->
			<!-- 	</ul> -->
			<!-- </div> -->
		</section>
		<?php include('include/footer_section.inc'); ?>
	</body>
</html> 
