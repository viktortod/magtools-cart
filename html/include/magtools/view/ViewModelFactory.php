<?php
	class ViewModelFactory {
		private $handlers = array(
			PageTypes::PAGE_TYPE_LIST => "ListViewModel",
			PageTypes::PAGE_TYPE_VIEW => "CreateViewModel",
			PageTypes::PAGE_TYPE_CHANGE => "EditViewModel"
		);
		
		protected $handler;
		
		public function getInstance($pageType){
			$this->handler = $this->handlers[$pageType];
			$instance = new $this->handler();
			return $instance;
		}
	}