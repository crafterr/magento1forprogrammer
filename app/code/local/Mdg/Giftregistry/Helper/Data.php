<?php
class Mdg_Giftregistry_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var Mdg_Giftregistry_Model_Type
     */
    public function getEventTypes()
    {
       $collection = Mage::getModel('mdg_giftregistry/type')->getCollection();
       return $collection;

    }

    public function isRegistryOwner($registryCustomerId)
    {
        /**
         * @var Mage_Customer_Model_Session $currentCustomer[]
         */
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        if($currentCustomer && $currentCustomer->getId() == $registryCustomerId)
        {
            return true;
        }
        return false;
    }
}

