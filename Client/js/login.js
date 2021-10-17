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
				url: '../php/login.php',
				success: function(output) {
					// If login was successful
					// Originally was json.success
					if (output.success)
					{
						try
						{
							userInfo = output;
							alert("Logged in!");
							// Go back to home/index page
							$("#loginNavButton").hide();
							$("#logoutNavButton").show();
							$("#signupNavButton").hide();
							window.location.replace("#home");
						}
						catch (e)
						{
							alert("ERROR: Failed to assign user information");
						}
						
						
					}
					else
					{
						alert("Invalid username or password!");
					}
				}
			});
			event.preventDefault();
		}
		else
		{
			// Do nothing, prevents default submission of the form
			alert("Please enter username and password!");
			event.preventDefault();
		}
	});
});