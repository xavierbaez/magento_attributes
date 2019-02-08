<?php

class Test_Xavierbaez_Model_Observer {

    /**
     * @param \Varien_Event_Observer $observer
     */
    function checkRadioActive(Varien_Event_Observer $observer) {
        /** @var $orderInstance Mage_Sales_Model_Order */
        $orderInstance = $observer->getOrder();
        $items = $orderInstance->getAllItems();
        $minValue = Mage::getStoreConfig('test_xavierbaez/threshold_value');;
        foreach ($items as $item) {
            if ($item->getHalfLife() < $minValue) {
                $orderInstance->setContainsRadioactiveItem(Mage::helper('sales')->__('Yes'));
                break;
            }
        }
        Mage::log($orderInstance,null,"radioactive.log",true);
    }
}