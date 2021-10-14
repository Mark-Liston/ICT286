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
			alert("Please enter username and password!");
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
					/*let json;
					try
					{
						json = JSON.parse(output);
					}
					catch (e)
					{
						alert("Error has occurred parsing JSON");
					}
					*/
					// NOTE: JSON parsing didn't appear to work here, I'm not sure why
					// Simply taking the JSON output and working with that was better
					
					// If login was successful
					// Originally was json.success
					if (output.success)
					{
						alert("Logged in!");
						// Go back to home/index page
						$("#loginNavButton").hide();
						$("#logoutNavButton").show();
						window.location.replace("#home");
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
			event.preventDefault();
		}
	});
});