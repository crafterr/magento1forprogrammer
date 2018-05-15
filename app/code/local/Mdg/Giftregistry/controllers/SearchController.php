<?php
class Mdg_Giftregistry_SearchController extends Mage_Core_Controller_Front_Action
{

    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->getResponse()->setRedirect(Mage::helper('customer')->getLoginUrl());
            $this->setFlag('',self::FLAG_NO_DISPATCH,true);
        }
    }

    public function resultsAction()
    {
        $this->loadLayout();
        if ($searchParams = $this->getRequest()->getParam('search_params')) {
        $results = Mage::getModel('mdg_giftregistry/entity')->getCollection();
        if($searchParams['type']){
            $results->addFieldToFilter('type_id', $searchParams['type']);
        }
        if($searchParams['date']){
            $results->addFieldToFilter('event_date', $searchParams['date']);
        }
        if($searchParams['location']){
            $results->addFieldToFilter('event_location', $searchParams['location']);
        }
        $this->getLayout()->getBlock('mdg_giftregistry.search.results')->setResults($results);
    }
    $this->renderLayout();
    return $this;
}
}
