<?php
class Crafter_MyGrid_Block_Adminhtml_Article_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("mygrid_form", array("legend"=>Mage::helper("mygrid")->__("Item information")));

				
						$fieldset->addField("title", "text", array(
						"label" => Mage::helper("mygrid")->__("Title"),
						"name" => "title",
						));
					
						$fieldset->addField("description", "text", array(
						"label" => Mage::helper("mygrid")->__("Description"),
						"name" => "description",
						));
					
						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
							Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
						);

						$fieldset->addField('created_at', 'date', array(
						'label'        => Mage::helper('mygrid')->__('Created At'),
						'name'         => 'created_at',
						'time' => true,
						'image'        => $this->getSkinUrl('images/grid-cal.gif'),
						'format'       => $dateFormatIso
						));

				if (Mage::getSingleton("adminhtml/session")->getArticleData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getArticleData());
					Mage::getSingleton("adminhtml/session")->setArticleData(null);
				} 
				elseif(Mage::registry("article_data")) {
				    $form->setValues(Mage::registry("article_data")->getData());
				}
				return parent::_prepareForm();
		}
}
