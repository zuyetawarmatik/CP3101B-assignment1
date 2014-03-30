if (window.location.protocol != "https:"){
	debugger;
	window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
}

var username = "";

function escapeHTMLTag(str) {
	return $("<p>" + str + "</p>").text();
}

function escapeHTMLTagForMap(map) {
	var ret = {};
	$.each(map, function(k, v) {
		ret[k] = escapeHTMLTag(v);
	});
	return ret;
}

/* The four main functions used when loading or going back to a page */
$(window).on('hashchange', handleURLWithHash);

function loadPagesContentData() {
	$.getScript("lib/pages_content.js", handleURLWithHash);
}

function handleURLWithHash() {
	var hash = encodeURI(location.hash).substr(1);
	
	// hash.split[0] is the page id, hash.split[1] is the optional param
	if (hash != "") {
		var arr = hash.split("/", 2);
		var pID = arr[0];
		if (pagesContent[pID] !== undefined)
			changePage(arr);
		else
			changePage(["error"], false);
	} else changePage(["index"], false);
}

/* isLoad = true: pushing a new history state 
 * isLoad = false: for refresh, back or redirect, no new history state is pushed
 */
function changePage(pageURLArr, isLoad) {
	if (isLoad === undefined)
		isLoad = !(history.state !== undefined && history.state != null && history.state.pageURLArr[0] == pageURLArr[0]);
	
	var pageId = pageURLArr[0];
	var pageContent = $.extend(true, {}, pagesContent[pageId]);
	
	// Determine login state by sending a request to service/me.php
	var loginState;
	$.ajax({
		url: "service/me.php",
		type: "GET",
		success: function(response){
			loginState = true;
			username = response.username;
		},
		error: function() {
			loginState = false;
			username = "";
		},
		complete: function() {
			// Check validity of the page
			var isValidPage = !((loginState && pageContent.type == LOGGED_OUT_PAGE) || (!loginState && pageContent.type == LOGGED_IN_PAGE));
			
			if (isValidPage) {
				/* Render the page if valid */
				
				// Change menu: render and highlight
				if (!loginState)
					$("#nav-bar").html("<ul>\
											<li><a href='' data-to='login'>Login</a></li>\
											<li><a href='' data-to='register'>Register</a></li>\
										</ul>");
				else
					$("#nav-bar").html("<ul>\
											<li><a href='' data-to='tasks'>Tasks</a></li>\
											<li><a href='' data-to='profile'>Profile</a></li>\
											<li><a href='' id='logout-btn'>Logout</a></li>\
										</ul>");
				$a = $("#nav-bar li a[data-to='" + pageContent.highlightMenu + "']");
				$a.parent().addClass("selected");
				
				// Change page title
				$("title").html(pageContent.title);
				
				// Remove old extra content
				$("#intro-section").remove();
				$("#title-section").remove();
				// Add extra content if available
				if (pageContent.extraContent !== undefined)
					$(pageContent.extraContent).insertBefore("#main-section");
				
				// Change main content
				$("#main-section-content").html(pageContent.mainContent);
				
				// Change main content's page id
				$("#main-section").attr("data-page", pageId);
				
				// Callback function for page if available, with param
				if (pageContent.callbackFunc !== undefined)
					window[pageContent.callbackFunc](pageURLArr[1]);
				
				// Push to history if this is loading a new page
				var pageLink = "#" + pageId;
				if (pageURLArr.length == 2) pageLink += ("/" + pageURLArr[1]);
				if (isLoad)
					history.pushState({pageURLArr: pageURLArr}, null, pageLink);
				else
					history.replaceState({pageURLArr: pageURLArr}, null, pageLink);
				
			} else {
				/* Redirect to appropriate page */
				if (loginState)
					changePage(["tasks"], false);
				else
					changePage(["login"], false); // If unauthorized, require to login
			}
		}
	});	
}
/* ============================ */

