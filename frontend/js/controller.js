/* General Functions */
function loadPageContentData() {
	$.getScript("frontend/js/pages_content.js", loadAllCss);
			
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

function changePage(pageContent) {
	// Change page title
	$("title").html(pageContent.title);
	
	// Change main content's page id
	$("#main-section-content").html(pageContent.mainContent);
	
	// Change main content
	$("#main-section").attr("data-page", pageContent.id);
}

/* UI Event Functions */
function navbar_click() {
	$("#intro-section").hide();
	changePage(pagesContent[$(this).data("to")]);
}

/* Actual jQuery Functions */
$(function() {
	loadPageContentData();
	$("#nav-bar").on("click", "li", navbar_click);
});