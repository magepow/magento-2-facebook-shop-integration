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
namespace Magepow\FacebookShopIntegration\Block\Adminhtml\Edit;

class GenericButton
{
    protected $context;
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context context
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context
    ) {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
    }

    public function getId()
    {
        return $this->context->getRequest()->getParam('entity_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route  route
     * @param array  $params params
     *
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
