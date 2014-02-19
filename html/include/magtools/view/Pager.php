<?php

//Stranicirane. Podava mu se array i toj go reje
class Pager {
    const DEFAULT_ELEMENTS_PER_PAGE = 20;
    const DEFAULT_PAGE_PARAM = 'pagging';

    private $per_page;
    private $array;
    private $page_index;
    private $count;
    private $all_elems;
    private $page_var;

    public final function __construct($array) {
        $this->per_page = self::DEFAULT_ELEMENTS_PER_PAGE;
        $this->array = $array;
        $this->all_elems = $array;
        $this->page_index = getParamDefault(self::DEFAULT_PAGE_PARAM, 0);
        $this->page_var = self::DEFAULT_PAGE_PARAM;
        $this->count = count($array);
    }

    public final function setPageElements(){
        if($this->count <= $this->per_page){
            return $this->array;
        }
        else{
            $this->array = array_slice($this->array,(($this->page_index)*$this->per_page),$this->per_page);
            return $this->array;
        }
    }

    public function getPagesVariable(){
        $content = '';
        if($this->count <= $this->per_page){
            $content .= "<a href=\"#\" class=\"current_page\">".(1)."</a>";
            return $content;
        }
        if(count($this->all_elems)%$this->per_page==0){
            $pages = count($this->all_elems)/$this->per_page - 1;
        }
        else{
            $pages = ((count($this->all_elems)/$this->per_page));
        }

        $request = basename($_SERVER['REQUEST_URI']);

//        echo $request;
        if(isset($_GET[$this->page_var])){
            $to_replace_var = $this->page_var.'='.$this->page_index;
//            echo $to_replace_var;
            $request = str_replace($to_replace_var, "", $request);

             $request = str_replace("?" . $this->page_var, "", $request);
             $request = str_replace("&" . $this->page_var, "", $request);
            $request = str_replace("&&","&", $request);
        }


        for($i=0;$i<=$pages;$i++){
            if($i!=$this->page_index){
                $content .= '<a href="'.$request.''.$this->page_var.'='.$i.'">'.($i+1).'</a>';
            }
            else{
                $content .= '<a href="'.$request.''.$this->page_var.'='.$i.'" class="current_page">'.($i+1).'</a>';
            }

        }

        return $content;
    }
}
?>
