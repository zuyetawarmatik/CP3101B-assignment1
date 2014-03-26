/* General Functions */
function loadPageContentData() {
	$.getScript("frontend/js/page_content.js", loadAllCss);
			
}

function loadAllCss() {
	$.each(pageContent, function(key, val) {
		$("<link>")
		  .appendTo($("head"))
		  .attr({type: "text/css", rel: "stylesheet"})
		  .attr("href", "frontend/css/" + val.css);
	});
}

function changePageTitle(title) {
	$("title").html(title);
}

function changePageMainContent(content) {
	$("#main-section-content").html(content);
}

/* UI Event Functions */
function navbar_click() {
	$("#intro-section").hide();
	
	var thisPageContent = pageContent[$(this).data("content")];
	changePageTitle(thisPageContent.title);
	changePageMainContent(thisPageContent.mainContent);
}

/* Actual jQuery Functions */
$(function() {
	loadPageContentData();
	$("#nav-bar").on("click", "li", navbar_click);
});