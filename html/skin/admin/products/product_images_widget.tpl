<fieldset>
    <input type="file" name="images[]" class="multi" accept="gif|jpg|png" style="width: 100%; border: 1px solid grey;" /><br />
</fieldset>

<fieldset>
    <table width="100%">
        <:iteration name="images">
            <tr>
                <td>
                    <img src="../userfiles/images/products/thumbs/<:ProductImageThumb:>"  height="<:ProductImageThumbWidth:>" alt="image" />
                </td>
                <td>
                    <:ProductImageLeadingText:>
                </td>
                <td>
                    <a href="?page=edit&ProductImageID=<:ProductImageID:>&ProductID=<:ProductID:>&action=doDeleteImage">Delete</a>
                </td>
                <td>
                    <a href="?page=edit&ProductImageID=<:ProductImageID:>&ProductID=<:ProductID:>&action=doSetLeadingImg">Set Leading</a>
                </td>
            </tr>
        <:enditeration name="images">
    </table>
</fieldset>