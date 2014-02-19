<article class="module width_full">
    <header>
        <h3>Categories
            <a class="createNewLink" href="?page=create">
                <input type="button" value="Create new" class="alt_btn" />
            </a>
        </h3>
    </header>
    <br />
    <form action="" name="filterForm" method="POST">
        <fieldset>
            <table>
                <tr>
                    <td style="width: 103px"></td>
                    <td><%FILTER NAME="CategoryName" CONDITION="=" %></td>
                    <td><input type="button" name="filter" onclick="document.filterForm.submit()" class="alt_btn" value="Filter" /></td>
                    <td><input type="button" name="clearFilters" onclick="window.location = '?page=list&action=clearFilters'" class="alt_btn" value="Clear Filters" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <table class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Active</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
        <:iteration name="tableRows">

            <tr>
                <td><:CategoryID:></td>
                <td><a href="?page=edit&CategoryID=<:CategoryID:>"><:CategoryName:></a></td>
                <td align="center"><img width="70" src="../userfiles/images/categories/thumbs/<:CategoryImage:>" alt="no image" /></td>
                <td align="center"><div class="is_active_<:CategoryIsActive:>">&nbsp;</div></td>
                <td>
                    <a href="?page=list&action=doDelete&CategoryID=<:CategoryID:>">
                        <img src="<%SKINS_PATH%>images/icn_trash.png" alt="DELETE" title="delete <:CategoryName:>" />
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