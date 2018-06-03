<?php
/**
 * Created by PhpStorm.
 * User: crafter
 * Date: 03/06/2018
 * Time: 21:46
 */

class Mdg_Giftregistry_Adminhtml_GiftregistryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function saveAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function massDeleteAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }
}