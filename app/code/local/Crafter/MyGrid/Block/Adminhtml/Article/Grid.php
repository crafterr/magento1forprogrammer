<?php

class Crafter_MyGrid_Block_Adminhtml_Article_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("articleGrid");
				$this->setDefaultSort("entity_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("mygrid/article")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("entity_id", array(
				"header" => Mage::helper("mygrid")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "entity_id",
				));
                
				$this->addColumn("title", array(
				"header" => Mage::helper("mygrid")->__("Title"),
				"index" => "title",
				));
				$this->addColumn("description", array(
				"header" => Mage::helper("mygrid")->__("Description"),
				"index" => "description",
				));
					$this->addColumn('created_at', array(
						'header'    => Mage::helper('mygrid')->__('Created At'),
						'index'     => 'created_at',
						'type'      => 'datetime',
					));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('entity_id');
			$this->getMassactionBlock()->setFormFieldName('entity_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_article', array(
					 'label'=> Mage::helper('mygrid')->__('Remove Article'),
					 'url'  => $this->getUrl('*/adminhtml_article/massRemove'),
					 'confirm' => Mage::helper('mygrid')->__('Are you sure?')
				));
			return $this;
		}
			

}