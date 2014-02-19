<!-- Center -->
<div id="center_column" class="center_column">
    <br />
    <div id="primary_block" class="clearfix">
        <h1>Register</h1>
        <%REGISTER_MSG%>

        <form action="<%MAIN_FORM_ACTION%>" method="POST">
            <table cellpadding="3" cellspacing="4" class="register-table">
                <tr>
                    <td><label>Customer email</label></td>
                    <td><%CUSTOMEREMAIL%></td>
                </tr>
                <tr>
                    <td><label>First name</label></td>
                    <td><%CUSTOMERFIRSTNAME%></td>
                </tr>
                <tr>
                    <td><label>Cell phone</label></td>
                    <td><%CUSTOMERPHONE%></td>
                </tr>
                <tr>
                    <td><label>Last name</label></td>
                    <td><%CUSTOMERLASTNAME%></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><%CUSTOMERPASSWORD%></td>
                </tr>
                <tr>
                    <td><label>Confirm password</label></td>
                    <td><%CUSTOMERCONFIRMPASSWORD%></td>
                </tr>
                <tr>
                    <td colspan="2"><label>Address</label></td>
                    
                </tr>
                <%ADDRESS%>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="RegisterActionBtn" class="button" value="Register" />
                        <input type="hidden" name="CustomerID" value="<%PAGE_ELEMENT%>" />
                    </td>
                </tr>
            </table>
        </form>
</div>
</div>
<div id="columns_bottom"></div>
</div>
