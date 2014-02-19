<article class="module width_full">
    <header><h3>Edit product</h3>
        <ul class="tabs">
            <li><a href="#tab1">General info</a></li>
            <li><a href="#tab2">Description</a></li>
            <li><a href="#tab3">Categories</a></li>
            <li><a href="#tab4">Images</a></li>
        </ul></header><br />
    
    <form method="POST" action="<%MAIN_FORM_ACTION%>" enctype="multipart/form-data">
        <div class="module_content">
            <div id="tab1" class="tab_content">
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
                    <label>Active</label><br />
                    <%PRODUCTISACTIVE%><br />
                </fieldset>
            </div>
            <div id="tab2" class="tab_content">
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
            <div id="tab3" class="tab_content">
                <%PRODUCTCATEGORIESWIDGET%>
            </div>
            <div id="tab4" class="tab_content">
                <%PRODUCTIMAGESWIDGET%>
            </div>
        </div>
        <footer>
            <div class="submit_link">
                <input type="hidden" name="ProductID" value="<%PAGE_ELEMENT%>" />
                <input type="hidden" name="LanguageID" value="1" />
                <input type="submit" value="Publish" class="alt_btn">
            </div>
        </footer>
    </form>
</article>