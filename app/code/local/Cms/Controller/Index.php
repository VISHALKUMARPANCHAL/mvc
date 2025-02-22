<?php
class Cms_Controller_index extends Core_Controller_Front_Action
{
    public function __construct() {}
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $layout->toHtml();
        echo "class : " . __CLASS__ . "<br>";
        echo "function : " . __FUNCTION__;
    }
}