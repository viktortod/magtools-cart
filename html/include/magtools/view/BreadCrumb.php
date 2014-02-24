<?php
	class BreadCrumb {
		private $_links = array();
		
		public function __construct(){
		
		}
		
		public function add($link, $label){
			$this->_links[$link] = $label;
		}
		
		public function parseBreadCrumb(){
			$html = array();
			foreach($this->_links as $link => $label){
				$html[]= '<a href="'.$link.'" >'.$label.'</a>';
			}
			
			return join('<div class="breadcrumb_divider"></div>', $html);
		}
	}