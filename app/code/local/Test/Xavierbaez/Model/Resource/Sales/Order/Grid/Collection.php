<?php

/**
 * Class Test_Xavierbaez_Model_Resource_Sales_Order_Grid_Collection
 */
class Test_Xavierbaez_Model_Resource_Sales_Order_Grid_Collection extends Mage_Sales_Model_Resource_Order_Grid_Collection
{

    /**
     * @return \Varien_Db_Select
     * @throws \Zend_Db_Select_Exception
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();

        if (Mage::app()->getRequest()->getControllerName() == 'sales_order') {
            $countSelect->reset(Zend_Db_Select::GROUP);
            $countSelect->reset(Zend_Db_Select::COLUMNS);
            $countSelect->columns("COUNT(DISTINCT main_table.entity_id)");

            $havingCondition = $countSelect->getPart(Zend_Db_Select::HAVING);
            if (count($havingCondition)) {
                $countSelect->where(
                    str_replace("group_concat(`sales_flat_order_item`.sku SEPARATOR ', ')", 'sales_flat_order_item.sku', $havingCondition[0])
                );
                $countSelect->reset(Zend_Db_Select::HAVING);
            }
        }

        return $countSelect;
    }

    /**
     * @return \Mage_Core_Model_Resource_Db_Collection_Abstract
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('store_id', 'main_table.store_id')
            ->addFilterToMap('created_at', 'main_table.created_at')
            ->addFilterToMap('updated_at', 'main_table.updated_at');
        return parent::_initSelect();
    }
}
