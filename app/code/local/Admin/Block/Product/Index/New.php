<?php

class Admin_Block_Product_Index_New extends Core_Block_Template
{
    protected $_product;
    public function getProduct()
    {
        $request = Mage::getModel('core/request');
        $id = $request::getQuery('id');
        $data = Mage::getModel('catalog/product')
            ->load($id);
        return $data;
    }
    public function getCategories()
    {
        $data = Mage::getModel('catalog/category')->getCollection()->getData();
        // echo "<pre>";
        // print_r($data);
        // die;
        return $data;
    }
    public function getHtmlField($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $className = sprintf("Admin_Block_Html_Elements_%s", $field);
        $element = new $className($data);
        return $element->render();
    }
}