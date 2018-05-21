<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 21/05/2018
 * Time: 20:45
 */

class Crafter_Test_Model_Product extends Mage_Core_Model_Abstract
{
    /**
     * Product Collection
     *
     * @var Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected $productCollection;


    /**
     * @return mixed
     */
    public function getLoadedProductCollection(array $productIds)
    {
        $collection = $this->_getProductCollection($productIds);
        return $collection;
    }

    /**
     * Return product collection to be displayed by our list block
     *
     * @return Mage_Catalog_Model_Resource_Product_Collection
     */
    protected function _getProductCollection(array $productIds)
    {
        if (is_null($this->productCollection)) {
            $this->productCollection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
                ->addAttributeToFilter('entity_id', array('in' => $productIds))
                ->addMinimalPrice()
                ->addFinalPrice()
                ->addTaxPercents();

            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($this->productCollection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInSiteFilterToCollection($this->productCollection);
        }
        return $this->productCollection;

    }
}