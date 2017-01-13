<?php
/**
 * This file is part of Quafzi_AddPriceNote
 *
 * PHP version 7
 *
 * @package   Quafzi_AddPriceNote
 * @author    Thomas Birke <magento@netextreme.de>
 * @copyright 2017 Thomas Birke
 * @license   OSL-3.0
 */

/**
 * Price Notes Form
 *
 * @package   Quafzi_AddPriceNote
 * @author    Thomas Birke <magento@netextreme.de>
 */
class Quafzi_AddPriceNote_Block_Adminhtml_Form_Field_Pricenotes
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    /**
     * @var Mage_Core_Block_Html_Select
     */
    protected $_templateRenderer;

    protected $_customerGroupsOptions;

    protected function getCustomerGroupsOptions()
    {
        if (!$this->_customerGroupsOptions) {
            $this->_customerGroupsOptions = Mage::getResourceModel('customer/group_collection')
                ->loadData()->toOptionArray();
            array_unshift($this->_customerGroupsOptions, [
                'value'=> '',
                'label'=> Mage::helper('adminhtml')->__('-- Please Select --')
            ]);
        }
        return $this->_customerGroupsOptions;
    }

    /**
     * Create renderer used for displaying the country select element
     *
     * @return Mage_Core_Block_Html_Select
     */
    protected function _getCustomerGroupSelectRenderer()
    {
        if (!$this->_templateRenderer) {
            $this->_templateRenderer = $this->getLayout()->createBlock(
                'quafzi_addpricenote/adminhtml_form_field_pricenotes_customer_group_select',
                '',
                [ 'is_render_to_js_template' => true ]
            );

            /* @var $sourceModel Mage_Adminhtml_Model_System_Config_Source_Customer_Group */
            $this->_templateRenderer->setOptions($this->getCustomerGroupsOptions());
        }

        return $this->_templateRenderer;
    }

    /**
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract::_prepareArrayRow()
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getCustomerGroupSelectRenderer()->calcOptionHash($row->getData('customer_group_id')),
            'selected="selected"'
        );

        return parent::_prepareArrayRow($row);
    }

    /**
     * (non-PHPdoc)
     * @see Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract::_prepareToRender()
     */
    protected function _prepareToRender()
    {
        $this->addColumn('customer_group_id', array(
            'label' => Mage::helper('quafzi_addpricenote')->__('Customer Group'),
            'renderer' => $this->_getCustomerGroupSelectRenderer()
        ));
        $this->addColumn('link_target', array(
            'label' => Mage::helper('quafzi_addpricenote')->__('Link Target'),
            'style' => 'width:100px',
        ));
        $this->addColumn('link_text', array(
            'label' => Mage::helper('quafzi_addpricenote')->__('Link Text'),
            'style' => 'width:100px',
        ));
        // hide "Add after" button
        $this->_addAfter = false;

        return parent::_prepareToRender();
    }
}
