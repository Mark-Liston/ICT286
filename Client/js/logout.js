$(document).ready(function()
{
	// Logs user out on clicking the logout link
	$("#logoutNavButton").on('click', function()
	{
		document.getElementById("accountUsername").value = "";
	        document.getElementById("accountPassword").value = "";
	        document.getElementById("accountName").value = "";
	        document.getElementById("accountAddress").value = "";
	        document.getElementById("accountCity").value = "";
	        document.getElementById("accountState").value = "";
	        document.getElementById("accountCountry").value = "";
	        document.getElementById("accountPostcode").value = "";
	        document.getElementById("accountPhone").value = "";
	        document.getElementById("accountEmail").value = "";

		$.ajax(
		{
			type: 'GET',
			data: {'logout': true},
			url: '../Server/php/logout.php',
			success: function(output)
			{
				if (output)
				{
					alert("Logged out!");
					userInfo = null;
					$("#logoutNavButton").hide();
					$("#loginNavButton").show();
					$("#signupNavButton").show();
					$("#accountNavButton").hide();
					$("#staffNavButton").hide();
					$("#checkoutNavButton").hide();
				}

				else
				{
					alert("Error occured logging out! Restarting session... Logged out");
					userInfo = null;
					$("#logoutNavButton").hide();
					$("#loginNavButton").show();
					$("#signupNavButton").show();
					$("#accountNavButton").hide();
					$("#staffNavButton").hide();
					$("#checkoutNavButton").hide();
				}

				$("#headerUsername").text("");
				switchPage("home");
			}
		});
	});
});
