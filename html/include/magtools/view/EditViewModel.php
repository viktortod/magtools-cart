<?php
	class EditViewModel implements ViewModel {
		public function showPage(PageAbstract $page, $elementId=0){
			$page->getController()->setTemplateVariable("PAGE_ELEMENT", $elementId);
			$page->getController()->setTemplateVariable("MAIN_FORM_ACTION", '?page=edit&action=doEdit');
			
			if($elementId > 0){
				$element = $page->getDomainObject()->getElement($elementId);
				$page->parseWebForm($element);
			}

			$page->getController()->showTemplate($page->getPageTemplate());
		}
	}