<?php
class Mdg_Giftregistry_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Type Collection
     */
    public function getEventTypes()
    {
       $collection = Mage::getModel('mdg_giftregistry/type')->getCollection();
       return $collection;

    }
}

