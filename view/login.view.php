<!DOCTYPE html>
<html lang="en-US">
	<head>
		<?php include('include/head.inc'); ?>
		<link rel="stylesheet" type="text/css" href="../view/asset/css/login.view.css" >
	</head>
	<body>
		<?php include('include/top_section.inc'); ?>
		<section id="main-section">
			<div id="main-section-content">
				<form method="POST" action="../index/login">
					<table>
						<tr>
							<td>
								<label for="username">Username</label>
							</td>
							<td>
								<input type="text">
							</td>
						</tr>
						<tr>
							<td>
								<label for="password">Password</label>
							</td>
							<td>
								<input type="password">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div>
									<a class="button">Register</a>
									<input type="submit" value="Login">
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