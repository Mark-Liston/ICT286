$(document).ready(function()
{
	populateFields();

    // Populate text boxes with user data
    $("#accountNavButton").on('click', function()
    {
		populateFields();
    });

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
function validForm()
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


function populateFields()
{
	$.ajax({
            type: 'GET',
            data: {fetchAccountDetails: true},
            dataType: 'json',
            url: '../Server/php/account.php',
            success: function(output)
            {
                if (output.success)
                {
                    document.getElementById("accountUsername").value = output.username;
                    document.getElementById("accountPassword").value = output.password;
                    document.getElementById("accountName").value = output.name;
                    document.getElementById("accountAddress").value = output.address;
                    document.getElementById("accountCity").value = output.city;
                    document.getElementById("accountState").value = output.state;
                    document.getElementById("accountCountry").value = output.country;
                    document.getElementById("accountPostcode").value = output.postcode;
                    document.getElementById("accountPhone").value = output.phone;
                    document.getElementById("accountEmail").value = output.email;
                }
                else
                {
                    alert("Error: Failed to load account details");
                    window.location.replace("#home");
                }
            }
        });

}
