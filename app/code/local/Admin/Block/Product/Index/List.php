<?php

class Admin_Block_Product_Index_List extends Core_Block_Template
{
    public function getData()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection();
        $data = $product->getData();
        return $data;
    }
}