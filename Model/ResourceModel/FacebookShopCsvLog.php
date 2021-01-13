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
namespace Magepow\FacebookShopIntegration\Model\ResourceModel;

class FacebookShopCsvLog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize ResourceModel
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magepow_facebook_shop_csv_log', 'csv_id');
    }
}
