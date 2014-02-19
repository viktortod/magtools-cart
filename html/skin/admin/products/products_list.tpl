<article class="module width_full">
    <header>
        <h3>Categories
            <a class="createNewLink" href="?page=create">
                <input type="button" value="Create new" class="alt_btn" />
            </a>
        </h3>
    </header>
    <table class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Front image</th>
                <th>Product code</th>
                <th>Product price</th>
                <th>Active</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <:iteration name="tableRows">
            <tr>
                <td><:ProductID:></td>
                <td><a href="?page=edit&ProductID=<:ProductID:>"><:ProductName:></a></td>
                <td align="center"><img width="70" src="../userfiles/images/products/productimage/<:ProductImageFileName:>" alt="no image" /></td>
                <td><:ProductCode:></td>
                <td><:ProductGlobalPrice:></td>
                <td><div class="is_active_<:ProductIsActive:>">&nbsp;</div></td>
                <td>
                    <a href="?page=list&action=doDelete&ProductID=<:ProductID:>">
                        <img src="<%SKINS_PATH%>images/icn_trash.png" alt="DELETE" title="delete <:ProductName:>" />
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