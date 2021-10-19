$(document).ready(function()
{
	// Displays buttons for every type of product in SQL Product table.
	const types = new XMLHttpRequest();
	types.onload = function()
	{
		$(".typeButtons").append("<button type='button'>All</button>");
		let result = JSON.parse(this.responseText);
		for (const row of result)
		{
			$(".typeButtons").append("<button type='button'>" + row.Type + "</button>");
		}
	}

	types.open("GET", "../Server/php/getTypes.php");
	types.send();

	// Displays all products.
	dispProducts();
});


// Displays all items in SQL Product table.
function dispProducts()
{
	const products = new XMLHttpRequest();
	products.onload = function()
	{
		$(".productGrid").empty();
		
		let result = JSON.parse(this.responseText);
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

	products.open("GET", "../Server/php/dispProducts.php");
	products.send();
}
