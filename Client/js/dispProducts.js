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

	types.open("POST", "../Server/php/getTypes.php");
	types.send();

	// Displays all products.
	dispProducts();
});


// Converts result array to HTML table.
function arrToTable(result)
{
	let table = "";
	for (const row of result)
	{
		table += "<div class='productGridItem'>" +
			"<div class='productName'>" + row.Name + "<br/></div>" +
			"<div class='productType'>" + row.Type + "<br/></div>" +
			"<div class='productPrice'>$" + row.Price + "<br/></div>" +
			"<div class='addToCart'>" +
				"<img src='" + row.URL + "'/>" +
				"<button type='button' id='addToCart" + row.ProductID + "'>Add to Cart</button>" +
			"</div>" +
		"</div>";
	}
	
	return table;
}


// Displays all items in SQL Product table.
function dispProducts()
{
	const products = new XMLHttpRequest();
	products.onload = function()
	{
		$(".productGrid").empty();

		let result = JSON.parse(this.responseText);
		// Converts result array to HTML table.
		$(".productGrid").append(arrToTable(result));
	}

	products.open("POST", "../Server/php/dispProducts.php");
	products.send();
}
