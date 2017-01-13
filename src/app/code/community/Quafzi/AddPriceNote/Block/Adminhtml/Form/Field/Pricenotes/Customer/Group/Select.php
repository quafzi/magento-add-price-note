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
 * Price Notes Customer Group Select
 *
 * @package   Quafzi_AddPriceNote
 * @author    Thomas Birke <magento@netextreme.de>
 */
class Quafzi_AddPriceNote_Block_Adminhtml_Form_Field_Pricenotes_Customer_Group_Select
    extends Mage_Core_Block_Html_Select
{
    protected function _construct()
    {
        $this
            ->setClass('select')
            ->setTitle(Mage::helper('quafzi_addpricenote')->__('Select customer group'));
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
