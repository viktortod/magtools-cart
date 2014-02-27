<?php
	class CreateViewModel implements ViewModel {
		public function showPage(PageAbstract $page, $elementId=0){
			$page->parseWebForm();
			$page->getController()->setTemplateVariable("MAIN_FORM_ACTION", '?page=create&action=doCreate');
			
			$element = $page->getDomainObject()->getElement($elementId);
			if( $element !== false){
            	$page->getController()->setTemplateArray($element);
            }

			$page->getController()->showTemplate($page->getPageTemplate());
		}
	}