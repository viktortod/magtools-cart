<?php
/**
 * Class representing the Layout of the page. It contains a pool of blocks
 */
class UILayout {
    private $_blocks = array();

    /**
     * Adds a name of the block into the pool
     * @access public
     * @param string $name 
     */
    public function registerBlock($name){
        $this->_blocks[] = $name;
    }

    /**
     * Gets the blocks pool
     * @return array
     */
    public function getBlocks(){
        return $this->_blocks;
    }

    /**
     * Dispatch the blocks in the layout
     * @return string The content of the layout
     */
    public function dispatch(){
        $templateContent = '';
        
        foreach($this->_blocks as $block){
            $blockInstance = new $block();
            $templateContent .= $this->showBlock($blockInstance);
        }

        return $templateContent;
    }

    /**
     * Gets the block content as a string
     * @param UIBlock $block
     * @return String
     */
    protected function showBlock(UIBlock $block){
        return $block->showBlock();
    }
}

/**
 * A Factory class for layouts. Uses Factory Design Pattern
 */
class LayoutFactory{

    /**
     * Creates UILayout instance by given name
     * @param string $name The name of the given layout
     * @todo Change the Exception instanse.
     * @return UILayout
     */
    public static function getLayout($name){
        if(class_exists($name)){
            $obj = new $name;

            if($obj instanceof UILayout){
                return $obj;
            }
            else{
                throw new Exception('Object '.$name.' is not a layout!!!');
            }
        }
        else{
            throw new Exception('Invalid layout...');
        }
    }
}
?>
