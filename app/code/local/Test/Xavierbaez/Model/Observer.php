<?php

class Test_Xavierbaez_Model_Observer
{

    const attr = '212';

    /**
     * @param $observer
     */
    public function salesOrderGridCollectionLoadBefore($observer)
    {
        $minValue = Mage::getStoreConfig('test_xavierbaez/threshold_value');
        $attribute = self::attr;
        $collection = $observer->getOrderGridCollection();
        /** @var Varien_Db_Select $select */
        $select = $collection->getSelect();
        $select->join('sales_flat_order_item', '`sales_flat_order_item`.order_id=`main_table`.entity_id');
        $select->join('catalog_product_entity_int','`catalog_product_entity_int`.entity_id=`sales_flat_order_item`.product_id',
            array('attributes' => new Zend_Db_Expr('group_concat(`catalog_product_entity_int`.attribute_id SEPARATOR ", ")'),
                'values' => new Zend_Db_Expr('group_concat(`catalog_product_entity_int`.value SEPARATOR ", ")'),
                'radioactive' => new Zend_Db_Expr('IF(STRCMP(\'' . $attribute . '\',group_concat(`catalog_product_entity_int`.attribute_id SEPARATOR ", ")) AND STRCMP(\'' . $minValue . '\',`catalog_product_entity_int`.value), 1,0)'
                )
            )
        );
        $select->group('main_table.entity_id');
    }

    /**
     * @param $collection
     * @param $column
     * @return $this|null
     */
    public function filterRadioactive($collection, $column)
    {
        #echo 'function: ' . __FUNCTION__ . "<br>\n";
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }

        $collection->getSelect()->having(
            "IF(STRCMP('212',`catalog_product_entity_int`.attribute_id) AND STRCMP('1000',`catalog_product_entity_int`.value),'yes','no') like ?",
            "%$value%"
        );

        return $this;
    }
}
