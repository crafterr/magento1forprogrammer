<?php
class Crafter_Test_Helper_Data extends Mage_Core_Helper_Abstract
{


    /**
     * @param Mage_Catalog_Model_Resource_Product_Collection $collection
     * @return array
     */
    public function toArray(Mage_Catalog_Model_Resource_Product_Collection $collection)
    {
        $data = [];
        if ($collection->count()>0) {
            foreach ($collection as $key => $product) {
                $data[$key]['id'] = $product->getId();
                $data[$key]['name'] = $product->getName();
                $data[$key]['price'] = $product->getFinalPrice();
            }
        }

        Zend_Debug::dump($data); die();
        return $data;
    }
}
	 