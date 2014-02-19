<article class="module width_full">
    <header>
        <h3>Customers
            <a class="createNewLink" href="?page=create">
                <input type="button" value="Create new" class="alt_btn" />
            </a>
        </h3>
    </header>
    <table class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <:iteration name="tableRows">
            <tr>
                <td><:CustomerID:></td>
                <td><a href="?page=edit&CustomerID=<:CustomerID:>"><:CustomerEmail:></a></td>
                <td><:CustomerFirstName:></td>
                <td><:CustomerLastName:></td>
                <td>
                    <a href="?page=list&action=doDelete&CustomerID=<:CustomerID:>">
                        <img src="<%SKINS_PATH%>images/icn_trash.png" alt="DELETE" title="delete <:ProductName:>" />
                    </a>
                </td>
            </tr>
        <:enditeration name="tableRows">
        </tbody>
        <tfoot>
            <tr class="pagging">
                <td colspan="5" style="border: none;" align="right"><%PAGER%></td>
            </tr>
        </tfoot>
    </table>
    <div class="spacer"></div>
</article>