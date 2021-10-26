let page = ["#home", "#products", "#login", "#logout", "#signup", "#account", "#staff", "#cart", "#checkout"];
let curPage = page[0];
let newPage;

let userInfo;

$(document).ready(function()
{
	render(newPage);

	// Get hash of initial page.
	let hash = window.location.hash;
	if (hash == "")
	{
		hash = "#home";
	}

	hash = hash.replace('#', '');
	// Highlights current page in navigation.
	$("nav a").each(function()
	{
		let href = $(this).attr("href");
		if (hash == href)
		{
			$(this).addClass("active");
		}
	});

	/*
		Starting PHP session for login details &
		shopping cart when document is ready
	*/
	/*
	$.get("../php/start_session.php", function() {
		// Do nothing at the moment, maybe grab SESSION details as a JSON Object
	});
	*/

	// When user clicks on page in navigation.
	$("nav a").click(function(e)
	{
		clearNav();

		e.preventDefault();
		newPage = $(this).attr("href");
		window.location.hash = newPage;

		$(this).addClass("active");
	});

	$(window).on("hashchange", function()
	{
		render(newPage);
	});
	
	// Hide logout button when loading the webpage
	$("#logoutNavButton").hide();
	$("#accountNavButton").hide();
	$("#staffNavButton").hide();
	$("#checkoutNavButton").hide();
});


// Removes highlight from all navigation links.
function clearNav()
{
	$("nav a").each(function()
	{
		if ($(this).hasClass("active"))
		{
			$(this).removeClass("active");
		}
	});
}


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
