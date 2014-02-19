<table class="tablesorter">
    <thead>
        <tr>
            <th class="header">Product</th>
            <th class="header">Quantity</th>
            <th class="header" style="text-align: right">Single price</th>
            <th class="header" style="text-align: right">Total</th>
        </tr>
    </thead>
    <tbody>
        <:iteration name="ORDERITEMS">
        <tr>
            <td><a href="products.php?page=edit&ProductID=<:ProductID:>"><:ProductName:></a></td>
            <td><:OrderItemQuantity:></td>
            <td style="text-align: right;"><:OrderItemSinglePrice:> лв.</td>
            <td style="text-align: right;font-weight: bold;"><:OrderItemSum:> лв.</td>
        </tr>
        <:enditeration name="ORDERITEMS">
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right; font-weight: bold;">Product total</td>
            <td style="text-align: right; font-weight: bold;"><%OrderProductTotal%> лв.</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right; font-weight: bold;">Shipping</td>
            <td style="text-align: right; font-weight: bold;"><%OrderShippingCost%> лв.</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="text-align: right; font-weight: bold;">Total</td>
            <td style="text-align: right; font-weight: bold;"><%OrderTotal%> лв.</td>
        </tr>
    </tfoot>
</table>