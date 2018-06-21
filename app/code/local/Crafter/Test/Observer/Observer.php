<?php
class Crafter_Test_Observer_Observer
{

    public function filterProductCollection($observer)
    {
        $product = $observer->getProduct();
        Zend_Debug::dump($product);
        $observer->getEvent()->getCollection()
            ->joinField('is_in_stock',
                'cataloginventory/stock_item',
                'is_in_stock',
                'product_id=entity_id',
                'is_in_stock=1 or is_in_stock=0',
                '{{table}}.stock_id=1',
                'left');
    }
}
	 