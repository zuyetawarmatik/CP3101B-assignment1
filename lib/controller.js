/* General Functions */
function loadPagesContentData() {
	$.getScript("frontend/js/pages_content.js", function(){
		handleRefresh();
		loadAllCss();
	});
}

function loadAllCss() {
	$.each(pagesContent, function(key, val) {
		if (val.css !== undefined) {
			$("<link>")
			  .appendTo($("head"))
			  .attr({type: "text/css", rel: "stylesheet"})
			  .attr("href", "frontend/css/" + val.css);
		}
	});
}

function handleRefresh() {
	// TODO: consider hash with input
	var hash = location.hash; 
	if (hash != "")
		changePage($.extend(true, {}, pagesContent[hash.substr(1)]));
}

function changePage(pageContent, isLoad) {
	if (isLoad === undefined) isLoad = true;
	
	// Only for index page
	if (pageContent.id != "index")
		$("#intro-section").hide();
	else
		$("#intro-section").show();
	
	// Change page title
	$("title").html(pageContent.title);
	
	// Change main content
	$("#main-section-content").html(pageContent.mainContent);
	
	// Change main content's page id
	$("#main-section").attr("data-page", pageContent.id);
	
	// Push to history if this is loading (not back)
	if (isLoad)
		history.pushState({pageContent: pageContent}, null, "#" + pageContent.id);
}

window.onpopstate = function(e) {
	if (e.state)
		changePage(e.state.pageContent, false); // Because go-back is not a load, won't need pushing new state
}

/* UI Event Functions */
function a_click(e) {
	e.preventDefault(true);
	if ($(this).attr("href") == "" && $(this).data("to") != "")
		changePage($.extend(true, {}, pagesContent[$(this).data("to")]));
	else
		location.href = $(this).attr("href");
}

/* Actual jQuery Functions */
$(function() {
	loadPagesContentData();
	$(document).on("click", "a", a_click);
});