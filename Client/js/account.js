$(document).ready(function()
{
    $("#accountModifyButton").on('click', function()
    {
        if (validForm())
        {
            $.ajax({
                type: 'POST',
                data: {accountUsername: document.getElementById("accountUsername").value,
                    accountPassword: document.getElementById("accountPassword").value,
                    accountName: document.getElementById("accountName").value,
                    accountAddress: document.getElementById("accountAddress").value,
                    accountCity: document.getElementById("accountCity").value,
                    accountState: document.getElementById("accountState").value,
                    accountCountry: document.getElementById("accountCountry").value,
                    accountPostcode: document.getElementById("accountPostcode").value,
                    accountPhone: document.getElementById("accountPhone").value,
                    accountEmail: document.getElementById("accountEmail").value,
                    accountPage: true},
                dataType: 'json',
                url: '../Server/php/account.php',
                success: function(output)
                {
                    if (output.success)
                    {
                        alert("Account details updated!");
                    }
                    else
                    {
                        alert("Error: Something went wrong updating account details");
                    }
                }
            });
        }
        else
        {
            alert("Error: Could not update account");
        }
    });
});

// Checks that all fields have input
function validateSignup()
{
	if (document.getElementById("accountUsername").value != "" &&
			document.getElementById("accountPassword").value != "" &&
			document.getElementById("accountName").value != "" &&
			document.getElementById("accountAddress").value != "" &&
			document.getElementById("accountCity").value != "" &&
			document.getElementById("accountState").value != "" &&
			document.getElementById("accountCountry").value != "" &&
			document.getElementById("accountPostcode").value != "" &&
			document.getElementById("accountPhone").value != "" &&
			document.getElementById("accountEmail").value != "")
	{
		return true;
	}
	else
	{
		return false;
	}
}