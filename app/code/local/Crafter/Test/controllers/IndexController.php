<?php
class Crafter_Test_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Titlename"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("titlename", array(
                "label" => $this->__("Titlename"),
                "title" => $this->__("Titlename")
		   ));

      $this->renderLayout(); 
	  
    }

    /**
     * Example of single controller action returning JSON response
     */
    public function jsonAction()
    {
        /**
         * @var Crafter_Test_Model_Product $product
         */
        $post['ids'] = [1,2,3,4,5];
       // if ($this->getRequest()->isPost()) {
           // $post = $this->getRequest()->getPost();
            $productModel = Mage::getModel('Test/Product');
            $collectionProducts = $productModel->getLoadedProductCollection($post['ids']);
            $collection = Mage::helper('Test')->toArray($collectionProducts);
            $this->getResponse()->clearHeaders()->setHeader(
                'Content-type',
                'application/json'
            );
            // Set the response body / contents to be the JSON data
            $this->getResponse()->setBody(
                Mage::helper('core')->jsonEncode($collection)
            );



    }
}