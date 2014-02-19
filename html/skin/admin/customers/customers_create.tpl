<article class="module width_full">
    <header><h3>Create category</h3></header><br />
    <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
        <div class="module_content">
            <fieldset>
                <label>First name</label>
                <%CUSTOMERFIRSTNAME%><br />
            </fieldset>
            <fieldset>
                <label>Last name</label>
                <%CUSTOMERLASTNAME%><br />
            </fieldset>
            <fieldset>
                <label>Email</label>
                <%CUSTOMEREMAIL%><br />
            </fieldset>
            <fieldset>
                <label>Phone</label>
                <%CUSTOMERPHONE%><br />
            </fieldset>
            <fieldset>
                <label>Company</label>
                <%CUSTOMERCOMPANY%><br />
            </fieldset>
            <fieldset>
                <label>Company Address</label>
                <%CUSTOMERCOMPANYADDRESS%><br />
            </fieldset>
            <fieldset>
                <label>UIC Number</label>
                <%CUSTOMERUIC%><br />
            </fieldset>
            <fieldset>
                <label>VAT Number</label>
                <%CUSTOMERVAT%><br />
            </fieldset>
        </div>
        <footer>
            <div class="submit_link">
                <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>