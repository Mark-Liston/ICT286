$(document).ready(function()
{
	$(".cartList").on("click", "button",  function()
	{
		// ProductID is stored in cart item's remove button's id.
		let productID = $(this).attr("id");
		// Extract productID by removing addToCart button prefix. 
		productID = productID.replace("remove", "");
	
		$.ajax(
		{
			type: 'POST',
			data: {productID: productID},
			url: '../Server/php/removeFromCart.php',
			success: function(output)
			{
				if (!output)
				{
					alert("Error: The product couldn't be removed.");
				}

				else
				{	
					// Animates product sliding up as it's removed.
					$("#remove" + productID).parent().slideUp(function ()
					{
						// Refreshes cart display after product is removed.
						// This is mostly to update the total price.
						dispCart();
					});
				}
			}
		});
	});

	$(".cartList").on("click", "#checkout", function()
	{
		if ($(".cartList .cartListItem").length)
		{
			$.ajax(
			{
				type: 'POST',
				dataType: 'json',
				url: '../Server/php/checkout.php',
				success: function(output)
				{
					if (output == "success")
					{
						alert("Checkout successful!");
					}

					// If there were products with an order quantity greater than the
					// quantity in stock.
					else
					{
						// Shows alert of the names of all products not able to be satisfied.
						let errorMsg = "There is not enough stock to satisfy the order of:\n";
						for (const row of output)
						{
							errorMsg += "- " + row.Name + "\n"; 
						}

						alert(errorMsg);
					}

					dispCart();
				}
			});
		}

		else
		{
			alert("Add some products to cart before checking out!");
			switchPage("products");
		}
	});
});
