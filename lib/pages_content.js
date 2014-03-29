var GENERAL_PAGE = "GENERAL_PAGE";
var LOGGED_IN_PAGE = "LOGGED_IN_PAGE";
var LOGGED_OUT_PAGE = "LOGGED_OUT_PAGE";

var pagesContent = {
	index: {
		title: "Tasaka Managara",
		extraContent: "<section id='intro-section'>\
							<h1>We are Tasaka Managara</h1>\
							<p>Simply the best task manager in the world.</p>\
						</section>",
		mainContent: "<ul id='feature-list'>\
							<li>\
								<a>\
									<h1><i>&#57376;</i></h1>\
									<h2>Fast Task Management</h2>\
									<p>We maintain a high quality product and aim for consumer productivity.<br>You can create and manage tasks everywhere, everytime in just 1 click.</p>\
								</a>\
							</li>\
							<li>\
								<a>\
									<h1><i>&#57350;</i></h1>\
									<h2>A+ for Usability</h2>\
									<p>We will never confuse you.<br>No need for a tutorial kickstart, you can jump straight at creating your schedule.</p>\
								</a>\
							</li>\
							<li>\
								<a>\
									<h1><i>&#57386;</i></h1>\
									<h2>Hey You, It's Free!</h2>\
									<p>Free forever. As this is our freebie to the loved world.</p>\
								</a>\
							</li>\
						</ul>",
		type: GENERAL_PAGE
	},
	login: {
		title: "Login",
		mainContent: "<form method='POST' action='service/login.php' id='login-form'>\
							<table>\
								<tr>\
									<td>\
										<label for='username'>Username</label>\
									</td>\
									<td>\
										<input type='text' name='username'>\
									</td>\
									</tr>\
								<tr>\
									<td>\
										<label for='password'>Password</label>\
									</td>\
									<td>\
										<input type='password' name='password'>\
									</td>\
								</tr>\
								<tr>\
									<td colspan='2'>\
										<div>\
											<a class='button' data-to='register' href=''>Register</a>\
											<input type='submit' value='Login'>\
										</div>\
									</td>\
								</tr>\
							</table>\
						</form>",
		highlightMenu: "login",
		type: LOGGED_OUT_PAGE
	},
	register: {
		title: "Register",
		mainContent: "<form method='POST' action='service/signup.php' id='register-form'>\
							<table>\
								<tr>\
									<td>\
										<label for='username'>Username</label>\
									</td>\
									<td>\
										<input type='text' name='username'>\
									</td>\
								</tr>\
								<tr>\
									<td>\
										<label for='email'>Email</label>\
									</td>\
									<td>\
										<input type='email' name='email'>\
									</td>\
								</tr>\
								<tr>\
									<td>\
										<label for='password'>Password</label>\
									</td>\
									<td>\
										<input type='password' name='password'>\
									</td>\
								</tr>\
								<tr>\
									<td>\
										<label for='retype_password'>Retype password</label>\
									</td>\
									<td>\
										<input type='password' name='retype_password'>\
									</td>\
								</tr>\
								<tr>\
									<td colspan='2'>\
										<div>\
											<input type='submit' value='Register'>\
										</div>\
									</td>\
								</tr>\
							</table>\
						</form>",
		highlightMenu: "register",
		type: LOGGED_OUT_PAGE
	},
	about: {
		title: "About",
		mainContent: "<h1>Created by</h1>\
						<ul id='creator-list'>\
							<li>\
								<a>\
									<div class='avatar'>\
		   								<span><img src='assets/img/zuyetawarmatik.jpg' alt='avatar' /></span>\
									</div>\
									<h2>Bui Phuc Duyet</h2>\
									<p>zuyetawarmatik@github</p>\
								</a>\
							</li>\
							<li>\
								<a>\
									<div class='avatar'>\
		   								<span><img src='assets/img/naviehuynh.jpg' alt='avatar' /></span>\
									</div>\
									<h2>Huynh Van Quang</h2>\
									<p>naviehuynh@github</p>\
								</a>\
							</li>\
						</ul>",
		highlightMenu: "about",
		type: GENERAL_PAGE
	},
	profile: {
		title: "Profile",
		mainContent: "<form method='POST' action='service/profile.php' id='profile-form'>\
						<table>\
							<tr>\
								<td>\
									<label for='username'>Username</label>\
								</td>\
								<td>\
									<input type='text' name='username' readonly autocomplete='off'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='email'>Email</label>\
								</td>\
								<td>\
									<input type='email' name='email' autocomplete='off'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='oldpassword'>Old Password</label>\
								</td>\
								<td>\
									<input type='password' name='oldpassword' placeholder='leave blank to keep unchanged' autocomplete='off'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='newpassword'>New Password</label>\
								</td>\
								<td>\
									<input type='password' name='newpassword' autocomplete='off'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='retype_password'>Retype new password</label>\
								</td>\
								<td>\
									<input type='password' name='retype_password' autocomplete='off'>\
								</td>\
							</tr>\
							<tr>\
								<td colspan='2'>\
									<div>\
										<input type='submit' value='Save'>\
									</div>\
								</td>\
							</tr>\
						</table>\
					</form>",
		highlightMenu: "profile",
		callbackFunc: "loadProfile",
		type: LOGGED_IN_PAGE
	},
	tasks: {
		title: "Tasks",
		extraContent: "<section id='title-section'>\
							<div id='title-section-content'>\
								<div id='title-box'>\
									<h1><span style='font-weight: 700'></span> to-do list</h1>\
								</div>\
								<div id='btn-box'>\
									<a class='button' href='' data-to='task_add'>Add new task</a>\
								</div>\
							</div>\
						</section>",
		mainContent: "<ul id='tasks-list'></ul>",
		callbackFunc: "loadTasks",
		highlightMenu: "tasks",
		type: LOGGED_IN_PAGE
	},
	task_add: {
		title: "Add a New Task",
		mainContent: "<form method='POST' action='service/task/add.php' id='task-add-form'>\
						<table>\
							<tr>\
								<td>\
									<label for='name'>Name</label>\
								</td>\
								<td>\
									<input type='text' name='name'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='description'>Description</label>\
								</td>\
								<td>\
									<input type='text' name='description'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='blocks'>Number of 30-min blocks</label>\
								</td>\
								<td>\
									<input type='text' name='blocks'>\
								</td>\
							</tr>\
							<tr>\
								<td colspan='2'>\
									<div>\
										<input type='submit' value='Add new task'>\
									</div>\
								</td>\
							</tr>\
						</table>\
					</form>",
		highlightMenu: "tasks",
		type: LOGGED_IN_PAGE
	},
	task_edit: {
		title: "Edit Task",
		mainContent: "<form method='POST' action='service/task/edit.php'>\
						<table>\
							<tr>\
								<td>\
									<label for='name'>Name</label>\
								</td>\
								<td>\
									<input type='text' name='name'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='description'>Description</label>\
								</td>\
								<td>\
									<input type='text' name='description'>\
								</td>\
							</tr>\
							<tr>\
								<td>\
									<label for='blocks'>Number of 30-min blocks</label>\
								</td>\
								<td>\
									<input type='text' name='blocks'>\
								</td>\
							</tr>\
							<tr>\
								<td colspan='2'>\
									<div>\
										<a class='button' href=''>Revert work unit</a>\
										<input type='submit' value='Save'>\
									</div>\
								</td>\
							</tr>\
						</table>\
					</form>",
		highlightMenu: "tasks",
		type: LOGGED_IN_PAGE
	},
	error: {
		id: "error",
		title: "Error",
		mainContent: "<h1>Sorry, the page does not exist<br>or you haven't logged in yet.</h1>",
		type: GENERAL_PAGE
	}
}