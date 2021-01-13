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
namespace Magepow\FacebookShopIntegration\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class Generatecsv extends Action
{
    /**
     * @var string
     */
    protected $accessType = 'admin';

    /**
     * @var array
     */
    protected $attributeMapping;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    protected $directory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var \Magento\CatalogInventory\Model\Stock\StockItemRepository
     */
    protected $stockItemRepository;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $currencyModel;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Data|\Magepow\FacebookShopIntegration\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping\CollectionFactory
     */
    protected $mappingFactory;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $frontUrlModel;

    /**
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    /**
     * @var \Magepow\FacebookShopIntegration\Model\FacebookShopCsvLogFactory
     */
    protected $facebookShopCsvLogFactory;

    /**
     * @var \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopCsvLog
     */
    protected $facebookShopCsvLogResource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * Generatecsv constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Directory\Model\Currency $currencyModel
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magepow\FacebookShopIntegration\Helper\Data $helper
     * @param \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping\CollectionFactory $mappingFactory
     * @param \Magento\Framework\UrlInterface $frontUrlModel
     * @param \Magento\Catalog\Model\CategoryRepository $categoryRepository
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     * @param \Magepow\FacebookShopIntegration\Model\FacebookShopCsvLogFactory $facebookShopCsvLogFactory
     * @param \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopCsvLog $facebookShopCsvLogResource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\App\Request\Http $request
     * @param JsonFactory $resultJsonFactory
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Directory\Model\Currency $currencyModel,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magepow\FacebookShopIntegration\Helper\Data $helper,
        \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopAttributeMapping\CollectionFactory $mappingFactory,
        \Magento\Framework\UrlInterface $frontUrlModel,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magepow\FacebookShopIntegration\Model\FacebookShopCsvLogFactory $facebookShopCsvLogFactory,
        \Magepow\FacebookShopIntegration\Model\ResourceModel\FacebookShopCsvLog $facebookShopCsvLogResource,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Request\Http $request,
        JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->fileFactory = $fileFactory;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::PUB);
        $this->productCollectionFactory = $productCollectionFactory;
        $this->stockItemRepository = $stockItemRepository;
        $this->imageHelper = $imageHelper;
        $this->currencyModel = $currencyModel;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
        $this->mappingFactory = $mappingFactory;
        $this->frontUrlModel = $frontUrlModel;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->facebookShopCsvLogFactory = $facebookShopCsvLogFactory;
        $this->facebookShopCsvLogResource = $facebookShopCsvLogResource;
        $this->request = $request;
        $this->date = $date;
        parent::__construct($context);
    }

    /**
     * Generate product Csv action
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $startTime = $this->date->gmtDate();
            if($this->request->getParam('manually')) {
                $filepath = 'import/magepow/facebook_shop/facebook_shop_products_'.str_replace([":"," "], ["_","_"], $startTime).'.csv';
            } else {
                $filepath = 'import/magepow/facebook_shop/facebook_shop_products.csv';
            }
            $this->directory->create('pub/import');
            $this->directory->create('pub/import/magepow');
            $this->directory->create('pub/import/magepow/facebook_shop');
            /* Open file */
            $stream = $this->directory->openFile($filepath, 'w+');
            $stream->lock();
            $this->getAttributeMappingCollection();
            $header = $this->getColumnHeader();
            /* Write Header */
            $stream->writeCsv($header);

            $productsCollection = $this->productCollectionFactory->create()
                ->addAttributeToSelect('*')
                ->addFieldToFilter('facebook_product', 1)
                ->addFieldToFilter('status', 1);

            if (!$this->helper->getConfigModule('general/add_out_of_stock_products')) {
                $productsCollection->joinField(
                    'is_in_stock',
                    'cataloginventory_stock_item',
                    'is_in_stock',
                    'product_id=entity_id',
                    '{{table}}.is_in_stock=1',
                    'left'
                )->addFieldToFilter('is_in_stock', 1);
            }
            $productIds = [];

            /* Write products */
            foreach ($productsCollection as $item) {
                $productIds[] = $item->getId();
                $itemData = [];
                $product = $this->productRepository->getById($item->getId());
                foreach ($this->attributeMapping as $attribute) {
                    if ($attribute[1] == 'quantity_and_stock_status') {
                        $itemData[] = $this->stockItemRepository->get($item->getId())->getIsInStock() == 1 ?
                            'in stock' :
                            'out of stock';
                    } elseif ($attribute[1] == 'regular_price') {
                        if ($this->helper->getConfigModule('general/apply_catalog_price_rules')) {
                            $itemData[] = $this->formatPrice(
                                $item->getPriceInfo()->getPrice('final_price')->getValue()
                            );
                        } else {
                            $itemData[] = $this->formatPrice(
                                $item->getPriceInfo()->getPrice('regular_price')->getValue()
                            );
                        }
                    } elseif ($attribute[0] == 'google_product_category') {
                        $itemData[] = $this->getGoogleCategory($item);
                    } elseif ($attribute[1] == 'special_price') {
                        if ($item->getSpecialPrice()) {
                            $itemData[] = $this->formatPrice($item->getSpecialPrice());
                        } else {
                            $itemData[] = '-';
                        }
                    } elseif ($attribute[1] == 'product_url') {
                        $itemData[] = $this->frontUrlModel->getBaseUrl() .'facebook_shop_integration/facebook/addcart?product=' .$item->getId();
                    } elseif ($attribute[1] == 'image') {
                        $itemData[] = $this->imageHelper->init($item, 'product_base_image')
                            ->setImageFile($item->getImage())
                            ->getUrl();
                    } elseif ($attribute[1] == 'media_gallery') {
                        $images = $product->getMediaGalleryImages();
                        $imagePaths = [];
                        foreach ($images as $image) {
                            $imagePaths[] = $image->getUrl();
                        }
                        $itemData[] = implode(',', $imagePaths);
                    } else {
                        if ($item->getResource()->getAttribute($attribute[1])->usesSource() && $attribute[0] != 'condition') {
                            $attValue = $item->getResource()->getAttribute($attribute[1])
                                ->getFrontend()
                                ->getValue($item);
                            $itemData[] = trim($attValue) != null ? $attValue : '-';
                        } else {
                            $itemData[] = $item->getData($attribute[1]) ? $item->getData($attribute[1]) : '-';
                        }
                    }
                }
                $stream->writeCsv($itemData);
            }
            $stream->unlock();
            $stream->close();

            $endTime = $this->date->gmtDate();
            $status = 'Success';
            $message = 'CSV generated successfully at ' . DirectoryList::PUB . '/' . $filepath;

            $facebookShopCsvLog = $this->facebookShopCsvLogFactory->create();
            $facebookShopCsvLog->setGeneratedBy($this->accessType);
            $facebookShopCsvLog->setStatus($status);
            $facebookShopCsvLog->setMessage($message);
            $facebookShopCsvLog->setProductIds(implode(',', $productIds));
            $facebookShopCsvLog->setStartedAt($startTime);
            $facebookShopCsvLog->setFinishedAt($endTime);
            $this->facebookShopCsvLogResource->save($facebookShopCsvLog);

            /** @var \Magento\Framework\Controller\Result\Json $result */
            $result = $this->resultJsonFactory->create();
            $result->setData(['success' => 1, 'msg' => $message]);
            return $result;
        } catch (\Exception $e) {
            /** @var \Magento\Framework\Controller\Result\Json $result */
            $result = $this->resultJsonFactory->create();
            $status = 'Error';
            $message = 'Something went wrong while generating csv.'.$e->getMessage();
            $result->setData(['success' => 0, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Return column header
     *
     * @return array
     */
    public function getColumnHeader()
    {
        $headers = [];
        foreach ($this->attributeMapping as $attribute) {
            $headers[] = $attribute[0];
        }
        return $headers;
    }

    /**
     * Create facebook and magento attribute mapping array
     */
    public function getAttributeMappingCollection()
    {
        $mapping = $this->mappingFactory->create();
        foreach ($mapping as $attribute) {
            $this->attributeMapping[] = [
                $attribute->getFacebookAttribute(),
                $attribute->getMagentoAttribute()
            ];
        }
        $this->attributeMapping[] = ['price', 'regular_price'];
        $this->attributeMapping[] = ['link', 'product_url'];
    }

    /**
     * Get product google category
     *
     * @param $product
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getGoogleCategory($product)
    {
        if ($product->getData('google_product_category')) {
            return $product->getData('google_product_category');
        } else {
            $categoryIds = $product->getCategoryIds();
            foreach ($categoryIds as $categoryId) {
                $category = $this->categoryRepository->get($categoryId, $this->storeManager->getStore()->getId());
                if ($category->getData('google_category')) {
                    return $category->getData('google_category');
                }
            }
        }
        return '';
    }

    /**
     * Format price
     *
     * @param $price
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function formatPrice($price)
    {
        return $this->currencyModel->format(
            $price,
            ['display'=>\Zend_Currency::NO_SYMBOL],
            false
        ) . ' ' . $this->storeManager->getStore()->getCurrentCurrencyCode();
    }

    /**
     * Generate Product csv on cron
     */
    public function scheduleCsv()
    {
        $this->accessType = 'cron';
        if ($this->helper->getConfigModule('general/schedule_generate_csv')) {
            $this->execute();
        }
    }
}
