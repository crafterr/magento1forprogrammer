<?php


class Crafter_MyGrid_Block_Adminhtml_Article extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_article";
	$this->_blockGroup = "mygrid";
	$this->_headerText = Mage::helper("mygrid")->__("Article Manager");
	$this->_addButtonLabel = Mage::helper("mygrid")->__("Add New Item");
	parent::__construct();
	
	}

}