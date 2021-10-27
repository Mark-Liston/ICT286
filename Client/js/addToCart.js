$(document).ready(function()
{
	$(".productGrid").on("click", "button",  function()
	{
		// ProductID is stored in addToCart button's id.
		let productID = $(this).attr("id");
		// Extract productID by removing addToCart button prefix. 
		productID = productID.replace("addToCart", "");
		
		$.ajax(
		{
			type: 'POST',
			data: {productID: productID},
			url: '../Server/php/addToCart.php',
			success: function(output)
			{
				if (output != "")
				{
					alert(output);
				}

				else
				{
					// Shows pop up message indicating product has been added to cart.
					// Pop up then fades out and is hidden.
					$(".cartPopUp").removeAttr("hidden");
					$(".cartPopUp").stop()
					$(".cartPopUp").css("opacity", "1");
					$(".cartPopUp").delay(1000).animate({opacity: 0}, 2000, function()
					{
						$(".cartPopUp").css("opacity", "1");
						$(".cartPopUp").attr("hidden", "hidden");
					});
				}
			}
		});

	});
}); 
