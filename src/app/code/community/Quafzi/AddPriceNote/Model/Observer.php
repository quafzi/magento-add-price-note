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
        $helper = Mage::helper('quafzi_addpricenote/config');
        if (($linkTarget = $helper->getLinkTarget())
            && ($linkText = $helper->getLinkText())
        ) {
            $observer->getEvent()->getHtmlObj()->setHtml(
                '<div style="margin-bottom: 5px; margin-top: -5px">'
                . '<a href="' . $linkTarget . '" onclick="window.open(this.href); return false" style="text-decoration: underline">'
                . $linkText . '</a></div>'
                . $observer->getEvent()->getHtmlObj()->getHtml()
            );
        }
    }
}
