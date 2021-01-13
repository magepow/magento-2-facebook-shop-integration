<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2016-01-05 10:40:51
 * @@Modify Date: 2020-09-30 17:38:38
 * @@Function:
 */
namespace Magepow\FacebookShopIntegration\Model\ResourceModel;

class FacebookShopAttributeMapping extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Block grid entity table
     *
     * @var string
     */
    protected $_blockProductTable;
    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magepow_facebook_shop_attribute_mapping', 'entity_id');
    }
}
