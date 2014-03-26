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
}

/* UI Event Functions */
function a_click(e) {
	e.preventDefault(true);
	if ($(this).attr("href") == "" && $(this).data("to") != "")
		changePage(pagesContent[$(this).data("to")]);
	else
		window.location.href = $(this).attr("href");
}

/* Actual jQuery Functions */
$(function() {
	loadPageContentData();
	$(document).on("click", "a", a_click);
});