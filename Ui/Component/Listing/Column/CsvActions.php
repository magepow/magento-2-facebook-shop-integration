<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magepow\FacebookShopIntegration\Ui\Component\Listing\Column;

class CsvActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /** Url path */
    const URL_PATH_DELETE = 'facebook_shop_integration/csvlog/delete';

    /**
     * @var \Magepow\FacebookShopIntegration\Block\Adminhtml\Tags\Grid\Renderer\Action\UrlBuilder
     */
    protected $actionUrlBuilder;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
         \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magepow\FacebookShopIntegration\Block\Adminhtml\CsvLog\Grid\Renderer\Action\UrlBuilder $actionUrlBuilder,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['csv_id'])) {
                    
                    $escaper = \Magento\Framework\App\ObjectManager::getInstance()
                                ->get(\Magento\Framework\Escaper::class);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['csv_id' => $item['csv_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'message' => __('Are you sure you want to delete a record?')
                        ],
                        'post' => true
                    ];
                }
            }
        }

        return $dataSource;
    }
}
