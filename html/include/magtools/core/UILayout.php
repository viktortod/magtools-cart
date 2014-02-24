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
?>
