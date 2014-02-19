<article class="module width_full">
    <header><h3>Create product</h3></header><br />
    <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
        <div class="module_content">
            <fieldset>
                <label>Product name</label>
                <%PRODUCTNAME%><br />
            </fieldset>
            <fieldset>
                <label>Code</label>
                <%PRODUCTCODE%><br />
            </fieldset>
            <fieldset>
                <label>Referer Code</label>
                <%PRODUCTREFERERCODE%><br />
            </fieldset>
            <fieldset>
                <label>Price (BGN)</label>
                <%PRODUCTGLOBALPRICE%><br />
            </fieldset>
            <fieldset>
                <label>Short description</label><br />
                <%PRODUCTSHORTDESCRIPTION%><br />
            </fieldset>
            <fieldset>
                <label>Detailed description</label><br />
                <%PRODUCTDETAILEDDESCRIPTION%><br />
            </fieldset>
            <fieldset>
                <label>Additional description</label><br />
                <%PRODUCTADDITIONALDESCRIPTION%><br />
            </fieldset>
        </div>
        <footer>
            <div class="submit_link">
                <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>