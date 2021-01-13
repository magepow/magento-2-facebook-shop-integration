<?php
/**
 * Magepow 
 * @category    Magepow 
 * @copyright   Copyright (c) 2014 Magepow (http://www.magepow.com/) 
 * @license     http://www.magepow.com/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2020-09-30 17:38:38
 * @@Function:
 */
namespace Magepow\FacebookShopIntegration\Model\Attribute\Source;

class FbProductCondition extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('New'), 'value' => 'new'],
                ['label' => __('Refurbished'), 'value' => 'refurbished'],
                ['label' => __('Used (Fair)'), 'value' => 'used_fair'],
                ['label' => __('Used (Good)'), 'value' => 'used_good'],
                ['label' => __('Used (Like New)'), 'value' => 'used_like_new'],
            ];
        }
        return $this->_options;
    }
}
