<article class="module width_full">
    <header>
        <h3>Orders
            <a class="createNewLink" href="?page=create">
                <input type="button" value="Create new" class="alt_btn" />
            </a>
        </h3>
    </header>
    <table class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date of order</th>
                <th>PaymentModule</th>
                <th>Order status</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <:iteration name="tableRows">
            <tr>
                <td><:OrderID:></td>
                <td>
                    <a href="customers.php?page=edit&CustomerID=<:OrderCustomerID:>">
                        <:CustomerFirstName:> <:CustomerLastName:>
                    </a>
                </td>
                <td><:OrderDate:></td>
                <td><:PaymentModuleName:></td>
                <td><:OrderStatus:></td>
                <td>
                    <a href="?page=edit&OrderID=<:OrderID:>">
                        <img src="<%SKINS_PATH%>images/icn_edit.png" alt="Edit" title="Edit order #<:OrderID:>" />
                    </a>
                </td>
            </tr>
        <:enditeration name="tableRows">
        </tbody>
        <tfoot>
            <tr class="pagging">
                <td colspan="6" style="border: none;" align="right"><%PAGER%></td>
            </tr>
        </tfoot>
    </table>
    <div class="spacer"></div>
</article>