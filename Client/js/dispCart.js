$(document).ready(function()
{
	dispCart();

	$("#cartNavButton").on('click', function()
	{
		dispCart();
	});
});


function arrToList(result)
{
	// Total price of all items in cart.
	let totalPrice = 0;
	// (Price of individual product) * quantity.
	let combinedPrice = 0;
	let list = "";
	for (let row of result)
	{
		combinedPrice = row.Price * row.OrderQty;
		totalPrice += combinedPrice;

		list += "<div class='cartListItem'>" +
			"<button type='button' id='remove" + row.ProductID +"'>" +
			"<i class='fa fa-times'></i></button>" +
			"<img src='" + row.URL + "'/>" +
			"<div class='cartInfo'>" +
				"<div class='primaryInfo'>" +
					"<div class='productName'>" + row.Name + "<br/></div>" +
					"<div class='productType'>" + row.Type + "<br/></div>" +
				"</div>" +
				"<div class='secondaryInfo'>" +
					"<div class='cartPrice'>$" + combinedPrice +
					"  <span>($" + row.Price + " each)</span><br/></div>" +
					"<div class='cartQty'>" + row.OrderQty +" of " + row.TotalQty +
					" in stock</div>" +
				"</div>" +
			"</div>" +
		"</div>";
	}

	list += "<div class='totalPrice'>Total Price: $" + totalPrice + "</div>" + 
		"<button type='button' id='checkout'>Checkout</button>";

	return list;
}


function dispCart()
{
	$.ajax(
	{
		type: 'POST',
		dataType: 'json',
		url: '../Server/php/dispCart.php',
		success: function(result)
		{
			$(".cartList").empty();
			$(".cartList").append(arrToList(result));
		}
	});
}
