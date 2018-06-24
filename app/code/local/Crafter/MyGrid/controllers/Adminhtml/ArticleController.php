<?php

class Crafter_MyGrid_Adminhtml_ArticleController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('mygrid/article');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("mygrid/article")->_addBreadcrumb(Mage::helper("adminhtml")->__("Article  Manager"),Mage::helper("adminhtml")->__("Article Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("MyGrid"));
			    $this->_title($this->__("Manager Article"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("MyGrid"));
				$this->_title($this->__("Article"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("mygrid/article")->load($id);
				if ($model->getId()) {
					Mage::register("article_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("mygrid/article");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Article Manager"), Mage::helper("adminhtml")->__("Article Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Article Description"), Mage::helper("adminhtml")->__("Article Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("mygrid/adminhtml_article_edit"))->_addLeft($this->getLayout()->createBlock("mygrid/adminhtml_article_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("mygrid")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("MyGrid"));
		$this->_title($this->__("Article"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("mygrid/article")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("article_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("mygrid/article");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Article Manager"), Mage::helper("adminhtml")->__("Article Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Article Description"), Mage::helper("adminhtml")->__("Article Description"));


		$this->_addContent($this->getLayout()->createBlock("mygrid/adminhtml_article_edit"))->_addLeft($this->getLayout()->createBlock("mygrid/adminhtml_article_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("mygrid/article")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Article was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setArticleData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setArticleData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("mygrid/article");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('entity_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("mygrid/article");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'article.csv';
			$grid       = $this->getLayout()->createBlock('mygrid/adminhtml_article_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'article.xml';
			$grid       = $this->getLayout()->createBlock('mygrid/adminhtml_article_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
