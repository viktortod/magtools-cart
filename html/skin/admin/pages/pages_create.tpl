<article class="module width_full">
    <header><h3>Create page</h3></header>
    <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
       <div class="module_content">
            <fieldset>
                <label>PageTitle</label>
                <%PAGETITLE%><br />
            </fieldset>
            <fieldset>
                <label>PageContent</label><br /><br />
                <%PAGECONTENT%>
                <input type="hidden" name="PageID" value="<%PAGE_ELEMENT%>" />
            </fieldset>
        </div>
    
        <footer>
            <div class="submit_link">
                    
                    <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>