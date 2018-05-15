<?php   
class Crafter_Product_Block_Index extends Mage_Core_Block_Template{   



    public function getAdam()
    {
        return 'Adam ma kota';
        //return Mage::getModel('Crafter_Product/Article_Article');
    }

    public function getProducts()
    {
        $collection =  Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('*');
        $collection->addFieldToFilter('created_at',['from'=>'2017-05-05']);
        $collection->addFieldToFilter('created_at',['to'=>'2019-05-05']);
        $collection->addAttributeToFilter('visibility',4);

        $collection->setOrder('name', 'asc');

        return $collection;
    }

    public function getCategory()
    {
        $category = Mage::getModel('catalog/category')->load(3);


        return $category;
    }

    public function getProductByCategory()
    {
       $category = $this->getCategory();
       return  $category->getProductCollection()->addAttributeToSelect('*');

    }

    public function getProduct()
    {
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $product = Mage::getModel('catalog/product')->load(1);

        return $product;
    }

    public function getBestSellers()
    {
        //zaladuj kategorie o id 3 w tym przypadku Bluzki
        $category = Mage::getModel('catalog/category')->load(0);

        $productCollection = $category->getProductCollection()
                                       ->addAttributeToSelect('*')
                                       ->load();

        $productCollection->getSelect()
            ->join(
                array('o'=> 'sales_flat_order_item'),
                'main_table.entity_id = o.product_id',
                array('o.row_total','o.product_id'))
            ->group(array('sku'));

        $productCollection->addAttributeToFilter('visibility', 4);
        //echo $productCollection->getSelect()->__toString(); die();

        return $productCollection;

    }
}