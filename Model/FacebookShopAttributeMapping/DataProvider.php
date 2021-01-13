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
namespace Magepow\FacebookShopIntegration\Model\FacebookShopAttributeMapping;

use Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Collection
     *
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * Data Persistor
     *
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * LoadedData
     *
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $mappingCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $mappingCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $mappingCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
        }

        $data = $this->dataPersistor->get('mapping_data');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('mapping_data');
        }

        return $this->loadedData;
    }
}
