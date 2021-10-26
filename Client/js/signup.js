$(document).ready(function()
{
	$("#signupButton").on('click', function()
	{
		if (validateSignup())
		{
			$.ajax({
				type: 'POST',
				data: {usernameInputSignup: document.getElementById("usernameInputSignup").value,
					passwordInputSignup: document.getElementById("passwordInputSignup").value,
					nameInputSignup: document.getElementById("nameInputSignup").value,
					addressInputSignup: document.getElementById("addressInputSignup").value,
					cityInputSignup: document.getElementById("cityInputSignup").value,
					stateInputSignup: document.getElementById("stateInputSignup").value,
					countryInputSignup: document.getElementById("countryInputSignup").value,
					postcodeInputSignup: document.getElementById("postcodeInputSignup").value,
					phoneInputSignup: document.getElementById("phoneInputSignup").value,
					emailInputSignup: document.getElementById("emailInputSignup").value},
				dataType: 'json',
				url: '../Server/php/signup.php',
				success: function(output)
				{
					if (output.success)
					{
						alert("Signup success!");
						userInfo = output;
						$("#loginNavButton").hide();
						$("#logoutNavButton").show();
						$("#signupNavButton").hide();
						$("#accountNavButton").show();
						$("#checkoutNavButton").show();
						switchPage("home");
					}
					else
					{
						alert("Error: Failed to signup, please try again");
					}
				}
			});
		}
		else
		{
			alert("Error submitting form, please ensure all fields have been filled in");
		}
	});
});

// Checks that all fields have input, it does not check the validity of that input
function validateSignup()
{
	if (document.getElementById("usernameInputSignup").value != "" &&
			document.getElementById("passwordInputSignup").value != "" &&
			document.getElementById("nameInputSignup").value != "" &&
			document.getElementById("addressInputSignup").value != "" &&
			document.getElementById("cityInputSignup").value != "" &&
			document.getElementById("stateInputSignup").value != "" &&
			document.getElementById("countryInputSignup").value != "" &&
			document.getElementById("postcodeInputSignup").value != "" &&
			document.getElementById("phoneInputSignup").value != "" &&
			document.getElementById("emailInputSignup").value != "")
	{
		return true;
	}
	else
	{
		return false;
	}
}
