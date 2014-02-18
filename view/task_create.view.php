<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo __BASE_URL?>view/asset/css/task_create.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="main-section">
			<div id="main-section-content">
				<form method="POST" action="<?php echo __BASE_URL?>task/create">

					<?php if (isset($error)):?>
					<div id="error">
						<?php echo $error?>
					</div>
					<?php endif?>
					<table>
						<tr>
							<td>
								<label for="name">Name</label>
							</td>
							<td>
								<input type="text" name="name" value="<?php echo isset($taskname)?$taskname:"" ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="description">Description</label>
							</td>
							<td>
								<input type="text" name="description" value="<?php echo isset($description)?$description:"" ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="blocks">Number of 30-min blocks</label>
							</td>
							<td>
								<input type="text" name="blocks" value="<?php echo isset($blocks)?$blocks:"" ?>">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div>
									<input type="submit" value="Add new task">
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
