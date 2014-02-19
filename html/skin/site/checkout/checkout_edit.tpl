<div id="center_column" class="center_column">
        <br />
        <h1>Order</h1>
        <br />
        <div class="order-form">
            <form action="?action=createOrder" method="POST">
                <fieldset>
                    <legend>Personal info</legend>
                    <table>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                        </tr>
                        <tr>
                            <td><%CUSTOMERFIRSTNAME%></td>
                            <td><%CUSTOMERLASTNAME%></td>
                        </tr>
                        <tr>
                            <th colspan="2">E-mail</th>
                        </tr>
                        <tr>
                            <td colspan="2"><%CUSTOMEREMAIL%></td>
                        </tr>
                        <tr>
                            <th colspan="2">Phone</th>
                        </tr>
                        <tr>
                            <td colpan="2"><%CUSTOMERPHONE%></td>
                        </tr>
                        <%ADDRESS%>
                    </table>
                 </fieldset>
                <fieldset>
                    <legend>Payment</legend>
                    <table>
                        <:iteration name="PAYMENT">
                        <tr>
                            <td><:PaymentModuleName:></td>
                            <td><input type="radio" name="PaymentModuleID" value="<:PaymentModuleID:>" /></td>
                        </tr>
                        <:enditeration name="PAYMENT">
                        <:iteration name="SHIPPING">
                        <tr>
                            <td><:ShippingModuleName:></td>
                            <td><input type="radio" name="ShippingModuleID" value="<:ShippingModuleID:>" /></td>
                        </tr>
                        <:enditeration name="SHIPPING">
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Additional info</legend>
                    <textarea name="OrderAdditionalInfo"></textarea>
                </fieldset>

                <input type="submit" class="button" name="SubmitButton" value="Order" />
            </form>
        </div>
</div>
</div>