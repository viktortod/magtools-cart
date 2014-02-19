<article class="module width_full">
    <header><h3>Create category</h3></header><br />
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
                <%CATEGORYIMAGE%>
            </fieldset>
           <fieldset>
               <label>Description:</label><br />
               <%CATEGORYDESCRIPTION%>
           </fieldset>
        </div>
        <footer>
            <div class="submit_link">
                    <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>