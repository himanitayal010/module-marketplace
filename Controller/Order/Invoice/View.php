<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Order\Invoice;

/**
 * Hts Marketplace Order Invoice View Controller.
 */
class View extends \Hts\Marketplace\Controller\Order
{
    /**
     * Hts Marketplace Order Invoice View Action.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            if ($invoice = $this->_initInvoice()) {
                /** @var \Magento\Framework\View\Result\Page $resultPage */
                $resultPage = $this->_resultPageFactory->create();
                if ($helper->getIsSeparatePanel()) {
                    $resultPage->addHandle('marketplace_layout2_order_invoice_view');
                }
                $resultPage->getConfig()->getTitle()->set(
                    __('Order #%1', $invoice->getOrder()->getRealOrderId())
                );
                return $resultPage;
            } else {
                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/history',
                    [
                        '_secure'=>$this->getRequest()->isSecure()
                    ]
                );
            }
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
