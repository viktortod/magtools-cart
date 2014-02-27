<?php
	class ListViewModel implements ViewModel {
		public function showPage(PageAbstract $page, $elementId=0){
			$table = $page->initTable();
			$tableContents = $table->parse();
			
			$page->getController()->setTemplateVariable("FMT_TABLE_CONTENT", $tableContents);
			$page->getController()->showTemplate($page->getPageTemplate());
		}
	}