/* Specific page's extra function */
function loadTasks(param) {
	// Get all tasks
	$("#title-box h1 span").html(username + "'s");
	$.ajax({
		url: "service/tasks.php",
		type: "GET",
		success: function(response) {
			$.each(response, function(i, task){
				var $taskLi = $("<li data-task-id='" + task.id + "'>\
									<a href='' data-to='task_edit/" + task.id + "'><h2>" + task.name + "</h2></a>\
									<button class='task-del-btn' type='button'>&#57474;</button>\
									<p>" + task.description + "</p>\
									<p class='task-estimation'>" + task.estimation + "</p>\
										<ul class='task-blocks-list'></ul>\
								</li>");
				var $taskBlocksList = $taskLi.find(".task-blocks-list");
				for (var i = 0; i < task.current_block; i++)
					$taskBlocksList.append("<li><button class='task-done-block'></button></li>");
				if (task.current_block < task.blocks)
					$taskBlocksList.append("<li><button class='task-current-block'></button></li>");
				for (var i = task.current_block + 1; i < task.blocks; i++)
					$taskBlocksList.append("<li><button class='task-undone-block'></button></li>");
				
				$taskLi.appendTo("#tasks-list");
			});
			
			// Scroll to the specific task
			if (param !== undefined) {
				var minTop = $("#top-section").height() + $("#title-section").height();
				$('html, body').animate({
					scrollTop: $("#tasks-list>li[data-task-id='" + param + "']").offset().top - minTop
				}, 1000);
				$("#tasks-list>li.focused").removeClass("focused");
				$("#tasks-list>li[data-task-id='" + param + "']").addClass("focused");
			}
		}
	});
	
	getUserStatistic();
}

function getUserStatistic() {
	// Get user statistic
	$.ajax({
		url: "service/task/statistic.php",
		type: "GET",
		success: function(response) {
			$("#statistic").html(response.estimation);
		}
	});
}

function loadProfile() {
	$.ajax({
		url: "service/profile.php",
		type: "GET",
		success: function(response) {
			$("#profile-form").data("user-id", response.id);
			$("[name='username']").val(response.username);
			$("[name='email']").val(response.email);
		}
	});
}

function loadTask(param) {
	$.ajax({
		url: "service/task/details.php?id=" + param,
		type: "GET",
		success: function(response) {
			$("#task-edit-form").data("task-id", response.id);
			$("[name='name']").val(response.name);
			$("[name='description']").val(response.description);
			$("[name='blocks']").val(response.blocks);
			if (response.current_block == 0) $("#task-revert-btn").remove();
		}
	});
}

/* Ajax Form Functions */
function loginForm_submit(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		username: $("[name='username']", this).val(),
		password: $("[name='password']", this).val(),
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: this.action,
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#error").remove();
		},
		success: function(response) {
			$("<div id='success' style='display:none'>Login successfully. Redirecting...</div>").prependTo("#login-form");
			$("#success").slideDown(500);
			
			// Redirect to Tasks page
			setTimeout(function(){
				changePage(["tasks"]);
			}, 1000);
		},
		error: function(response) {
			var errorText = "";
			for (var i = 0; i < response.responseJSON.error.length; i++)
				errorText += response.responseJSON.error[i] + "<br>";
			$("<div id='error' style='display:none'>" + errorText + "</div>").prependTo("#login-form");
			$("#error").slideDown(500);
		}
	});
}

function registerForm_submit(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		username: $("[name='username']", this).val(),
		email: $("[name='email']", this).val(),
		password: $("[name='password']", this).val(),
		retype_password: $("[name='retype_password']", this).val(),
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: this.action,
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#error").remove();
		},
		success: function(response) {
			$("<div id='success' style='display:none'>Register successfully. Redirecting...</div>").prependTo("#register-form");
			$("#success").slideDown(500);
			
			// Redirect to Login page
			setTimeout(function(){
				changePage(["login"]);
			}, 1000);
		},
		error: function(response) {
			var errorText = "";
			for (var i = 0; i < response.responseJSON.error.length; i++)
				errorText += response.responseJSON.error[i] + "<br>";
			$("<div id='error' style='display:none'>" + errorText + "</div>").prependTo("#register-form");
			$("#error").slideDown(500);
		}
	});
}

