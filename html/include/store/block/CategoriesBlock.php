<?php
class CategoriesBlock extends UIBlock{
    protected $template = 'block/categories.tpl';

    public function  showBlock() {
        $properties = array(
            'tableName' => 'Categories',
            'parentColumn' => 'CategoryParentID',
            'keyField' => 'CategoryID',
            'valueField' => 'CategoryName',
            'join' => array(
                'table' => 'CategoriesML',
                'condition' => 'USING(CategoryID)'
            )
        );

        $categories = HierarchyUtil::getHierarchy($properties);

        ob_start();
        foreach($categories as $key => $category){
            $this->showCategory($key, $category);
        }


        return ob_get_clean();
    }

    public function showCategory($id, $category)
    {
        if($id != 'children'){
            echo '<li>';
        }

        if($id == 'children'){
            echo '<ul class="toggle">';
            foreach($category as $id => $childCategory){
                $this->showCategory($id, $childCategory);
            }
            echo '</ul>';
             echo '</li>';
        }
        else{
            
            echo '<a href="categories.php?CategoryID='.$id.'">'.$category.'</a>';
            
            
        }

        
           
        
    }
}
?>
