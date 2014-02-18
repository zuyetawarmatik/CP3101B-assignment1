<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo __BASE_URL?>view/asset/css/task_edit.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="main-section">
			<div id="main-section-content">
				<form method="POST" action="<?php echo __BASE_URL?>task/edit">
					<?php if (isset($error)):?>
					<div id="error">
						<?php echo $error?>
					</div>
					<?php endif?>
					<input type="hidden" name="task_id" value="<?php echo $task_id ?>" />
					<table>
						<tr>
							<td>
								<label for="name">Name</label>
							</td>
							<td>
								<input type="text" name="name" value="<?php echo isset($name)?$name:'' ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="description">Description</label>
							</td>
							<td>
								<input type="text" name="description" value="<?php echo isset($description)?$description:'' ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="blocks">Number of 30-min blocks</label>
							</td>
							<td>
								<input type="text" name="blocks" value="<?php echo isset($blocks)?$blocks:'' ?>">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div>
									<a style="<?php if($current_block==0) echo 'display:none' ?>" class="button" href="<?php echo __BASE_URL . 'task/revertblock?task_id=' . $task_id ?>">Revert work unit</a>
									<input type="submit" value="Save">
								</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</section>
		<?php include('include/footer_section.inc'); ?>
	</body>
</html> 
