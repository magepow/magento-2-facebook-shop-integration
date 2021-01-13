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
namespace Magepow\FacebookShopIntegration\Controller\Adminhtml;

abstract class Action extends \Magento\Backend\App\Action
{	
	/**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    /**
     * A factory that knows how to create a "page" result
     * Requires an instance of controller action in order to impose page type,
     * which is by convention is determined from the controller action class.
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
	/**
     * @var \Magepow\FacebookShopIntegration\Model\FacebookShopAttributeMappingFactory
     */
    protected $mappingModel;

    /**
     * [$_csvLogFactory description]
     * @var \Magepow\FacebookShopIntegration\Model\FacebookShopCsvLogFactory
     */
    protected $_csvLogFactory;
    /**
     * @var \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping
     */
    protected $mappingResource;
    /**
     * Registry object.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * File Factory.
     *
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;
    
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magepow\FacebookShopIntegration\Model\FacebookShopAttributeMappingFactory $mappingModel,
        \Magepow\FacebookShopIntegration\Model\FacebookShopCsvLogFactory $csvLogFactory,
        \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping\CollectionFactory $mappingCollectionFactory,
        \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping $mappingResource,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Backend\Helper\Js $jsHelper
	) {
		parent::__construct($context);
		$this->mappingModel = $mappingModel;
        $this->_csvLogFactory = $csvLogFactory;
        $this->mappingResource = $mappingResource;
       	$this->_coreRegistry = $coreRegistry;
        $this->_fileFactory = $fileFactory;
        $this->_jsHelper = $jsHelper;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultLayoutFactory = $resultLayoutFactory;
        $this->_resultForwardFactory = $resultForwardFactory;
		$this->_resultRedirectFactory = $context->getResultRedirectFactory();
        $this->mappingCollectionFactory = $mappingCollectionFactory;
        $this->dataPersistor = $dataPersistor;
	}

    protected function _isAllowed()
    {
        $namespace = (new \ReflectionObject($this))->getNamespaceName();
        $string = strtolower(str_replace(__NAMESPACE__ . '\\','', $namespace));
        $action =  explode('\\', $string);
        $action =  array_shift($action);
        return $this->_authorization->isAllowed("Magepow_FacebookShopIntegration::$action");
    }

}