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
 * Observer class
 *
 * @package   Quafzi_AddPriceNote
 * @author    Thomas Birke <magento@netextreme.de>
 */
class Quafzi_AddPriceNote_Model_Observer
{
    public function addPriceNote (Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Catalog_Block_Product_Price
            && ($linkTarget = Mage::helper('quafzi_addpricenote/config')->getLinkTarget())
            && ($linkText = Mage::helper('quafzi_addpricenote/config')->getLinkText())
        ) {
            $observer->getEvent()->getTransport()->setHtml(
                $observer->getEvent()->getTransport()->getHtml()
                . '<a href="' . $linkTarget . '">' . $linkText . '</a>'
            );
        }
    }
}
