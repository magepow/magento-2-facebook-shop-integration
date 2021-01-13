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

class MagentoAttribute implements OptionSourceInterface
{
    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute\CollectionFactory
     */
    protected $eavAttribute;

    /**
     * @var \Magento\Eav\Model\Entity
     */
    protected $entity;

    /**
     * MagentoAttribute constructor.
     *
     * @param \Magento\Eav\Model\ResourceModel\Entity\Attribute\CollectionFactory $eavAttribute
     * @param \Magento\Eav\Model\Entity $entity
     */
    public function __construct(
        \Magento\Eav\Model\ResourceModel\Entity\Attribute\CollectionFactory $eavAttribute,
        \Magento\Eav\Model\Entity $entity
    ) {
        $this->eavAttribute = $eavAttribute;
        $this->entity = $entity;
    }
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $attributeCollection = $this->eavAttribute->create();
        $attributeCollection->addFieldToSelect('attribute_code')->addFieldToFilter(
            'entity_type_id',
            $this->entity->setType('catalog_product')->getTypeId()
        );
        $options = [];
        foreach ($attributeCollection as $attribute) {
            $options[] = [
                'label' => $attribute->getAttributeCode(),
                'value' => $attribute->getAttributeCode()
            ];
        }
        return $options;
    }
}
