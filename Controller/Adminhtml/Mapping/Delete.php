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

class Delete extends \Magepow\FacebookShopIntegration\Controller\Adminhtml\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        try {
            $item = $this->mappingModel->create()->setId($id);
            $item->delete();
            $this->messageManager->addSuccess(
                __('Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
