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
namespace Magepow\FacebookShopIntegration\Controller\Adminhtml\Mapping;

class Save extends \Magepow\FacebookShopIntegration\Controller\Adminhtml\Action
{

    /**
     * Attribute Mapping save action
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            try {
                $mapping = $this->mappingModel->create();
                $mappedFacebookAttr = $this->mappingCollectionFactory->create()
                    ->addFieldToFilter('facebook_attribute', $data['facebook_attribute'])
                    ->addFieldToFilter('entity_id', ['neq' => $data['entity_id']]);
                if (count($mappedFacebookAttr) > 0) {
                    $this->dataPersistor->set('mapping_data', $data);
                    $this->messageManager->addErrorMessage(__('This Facebook attribute is already mapped.'));
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $data['entity_id']]);
                }
                if (isset($data['entity_id'])) {
                    $this->mappingResource->load($mapping, $data['entity_id']);
                }
                $mapping->setFacebookAttribute($data['facebook_attribute']);
                $mapping->setMagentoAttribute($data['magento_attribute']);
                $this->mappingResource->save($mapping);

                $this->messageManager->addSuccessMessage(__('Attributes mapped successfully'));
                $this->dataPersistor->clear('mapping_data');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        [
                            'entity_id' => $mapping->getEntityId(),
                            '_current' => true
                        ]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->dataPersistor->set('mapping_data', $data);
                $this->messageManager->addErrorMessage(__('Something went wrong. Please try again later.'));
                return $resultRedirect->setPath('facebook_shop_integration/mapping/edit', ['entity_id' => $data['entity_id']]);
            }
        }
    }
}