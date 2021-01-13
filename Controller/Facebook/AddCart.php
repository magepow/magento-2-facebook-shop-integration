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
namespace Magepow\FacebookShopIntegration\Controller\Facebook;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Cart;
use Magento\Checkout\Helper\Cart as CartHelper;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Controller\Result\RedirectFactory;

class AddCart extends Action
{
    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CartHelper
     */
    protected $cartHelper;

    /**
     * AddCart constructor.
     *
     * @param Context $context
     * @param FormKey $formKey
     * @param Cart $cart
     * @param ProductRepository $productRepository
     * @param CartHelper $cartHelper
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        Cart $cart,
        ProductRepository $productRepository,
        CartHelper $cartHelper,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->formKey = $formKey;
            $this->cart = $cart;
            $this->productRepository = $productRepository;
            $this->cartHelper = $cartHelper;
            $this->resultRedirectFactory = $resultRedirectFactory;
            parent::__construct($context);
    }

    /**
     * Addcart action
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        try {
            $productId = $this->getRequest()->getParam('product');
            $params = [
                'form_key' => $this->formKey->getFormKey(),
                'product' => $productId,
                'qty'   => 1
            ];
            $product = $this->productRepository->getById($productId);
            $this->cart->addProduct($product, $params);
            $this->cart->save();
            $this->messageManager->addSuccessMessage(__($product->getName() . ' added to cart successfully.'));
        } catch (\Exception $e) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addExceptionMessage(
                $e,
                __('%1', $e->getMessage())
            );
            return $resultRedirect->setPath($product->getProductUrl());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $cartUrl = $this->cartHelper->getCartUrl();
        return $resultRedirect->setPath($cartUrl);
    }
}
