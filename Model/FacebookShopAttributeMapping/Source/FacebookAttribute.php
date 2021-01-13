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
namespace Magepow\FacebookShopIntegration\Model\FacebookShopAttributeMapping\Source;

use Magento\Framework\Data\OptionSourceInterface;

class FacebookAttribute implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['label' => 'id', 'value' => 'id'],
            ['label' => 'title', 'value' => 'title'],
            ['label' => 'description', 'value' => 'description'],
            ['label' => 'condition', 'value' => 'condition'],
            ['label' => 'link', 'value' => 'link'],
            ['label' => 'image_link', 'value' => 'image_link'],
            ['label' => 'brand', 'value' => 'brand'],
            ['label' => 'additional_image_link', 'value' => 'additional_image_link'],
            ['label' => 'age_group', 'value' => 'age_group'],
            ['label' => 'color', 'value' => 'color'],
            ['label' => 'gender', 'value' => 'gender'],
            ['label' => 'google_product_category', 'value' => 'google_product_category'],
            ['label' => 'material', 'value' => 'material'],
            ['label' => 'pattern', 'value' => 'pattern'],
            ['label' => 'product_type', 'value' => 'product_type'],
            ['label' => 'sale_price', 'value' => 'sale_price'],
            ['label' => 'sale_price_effective_date', 'value' => 'sale_price_effective_date'],
            ['label' => 'shipping', 'value' => 'shipping'],
            ['label' => 'shipping_weight', 'value' => 'shipping_weight'],
            ['label' => 'size', 'value' => 'size'],
            ['label' => 'custom_option', 'value' => 'custom_option'],
        ];
        return $options;
    }
}
