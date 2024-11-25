<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Order\Creditmemo;

/**
 * Hts Marketplace Order Creditmemo Email Controller.
 */
class Email extends \Hts\Marketplace\Controller\Order
{
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            $creditmemoId = $this->getRequest()->getParam('creditmemo_id');
            if ($creditmemo = $this->_initCreditmemo()) {
                try {
                    $this->creditmemoManagement->notify($creditmemo->getEntityId());
                    $this->messageManager->addSuccess(
                        __('The message has been sent.')
                    );
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\Exception $e) {
                    $this->helper->logDataInLogger(
                        "Controller_Order_Creditmemo_Email execute : ".$e->getMessage()
                    );
                    $this->messageManager->addError(
                        __('Failed to send the creditmemo email.')
                    );
                }

                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/view',
                    [
                        'order_id' => $creditmemo->getOrder()->getId(),
                        'creditmemo_id' => $creditmemoId,
                        '_secure' => $this->getRequest()->isSecure()
                    ]
                );
            } else {
                return $this->resultRedirectFactory->create()->setPath(
                    '*/*/history',
                    [
                        '_secure' => $this->getRequest()->isSecure()
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
