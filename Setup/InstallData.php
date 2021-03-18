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
namespace Magepow\FacebookShopIntegration\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magepow\FacebookShopIntegration\Model\FacebookShopAttributeMappingFactory;

class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var FacebookShopAttributeMappingFactory
     */
    protected $mappingFactory;

    /**
     * InstallData constructor.
     *
     * @param EavSetupFactory $eavSetupFactory
     * @param FacebookShopAttributeMappingFactory $mappingFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        FacebookShopAttributeMappingFactory $mappingFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->mappingFactory = $mappingFactory;
    }

    /**
     * Install data
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'facebook_product',
            [
                'group' => 'Facebook Shop Integration',
                'type' => 'text',
                'backend' => '',
                'frontend' => '',
                'label' => 'Show Product On Facebook',
                'input' => 'boolean',
                'class' => '',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'note' => 'Select yes to display product on facebook shop'
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'fb_product_condition',
            [
                'group' => 'Facebook Shop Integration',
                'type' => 'varchar',
                'backend' => '',
                'frontend' => '',
                'label' => 'Facebook Product Condition',
                'input' => 'select',
                'class' => '',
                'source' => \Magepow\FacebookShopIntegration\Model\Attribute\Source\FbProductCondition::class,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'note' => 'Product condition for product in facebook shop'
            ]
        );

        /**
         * Add attributes to the eav_attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'google_product_category',
            [
                'group' => 'Facebook Shop Integration',
                'type'         => 'varchar',
                'backend'      => '',
                'frontend'     => '',
                'label'        => 'Google Product Category',
                'input'        => 'text',
                'global'       => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible'      => true,
                'required'     => false,
                'user_defined' => true,
                'default'      => '',
                'searchable'   => false,
                'filterable'   => false,
                'comparable'   => false,
                'is_used_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible_on_front'        => false,
                'used_in_product_listing' => true,
                'unique'       => false,
                'note' => 'Set product item category based on standard taxonomy defined by Google: https://support.google.com/merchants/answer/6324436. You can specify either the string representation or the numeric representation of your category.'
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,
            'google_category',
            [
                'group' => 'Facebook Shop Integration',
                'type'         => 'varchar',
                'backend'      => '',
                'frontend'     => '',
                'label'        => 'Google Product Category',
                'input'        => 'text',
                'sort_order'   => 10,
                'source'       => '',
                'global'       => ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible'      => true,
                'required'     => false,
                'user_defined' => true,
                'default'      => null,
                'note' => 'Set category based on standard taxonomy defined by Google: https://support.google.com/merchants/answer/6324436. You can specify either the string representation or the numeric representation of your category.'
            ]
        );

        $attributes = [
            ['id', 'sku'],
            ['title', 'name'],
            ['description', 'description'],
            ['availability', 'quantity_and_stock_status'],
            ['condition', 'fb_product_condition'],
            ['image_link', 'image'],
            ['brand', 'country_of_manufacture']
        ];

        foreach ($attributes as $attribute) {
            $this->mappingFactory->create()
            ->setFacebookAttribute($attribute[0])
            ->setMagentoAttribute($attribute[1])
            ->save();
        }
    }
}
