<tr>
    <td colspan="2">
        <div class="customerAddress">
        <:iteration name="ADDRESSES">
        <div>
            <input type="text" name="CustomerAddress[<:CustomerAddressID:>]" value="<:CustomerAddress:>" />
            <input type="radio" name="CustomerDefault" value="<:CustomerAddressID:>" <:CustomerAddressChecked:>/>
        </div>
        <:enditeration name="ADDRESSES">
        <div>
            <label>Add new address</label><br />
            <input type="text" name="CustomerAddress[0]" value="" />
            <input type="radio" name="CustomerDefault" value="0" />
        </div>
        </div>
    </td>
</tr>