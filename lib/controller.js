/* General Functions */

/* The triple main functions to do when load a page */
function loadPagesContentData() {
	$.getScript("lib/pages_content.js", handleURLWithHash);
}

function handleURLWithHash() {
	// TODO: consider hash with input
	var hash = location.hash; 
	if (hash != "") {
		var pageId;
		if (pagesContent[hash.substr(1)] !== undefined) 
			pageId = hash.substr(1);
		else
			pageId = "error";
		
		changePage(pageId);
	}
}
/* ============================ */

function changePage(pageId, isLoad) {
	if (isLoad === undefined) isLoad = true;
	
	var pCnt = $.extend(true, {}, pagesContent[pageId]);
	
	// Only for index page
	if (pageId != "index")
		$("#intro-section").hide();
	else
		$("#intro-section").show();
	
	// Change page title
	$("title").html(pCnt.title);
	
	// Change main content
	$("#main-section-content").html(pCnt.mainContent);
	
	// Change main content's page id
	$("#main-section").attr("data-page", pageId);
	
	// Push to history if this is loading (not back)
	if (isLoad)
		history.pushState({pageContent: pCnt}, null, "#" + pageId);
}

window.onpopstate = function(e) {
	if (e.state)
		changePage(e.state.pageContent, false); // Because go-back is not a load, won't need pushing new state
}

/* UI Event Functions */
function a_click(e) {
	e.preventDefault(true);
	if ($(this).attr("href") == "" && $(this).data("to") != "")
		changePage($(this).data("to"));
	else
		location.href = $(this).attr("href");
}

/* Actual jQuery Functions */
$(function() {
	loadPagesContentData();
	$(document).on("click", "a", a_click);
});

$(window).on('hashchange', handleURLWithHash);