$(document).ready(function()
{
	// Logs user out on clicking the logout link
	$("#logoutNavButton").on('click', function()
	{
		$.ajax({
			type: 'GET',
			data: {'logout': true},
			url: '../Server/php/logout.php',
			success: function(output) {
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
					window.location.replace("#home");
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
					window.location.replace("#home");
				}
			}
		});
	});
});
