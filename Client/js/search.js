$(document).ready(function()
{
	$("#search").on("click", function()
	{
		event.preventDefault();
		if ($("#searchBox").val() != "")
		{
			window.location.replace("#products");
			// Removes highlight from all navigation links and highlights Products.
			$("nav a").each(function()
			{
				if ($(this).attr("href") == "products")
				{
					$(this).addClass("active");
				}

				else if ($(this).hasClass("active"))
				{
					$(this).removeClass("active");
				}
			});
			// Scrolls to the top of window to prevent page from scrolling down to where hash is located.
			$(window).scrollTop(-($(window).scrollTop()));

			// Search Product table for product name/type containing searchBox value.
			searchProducts($("#searchBox").val(), "../Server/php/search.php");
			$("#searchBox").val("");
		}

		else
		{
			alert("Please enter the name or type of product you're looking for.");
		}
	});

	
	// When one of the type buttons is clicked.
	$(".typeButtons").on("click", "button",  function()
	{
		let searchVal = $(this).text();
		if (searchVal == "All")
		{
			dispProducts();
		}

		else
		{
			searchProducts(searchVal, "../Server/php/searchTypes.php");
		}
	});
});


// Sends searchVal to PHP file at path.
// PHP file performs a search on SQL Product table for searchVal and the resulting table is output.
function searchProducts(searchVal, path)
{
	$.ajax(
	{
		type: 'POST',
		data: {'searchVal': searchVal},
		dataType: 'json',
		url: path,
		success: function(result)
		{
			if (result.length != 0)
			{	
				$(".productGrid").empty();
				for (const row of result)
				{
					$(".productGrid").append("<div class='productGridItem'>" +
						"<div class='productName'>" + row.Name + "<br/></div>" +
						"<div class='productType'>" + row.Type + "<br/></div>" +
						"<div class='productPrice'>$" + row.Price + "<br/></div>" +
						"<img src='" + row.URL + "'/>" +
					"</div>");
				}

			}
			
			else
			{
				alert("No products found.");
			}
		}
	});
}
