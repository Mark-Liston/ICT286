$(document).ready(function()
{
    const users = new XMLHttpRequest();
    users.onload = function()
    {
        $(".usersList").empty();
        let result = JSON.parse(this.responseText);
    }

    let param = "getUsers=true";
    users.open("GET", "../Server/php/staff.php");
    users.send(param);

    dispUsers();
});

function dispUsers(result)
{
    let selection = "<select>";
    let options = "";
    for (const row of result)
    {
        options += "<option value='" + row.Username + "'>" + row.Username
            + "</option><br/>";
    }
}