<?php
class Admin_Controller_Customer_Index
{
    public function newAction()
    {
        echo "class : " . __CLASS__ . "<br>";
        echo "function : " . __FUNCTION__;
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/product_index_new')
            ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function listAction()
    {
        echo "class : " . __CLASS__ . "<br>";
        echo "function : " . __FUNCTION__;
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/product_index_list')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        echo "class : " . __CLASS__ . "<br>";
        echo "function : " . __FUNCTION__;
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('admin/product_index_save')
            ->setTemplate('admin/product/index/save.phtml');
        $layout->getChild('content')->addChild('save', $save);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        echo "class : " . __CLASS__ . "<br>";
        echo "function : " . __FUNCTION__;
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('admin/product_index_delete')
            ->setTemplate('admin/product/index/delete.phtml');
        $layout->getChild('content')->addChild('delete', $delete);
        $layout->toHtml();
    }
}