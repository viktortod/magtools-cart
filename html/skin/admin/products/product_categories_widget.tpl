<fieldset>
    <select class="multipleSelect" id="multiple1" multiple>
        <:iteration name="categoriesList">
        <option value="<:CategoryID:>"><:CategoryName:></option>
        <:enditeration name="categoriesList">
    </select>
    <select name="ProductCategoriesList" class="multipleSelect" id="multiple2" multiple>
        <:iteration name="productCategories">
        <option value="<:CategoryID:>"><:CategoryName:></option>
        <:enditeration name="productCategories">
    </select>

    <input type="hidden" id="cats" value="" name="ProductCategories" />
</fieldset>
