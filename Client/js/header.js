let page = ["#home", "#products", "#login", "#signup"];
let curPage = page[0];
let newPage;


$(document).ready(function()
{
	render(newPage);

	let prePage;

	$("nav a").click(function(e)
	{
		$(prePage).removeClass("active");
		
		e.preventDefault();
		newPage = $(this).attr("href");
		window.location.hash = newPage;

		prePage = this;
		$(this).addClass("active");
	});

	$(window).on("hashchange", function()
	{
		render(newPage);
	});
});


// If newPage is different from curPage, hide curPage, show newPage, and set curPage to newPage.
function render(newPage)
{
	newPage = getPage(window.location.hash);
	if (newPage != curPage)
	{
		$(curPage).hide();
		$(newPage).show();
		curPage = newPage;
	}

	// Scrolls to the top of window to prevent page from scrolling down to where hash is located.
	$(window).scrollTop(-($(window).scrollTop()));
}


// Converts hash to page name. Defaults to page[0]. 
function getPage(hash)
{
	let i = page.indexOf(hash);
	if (i < 0 && hash != "")
	{
		window.location.hash = page[0];
	}

	return i < 1 ? page[0] : page[i];
}
