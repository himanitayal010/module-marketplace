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
 * Hts Marketplace Order Invoice Email Controller.
 */
class Email extends \Hts\Marketplace\Controller\Order
{
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            $invoiceId = $this->getRequest()->getParam('invoice_id');
            if ($invoice = $this->_initInvoice()) {
                try {
                    $this->invoiceManagement->notify($invoice->getEntityId());
                    $this->messageManager->addSuccess(
                        __('The message has been sent.')
                    );
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\Exception $e) {
                    $this->helper->logDataInLogger(
                        "Controller_Order_Invoice_Email execute : ".$e->getMessage()
                    );
                    $this->messageManager->addError(
                        __('Failed to send the invoice email.')
                    );
                }
                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/view',
                    [
                        'order_id' => $invoice->getOrder()->getId(),
                        'invoice_id' => $invoiceId,
                        '_secure'=>$this->getRequest()->isSecure()
                    ]
                );
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
