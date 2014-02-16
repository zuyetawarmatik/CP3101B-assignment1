<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="<?php echo __BASE_URL?>view/asset/css/register.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="main-section">
			<div id="main-section-content">
				<form method="POST" action="<?php echo __BASE_URL?>user/profile">
					<table>
						<tr>
							<td>
							<label for="username" >Username</label>
							</td>
							<td>
								<!-- TODO: Style readonly -->
								<input type="text" name="username"  readonly value="<?php echo $username?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="email">Email</label>
							</td>
							<td>
								<input type="email" name="email"  value="<?php echo $email?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for="oldpassword">Old Password</label>
							</td>
							<td>
								<input type="password" name="oldpassword" placeholder="leave blank to keep unchanged">
							</td>
						</tr>
						<tr>
							<td>
								<label for="newpassword">New Password</label>
							</td>
							<td>
								<input type="password" name="newpassword" placeholder="">
							</td>
						</tr>
						<tr>
							<td>
								<label for="retype_password">Retype new password</label>
							</td>
							<td>
								<input type="password" name="retype_password">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div>
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
