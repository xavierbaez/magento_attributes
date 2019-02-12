<?php
/**
 * User: Xavier
 * Date: 2019-02-055
 * Time: 16:06
 */
/* @var $this Mage_Core_Model_Resource_Setup */
$this->startSetup();
$this->addAttribute(
    'catalog_product',
    'half_life',
    array(
        'group'           => 'General',
        'label'           => 'Half-life (seconds)',
        'input'           => 'text',
        'type'            => 'int',
        'required'        => 0,
        'visible_on_front'=> 1,
        'filterable'      => 0,
        'searchable'      => 0,
        'comparable'      => 0,
        'user_defined'    => 1,
        'is_configurable' => 0,
        'global'          => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'note'            => '',
        'class'           => '',
        'source'          => 'eav/entity_attribute_source_table',
        'default'         => 1000
    )
);
$this->endSetup();
