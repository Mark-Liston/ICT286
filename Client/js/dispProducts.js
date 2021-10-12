$(document).ready(function()
{
	const xmlhttp = new XMLHttpRequest();

	xmlhttp.onload = function()
	{
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

	xmlhttp.open("GET", "backend.php");
	xmlhttp.send();
});
