// Javascript file for the login HTML Form

// Checks if the username and password fields contain any input
// They must contain input before being validated by php code
$(document).ready(function()
{
	let usrname;
	let pass;
	function validateLoginForm()
	{
		if (document.getElementById("formUsername").value != ""
			&& document.getElementById("formPassword").value != "")
		{
			return true;
		}
		else
		{
			//event.preventDefault();
			return false;
		}
	}
	
	// Performs the validation and retrieves a JSON of the login details
	// event.preventDefault will stop form submission, just in case
	$("#submitLoginButton").on('click', function()
	{
		if (validateLoginForm())
		{
			$.ajax({
				type: 'POST',
				data: {formUsername: document.getElementById("formUsername").value, formPassword: document.getElementById("formPassword").value},
				dataType: 'json',
				url: '../Server/php/login.php',
				success: function(output) {
					// If login was successful
					// Originally was json.success
					if (output.success)
					{
						alert("Logged in!");
						if (output.isStaff == "0")
						{
							$("#loginNavButton").hide();
							$("#logoutNavButton").show();
							$("#signupNavButton").hide();
							$("#accountNavButton").show();
							$("#checkoutNavButton").show();
							window.location.replace("#home");
						}
						else
						{
							$("#loginNavButton").hide();
							$("#logoutNavButton").show();
							$("#signupNavButton").hide();
							$("#accountNavButton").show();
							$("#staffNavButton").show();
							$("#checkoutNavButton").show();
							window.location.replace("#home");
						}
					}
					else
					{
						alert("Invalid username or password!");
					}
				}
			});
		}
		else
		{
			alert("Please enter username and password!");
		}
	});
});
