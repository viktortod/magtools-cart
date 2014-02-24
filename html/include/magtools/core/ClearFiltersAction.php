<?php
class ClearFiltersAction extends Action{
    public function execute(){
        jsSession::removeFilters();
    }
    
    public function  postExecute() {
        Controller::redirect('?page=');
    }
}