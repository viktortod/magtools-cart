<article class="module width_full">
    <header><h3>Pages <a class="createNewLink" href="?page=create"><input type="button" value="Create new" class="alt_btn" /></a></h3></header>
    <br />
    <table class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Active</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <:iteration name="tableRows">
        
            <tr>
                <td><:PageID:></td>
                <td><a href="?page=edit&PageID=<:PageID:>"><:PageTitle:></a></td>
                <td><:PageIsActive:></td>
                <td>
                    <a href="?page=&action=doDelete&PageID=<:PageID:>">
                        <img src="<%SKINS_PATH%>images/icn_trash.png" alt="DELETE" title="delete <:PageTitle:>" />
                    </a>
                </td>

            </tr>
        
        <:enditeration name="tableRows">
        </tbody>
        <tfoot>
            <tr class="pagging">
                <td colspan="4" style="border: none;" align="right"><%PAGER%></td>
            </tr>
        </tfoot>
    </table>
    <div class="spacer"></div>
</article>