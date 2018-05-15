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


    public function viewAction()
    {
        $registryId = $this->getRequest()->getParam('registry_id');
        if ($registryId) {
            $entity = Mage::getModel('mdg_giftregistry/entity');
            if ($entity->load($registryId)) {
                Mage::registry('loaded_registry',$entity);
                $this->loadLayout();
                $this->_initLayoutMessages('customer/session');
                $this->renderLayout();
                return $this;
            } else {
                $this->_forward('noroute');
                return $this;
            }
        }
    }
}