function profileForm_submit(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		email: $("[name='email']", this).val(),
		oldpassword: $("[name='oldpassword']", this).val(),
		newpassword: $("[name='newpassword']", this).val(),
		retype_password: $("[name='retype_password']", this).val(),
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: this.action,
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#error").remove();
		},
		success: function(response) {
			$("<div id='success' style='display:none'>Changing profile successfully</div>").prependTo("#profile-form");
			$("#success").slideDown(500);
			
			setTimeout(function(){
				$("#success").slideUp(500);
			}, 1000);
		},
		error: function(response) {
			var errorText = "";
			for (var i = 0; i < response.responseJSON.error.length; i++)
				errorText += response.responseJSON.error[i] + "<br>";
			$("<div id='error' style='display:none'>" + errorText + "</div>").prependTo("#profile-form");
			$("#error").slideDown(500);
		}
	});
}

function taskAddForm_submit(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		name: $("[name='name']", this).val(),
		description: $("[name='description']", this).val(),
		blocks: $("[name='blocks']", this).val()
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: this.action,
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#error").remove();
		},
		success: function(response) {
			$("<div id='success' style='display:none'>Adding a new task successfully. Redirecting...</div>").prependTo("#task-add-form");
			$("#success").slideDown(500);
			
			// Redirect to Tasks page
			setTimeout(function(){
				changePage(["tasks", response.id]);
			}, 1000);
		},
		error: function(response) {
			var errorText = "";
			for (var i = 0; i < response.responseJSON.error.length; i++)
				errorText += response.responseJSON.error[i] + "<br>";
			$("<div id='error' style='display:none'>" + errorText + "</div>").prependTo("#task-add-form");
			$("#error").slideDown(500);
		}
	});
}

function taskEditForm_submit(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		id: $(this).data("task-id"),
		name: $("[name='name']", this).val(),
		description: $("[name='description']", this).val(),
		blocks: $("[name='blocks']", this).val()
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: this.action,
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#error").remove();
		},
		success: function(response) {
			$("<div id='success' style='display:none'>Editing task successfully. Redirecting...</div>").prependTo("#task-edit-form");
			$("#success").slideDown(500);
			
			// Redirect to Tasks page
			setTimeout(function(){
				changePage(["tasks", response.id]);
			}, 1000);
		},
		error: function(response) {
			var errorText = "";
			for (var i = 0; i < response.responseJSON.error.length; i++)
				errorText += response.responseJSON.error[i] + "<br>";
			$("<div id='error' style='display:none'>" + errorText + "</div>").prependTo("#task-edit-form");
			$("#error").slideDown(500);
		}
	});
}

function taskDelBtn_click(e) {
	var requestJSON = escapeHTMLTagForMap({
		id: $(this).parent().data("task-id")
	});
	$thisLi = $(this).parent();
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: "service/task/delete.php",
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function(){
			$(".success-dialog").remove();
			$(".error-dialog").remove();
		},
		success: function(response) {
			getUserStatistic();
			$("<div class='success-dialog' style='display:none'>Deleting task successfully</div>").prependTo("body");
			$(".success-dialog").slideDown(500);
			setTimeout(function(){
				$(".success-dialog").slideUp(700);
				$thisLi.slideUp(700);
			}, 700);
		},
		error: function(response) {
			$("<div class='error-dialog' style='display:none'>Deleting task failed</div>").prependTo("body");
			$(".error-dialog").slideDown(500);
			setTimeout(function(){
				$(".error-dialog").slideUp(500);
			}, 1000);
		}
	});
}

