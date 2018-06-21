<?php
class Crafter_Test_Observer_ObserverTwo
{

    public function product_prepare_save($observer)
    {
        $product = $observer->getProduct();
        $stockData = $product->getStockData();
        if ($product && (int) $product->getData('soon_in_store')) {
            Mage::log('weszlo',1,'moj_plik.log');
           // $stockData->setData('is_in_stock', 1);
            $stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getEntityId()); // Load the stock for this product use for
            $stock->setData('is_in_stock', 1); // Set the Product to InStock
            $stock->save(); // Save use for

        }

    }
}
	 