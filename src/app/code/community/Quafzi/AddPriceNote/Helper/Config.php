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
 * Config helper
 *
 * @package   Quafzi_AddPriceNote
 * @author    Thomas Birke <magento@netextreme.de>
 */
class Quafzi_AddPriceNote_Helper_Config extends Mage_Core_Helper_Abstract
{
    protected function getGroupConfig()
    {
        $config = @unserialize(Mage::getStoreConfig('catalog/price/price_notes'));
        if ($config) {
            $customerGroupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
            $groupConfigs = array_filter($config, function ($groupConfig) use ($customerGroupId) {
                return $groupConfig['customer_group_id'] == $customerGroupId;
            });
            if ($groupConfigs) {
                return current($groupConfigs);
            }
        }
    }

    public function getLinkTarget()
    {
        return $this->getGroupConfig()['link_target'];
    }

    public function getLinkText()
    {
        return $this->getGroupConfig()['link_text'];
    }
}
