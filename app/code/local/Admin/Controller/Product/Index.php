<?php
class Admin_Controller_Product_Index
{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/product_index_new')
            ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')
            // ->removeCss()
            ->addCss('page/product/test.css')
            // ->removeJs()
            ->addJs('page/product/test.js');

        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/product_index_list')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $product->setData($request->getParam('catlog_product'));
        // echo "<pre>";
        $oldimage = $request->getParam('oldimage');
        if ($_FILES['catlog_product']['name']['image'] !== "") {
            if (file_exists($oldimage)) {
                unlink($oldimage);
            }
            $filename = $_FILES['catlog_product']['name']['image'];
            $filepath = "media/product/{$filename}";
            $from = $_FILES['catlog_product']['tmp_name']['image'];
            $basedir = Mage::getBaseDir();
            $to = "{$basedir}/media/product";
            move_uploaded_file($from, "{$to}/$filename");
            $product->setImage($filepath);
        } else {
            $product->setImage($oldimage);
        }
        $product->save();
        header('Location: http://localhost/mvc/admin/product_index/list');
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $productId = $request->getQuery('id');
        $image = $product->load($productId)->getData()['image'];
        if (file_exists($image)) {
            unlink($image);
        }
        $product->setData($productId);
        $product->delete();
        header('Location: http://localhost/mvc/admin/product_index/list');
    }

    /* for testing purpose only */
    public function testAction()
    {
        $layout = Mage::getBlock('core/layout');
        $test = $layout->createBlock('admin/product_index_test')
            ->setTemplate('admin/product/index/test.phtml');
        $layout->getChild('content')->addChild('test', $test);
        $layout->toHtml();
    }
}
