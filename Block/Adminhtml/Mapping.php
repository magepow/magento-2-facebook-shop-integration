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
namespace Magepow\FacebookShopIntegration\Block\Adminhtml;

class Mapping extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_facebook_shop_integration_mapping';
        $this->_blockGroup = 'Magepow_FacebookShopIntegration';
        $this->_headerText = __('Facebbok Shop Attribute Mapping');
        $this->_addButtonLabel = __('Add New Attribute');
        parent::_construct();
    }
}
