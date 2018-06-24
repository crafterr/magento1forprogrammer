<?php
class Crafter_MyGrid_Model_Mysql4_Article extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mygrid/article", "entity_id");
    }
}