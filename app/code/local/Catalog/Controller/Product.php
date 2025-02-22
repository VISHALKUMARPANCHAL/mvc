<?php
class Catalog_Controller_Product
{
    public function viewAction()
    {
        // $product = Mage::getModel('catalog/product');

        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view');
        $layout->getChild('content')->addChild('view', $view);
        // print_r($layout->getChild('content'));
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('catalog/product_list');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
        // echo "class : " . __CLASS__ . "<br>";
        // echo "function : " . __FUNCTION__;
    }
    public function testAction()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('product_id', ['<' => 40])
            ->addFieldToFilter('product_id', ['IN' => [2, 3, 4]])
            // ->leftJoin('catlog_category', 'catlog_category.category_id = catlog_product.category_id', ['category_name' => 'name'])
            // ->rightJoin('catlog_category', 'catlog_category.category_id = catlog_product.category_id', ['category_name' => 'name']);
            // ->innerJoin('catlog_category', 'catlog_category.category_id = catlog_product.category_id', ['category_name' => 'name']);
            // ->join('catlog_category', 'catlog_category.category_id = catlog_product.category_id', ['category_name' => 'name']);
            // ->fullJoin('catlog_category', ['category_name' => 'name']);
            ->selfJoin(['A', 'B'], ['name' => 'A.name', 'pr' => 'B.price']);
        // ->crossJoin('catlog_category', ['category_name' => 'name']);
        // ->naturalJoin('catlog_category', ['category_name' => 'name']);
        // ->groupBy(['name', 'price'])
        // ->having('COUNT(*)', ['<' => 40]);
        // ->orderBy(['product_id DESC', 'name ASC'])
        // ->limit(1, 2);
        echo "<pre>";
        print_r($product);
        $product->prepareQuery();
    }
}