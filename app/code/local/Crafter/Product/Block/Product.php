<?php   
class Crafter_Product_Block_Product extends Mage_Core_Block_Template
{

    public function renderText()
    {
        return 'Adam ma kota';
        //return Mage::getModel('Crafter_Product/Article_Article');
    }
    public function test()
    {
        $resource = Mage::getModel('core/resource');

        \Zend_Debug::dump($resource);
    }
}