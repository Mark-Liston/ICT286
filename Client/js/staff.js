$(document).ready(function()
{
    // When the staff navigation button is clicked, fetch user data from the database
   $("#staffNavButton").on('click', function()
   {
        let result;
        $("#usersList").empty();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '../Server/php/staff.php',
            success: function(output)
            {
                result = output;
                dispUsers(result);
            }
        })

        $("#productsDataList").empty();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '../Server/php/staffFetchProduct.php',
            success: function(output)
            {
                result = output;
                dispProductsList(result);
            }
        })
   });

   // When the user changes
   $("#usersList").change(function()
   {
        let value = $(this).val();

        if (value == "None")
        {
            return;
        }

        $.ajax({
            type: 'POST',
            data: {username: value},
            dataType: 'json',
            url: '../Server/php/staffAccount.php',
            success: function(output)
            {
                document.getElementById("staffUsername").value = output.Username;
                document.getElementById("staffPassword").value = output.Password;
                document.getElementById("staffName").value = output.Name;
                document.getElementById("staffAddress").value = output.Address;
                document.getElementById("staffCity").value = output.City;
                document.getElementById("staffState").value = output.CountryState;
                document.getElementById("staffCountry").value = output.Country;
                document.getElementById("staffPostcode").value = output.Postcode;
                document.getElementById("staffPhone").value = output.Phone;
                document.getElementById("staffEmail").value = output.Email;
                document.getElementById("isStaff").value = output.Staff;
            }
        });
   });

   // Handles modifying accounts
   $("#staffModifyButton").on('click', function()
   {
        if(validForm())
        {
            $.ajax({
                type: 'POST',
                data: {username: document.getElementById("staffUsername").value,
                    password: document.getElementById("staffPassword").value,
                    name: document.getElementById("staffName").value,
                    address: document.getElementById("staffAddress").value,
                    city: document.getElementById("staffCity").value,
                    state: document.getElementById("staffState").value,
                    country: document.getElementById("staffCountry").value,
                    postcode: document.getElementById("staffPostcode").value,
                    phone: document.getElementById("staffPhone").value,
                    email: document.getElementById("staffEmail").value,
                    isStaff: document.getElementById("isStaff").value},
                dataType: 'json',
                url: '../Server/php/staffModify.php',
                success: function(output)
                {
                    if (output.success)
                    {
                        alert("Account details updated!");
                    }
                    else
                    {
                        alert("Error: Unable to update account")
                    }
                }
            });
        }
        else
        {
            alert("Error: Could not update account");
        }
   });

   // Handle account creation
   $("#staffAddButton").on('click', function()
   {
        if(validForm())
        {
            $.ajax({
                type: 'POST',
                data: {username: document.getElementById("staffUsername").value,
                    password: document.getElementById("staffPassword").value,
                    name: document.getElementById("staffName").value,
                    address: document.getElementById("staffAddress").value,
                    city: document.getElementById("staffCity").value,
                    state: document.getElementById("staffState").value,
                    country: document.getElementById("staffCountry").value,
                    postcode: document.getElementById("staffPostcode").value,
                    phone: document.getElementById("staffPhone").value,
                    email: document.getElementById("staffEmail").value,
                    isStaff: document.getElementById("isStaff").value},
                dataType: 'json',
                url: '../Server/php/staffCreate.php',
                success: function(output)
                {
                    if (output.success)
                    {
                        alert("Account created!");
                    }
                    else
                    {
                        alert("Error: Unable to create account")
                    }
                }
            });
        }
        else
        {
            alert("Error: Cannot make account");
        }
   });

   $("#productsDataList").change(function()
   {
        let value = $(this).val();

        if (value == "None")
        {
            return;
        }

        $.ajax({
            type: 'POST',
            data: {id: value},
            dataType: 'json',
            url: '../Server/php/staffProduct.php',
            success: function(output)
            {
                document.getElementById("productIdList").value = output.ProductID;
                document.getElementById("productTypeList").value = output.Type;
                document.getElementById("productNameList").value = output.Name;
                document.getElementById("productPriceList").value = output.Price;
                document.getElementById("productURLList").value = output.URL;
            }
        });
   });
});

// Appends new <option> tags to the select tag in the staff page
function dispUsers(result)
{
    for (const row of result)
    {
        let optionText = row.Username;
        let optionValue = row.Username;
        $("#usersList").append(`<option value="${optionValue}">${optionText}</option>`);
    }
}

function dispProductsList(result)
{
    for (const row of result)
    {
        let nameText = row.Name;
        let nameValue = row.ProductID;
        $("#productsDataList").append(`<option value="${nameValue}">${nameText}</option>`);
    }
}

// Checks that all fields have input
function validForm()
{
	if (document.getElementById("staffUsername").value != "" &&
			document.getElementById("staffPassword").value != "" &&
			document.getElementById("staffName").value != "" &&
			document.getElementById("staffAddress").value != "" &&
			document.getElementById("staffCity").value != "" &&
			document.getElementById("staffState").value != "" &&
			document.getElementById("staffCountry").value != "" &&
			document.getElementById("staffPostcode").value != "" &&
			document.getElementById("staffPhone").value != "" &&
			document.getElementById("staffEmail").value != "" &&
            document.getElementById("isStaff").value != "")
	{
		return true;
	}
	else
	{
		return false;
	}
}