<?php
/**
 * User: Xavier
 * Date: 2019-02-05
 * Time: 16:06
 */
class Test_Xavierbaez_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * @return array
     */
    public function getRadioactiveColumnParams()
    {
        return array(
            'header' => 'radioactive',
            'index' => 'radioactive',
            'type' => 'options',
            'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
            'filter_condition_callback' => array('Test_Xavierbaez_Model_Observer', 'filterRadioactive'),
        );
    }
}
