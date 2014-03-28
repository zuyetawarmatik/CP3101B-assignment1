/* The four main functions used when loading or going back to a page */
function loadPagesContentData() {
	$.getScript("lib/pages_content.js", handleURLWithHash);
}

function handleURLWithHash() {
	// TODO: consider hash with input
	var hash = encodeURI(location.hash).substr(1);
	var pageId, pageParam;
	
	if (hash != "") {
		var arr = hash.split("/", 2);
		var pID = arr[0];
		if (pagesContent[pID] !== undefined) {
			changePage(arr);
		} else
			changePage(["error"]);
	} else changePage(["index"]);
}

function changePage(pageURLArr, isLoad) {
	if (isLoad === undefined) isLoad = true;
	
	var pageId = pageURLArr[0];
	var pageContent = $.extend(true, {}, pagesContent[pageId]);
	
	// TODO: determine logged in, if not valid page (login but logged out), redirect, else render
	var loginState = false;
	
	// Check validity of the page
	var isValidPage = !((loginState && pageContent.type == LOGGED_OUT_PAGE) || (!loginState && pageContent.type == LOGGED_IN_PAGE));
	
	if (isValidPage) {
		/* Render the page if valid */
		
		// Change menu: render and highlight
		if (!loginState)
			$("#nav-bar").html("<ul>\
									<li><a href='' data-to='login'>Login</a></li>\
									<li><a href='' data-to='register'>Register</a></li>\
									<li><a href='' data-to='about'>About</a></li>\
								</ul>");
		else
			$("#nav-bar").html("<ul>\
									<li><a href='' data-to='tasks'>Tasks</a></li>\
									<li><a href='' data-to='profile'>Profile</a></li>\
									<li><a href=''>Logout</a></li>\
									<li><a href='' data-to='about'>About</a></li>\
								</ul>");
		$a = $("#nav-bar li a[data-to='" + pageContent.highlightMenu + "']");
		$a.parent().addClass("selected");
		
		// Change page title
		$("title").html(pageContent.title);
		
		// Add extra content if available
		if (pageContent.extraContent !== undefined)
			$(pageContent.extraContent).insertBefore("#main-section");
		else // Remove extra content
			$("#intro-section").remove();
		
		// Change main content
		$("#main-section-content").html(pageContent.mainContent);
		
		// Change main content's page id
		$("#main-section").attr("data-page", pageId);
		
		// Push to history if this is loading (not back)
		if (isLoad)
			history.pushState({pageURLArr: pageURLArr}, null, "#" + pageId);
	} else {
		/* Redirect to appropriate page */
		if (loginState);
		else 
			changePage(["login"]); // If unauthorized, require to login
	}
}

window.onpopstate = function(e) {
	if (e.state)
		changePage(e.state.pageURLArr, false); // Because go-back is not a load, won't need pushing new state
}
/* ============================ */

/* Ajax Form Functions */
function loginForm_submit(e) {
	e.preventDefault();
	var requestJSON = {
		username: encodeURI($("[name='username']", this).val()),
		password: encodeURI($("[name='password']", this).val()),
	};
	$.ajax({
		 contentType: "application/json; charset=utf-8",
		 url: this.action,
		 type: "POST",
		 data: JSON.stringify(requestJSON),
		 success: function(response) {
			 // Redirect to Tasks pages
		 },
		 error: function(response) {
			 // Display error
		 }
	});
}

function registerForm_submit(e) {
	e.preventDefault();
	var requestJSON = {
		username: encodeURI($("[name='username']", this).val()),
		email: encodeURI($("[name='email']", this).val()),
		password: $("[name='password']", this).val(),
		retype_password: $("[name='retype_password']", this).val(),
	};
	$.ajax({
		 contentType: "application/json; charset=utf-8",
		 url: this.action,
		 type: "POST",
		 data: JSON.stringify(requestJSON),
		 success: function(response) {
			 // Redirect to Tasks pages
		 },
		 error: function(response) {
			 // Display error
		 }
	});
}

/* UI Event Functions */
function a_click(e) {
	e.preventDefault();
	if ($(this).attr("href") == "" && $(this).data("to") != "")
		changePage([$(this).data("to")]);
	else if ($(this).attr("href") !== undefined && $(this).attr("href") != "")
		location.href = $(this).attr("href");
}

/* Actual jQuery Functions */
$(function() {
	loadPagesContentData();
	
	$(document).on("click", "a", a_click);
	$(document).on("submit", "#login-form", loginForm_submit);
	$(document).on("submit", "#register-form", registerForm_submit);
});

$(window).on('hashchange', handleURLWithHash);