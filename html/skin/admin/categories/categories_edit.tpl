<article class="module width_full">
    <header><h3>Create category</h3></header>
    <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
       <div class="module_content">
            <fieldset>
                <label>Category</label>
                <%CATEGORYNAME%><br />
            </fieldset>
           <fieldset>
                <label>Parent directory</label>
                <%CATEGORYPARENTID%><br />
            </fieldset>
            <fieldset>
                <label>Image:</label>
                <%CATEGORYIMAGE%><br />
                <br /><br />
                <img width="300" src="../userfiles/images/categories/thumbs/<%HTML_CATEGORYIMAGE%>" alt="<%HTML_CATEGORYIMAGE%>" />
            </fieldset>
           <fieldset>
               <label>Active:</label><br />
               <%CATEGORYISACTIVE%>
           </fieldset>
           <fieldset>
               <label>Description:</label><br />
               <%CATEGORYDESCRIPTION%>
           </fieldset>
        </div>
        <footer>
            <div class="submit_link">
                    <input type="hidden" name="CategoryID" value="<%PAGE_ELEMENT%>" />
                    <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>