function taskRevertBtn_click(e) {
	e.preventDefault();
	var requestJSON = escapeHTMLTagForMap({
		id: $("#task-edit-form").data("task-id"),
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: "service/task/revert.php",
		type: "POST",
		data: JSON.stringify(requestJSON),
		beforeSend: function() {
			$("#success").remove();
			$("#error").remove();
		},
		success: function(response) {
			if (response.current_block == 0) $("#task-revert-btn").remove();
			$("<div id='success' style='display:none'>Current done blocks reverted to " + response.current_block + "</div>").prependTo("#task-edit-form");
			$("#success").slideDown(500);
			
			setTimeout(function(){
				$("#success").slideUp(500);
			}, 1000);
		}, 
		error: function(response) {
			$("<div id='error' style='display:none'>Reverting failed</div>").prependTo("#task-edit-form");
			$("#error").slideDown(500);
			
			setTimeout(function(){
				$("#error").slideUp(500);
			}, 1000);
		}
	});
}

function taskCurrentBlock_click() {
	$this = $(this);
	$thisLi = $(this).closest("#tasks-list > li");
	var requestJSON = escapeHTMLTagForMap({
		id: $thisLi.data("task-id"),
	});
	$.ajax({
		contentType: "application/json; charset=utf-8",
		url: "service/task/nextblock.php",
		type: "POST",
		data: JSON.stringify(requestJSON),
		success: function(response) {
			getUserStatistic();
			$this.removeClass("task-current-block").addClass("task-done-block");
			$this.parent().next().find("button").removeClass("task-undone-block").addClass("task-current-block");
			
			// Fix the estimation
			$.ajax({
				url: "service/task/details.php?id=" + $thisLi.data("task-id"),
				type: "GET",
				success: function(response) {
					$(".task-estimation", $thisLi).html(response.estimation);
				}
			});
		}
	});
}

function logoutBtn_click(e) {
	e.preventDefault();
	$.ajax({
		url: "service/logout.php",
		type: "POST",
		success: function(response) {
			// Redirect to Index page
			changePage(["index"]);
		}
	});
}

/* UI Event Functions */
function a_click(e) {
	e.preventDefault();
	if ($(this).attr("href") == "" && $(this).data("to") !== undefined) {
		changePage($(this).data("to").split("/", 2));	
	} else if ($(this).attr("href") !== undefined && $(this).attr("href") != "")
		location.href = $(this).attr("href");
}

function taskLi_mouseEnter() {
	$("#tasks-list>li.focused").removeClass("focused");
	$(this).addClass("focused");
}

// Search function
function search_Enter(e) {
	var keycode = (e.keyCode ? e.keyCode : e.which);
	if (keycode == '13') {
		var searchVal = $(this).val().toLowerCase();
		$("#tasks-list > li a h2").each(function() {
			if ($(this).html().toLowerCase().indexOf(searchVal) >= 0) {
				var minTop = $("#top-section").height() + $("#title-section").height();
				$thisLi = $(this).closest("li");
				$('html, body').animate({
					scrollTop: $thisLi.offset().top - minTop
				}, 1000);
				$("#tasks-list>li.focused").removeClass("focused");
				$thisLi.addClass("focused");
				return false;
			}
		});
	} else if (keycode == 27) {
		$(this).blur();
	}
}
// Search lost focus
function search_Blur() {
	$(this).val("");
}

/* Actual jQuery Functions */
$(function() {
	loadPagesContentData();
	
	$(document).on("click", "a", a_click);
	$(document).on("click", "#logout-btn", logoutBtn_click);
	$(document).on("submit", "#login-form", loginForm_submit);
	$(document).on("submit", "#register-form", registerForm_submit);
	$(document).on("submit", "#profile-form", profileForm_submit);
	$(document).on("submit", "#task-add-form", taskAddForm_submit);
	$(document).on("submit", "#task-edit-form", taskEditForm_submit);
	$(document).on("click", "#task-revert-btn", taskRevertBtn_click);
	$(document).on("click", ".task-del-btn", taskDelBtn_click);
	$(document).on("click", ".task-current-block", taskCurrentBlock_click);
	$(document).on("mouseenter", "#tasks-list>li", taskLi_mouseEnter);
	$(document).on("keypress", "#search", search_Enter);
	$(document).on("blur", "#search", search_Blur);
});
