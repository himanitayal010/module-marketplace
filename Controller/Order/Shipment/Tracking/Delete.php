<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Order\Shipment\Tracking;

class Delete extends \Hts\Marketplace\Controller\Order
{
    /**
     * Add new tracking number action
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        try {
            $trackId = $this->getRequest()->getParam('id');
            if ($shipment = $this->_initShipment()) {
                $track = $this->_objectManager->create(
                    \Magento\Sales\Model\Order\Shipment\Track::class
                )->load($trackId);
                if ($track->getId()) {
                    $track->delete();
                    $response = [
                        'error' => false
                    ];
                } else {
                    $response = [
                        'error' => true,
                        'message' => __(
                            'We can\'t load track with retrieving identifier right now.%1'
                        )
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'message' => __(
                        'We can\'t initialize shipment for adding tracking number.'
                    ),
                ];
            }
        } catch (\Exception $e) {
            $response = [
                'error' => true,
                'message' => __('We can\'t delete tracking number.')
            ];
            $this->helper->logDataInLogger(
                "Controller_Order_Shipment_Tracking_Delete execute : ".$e->getMessage()
            );
        }
        if (is_array($response)) {
            $response = $this->_objectManager->get(
                \Magento\Framework\Json\Helper\Data::class
            )->jsonEncode($response);
            $this->getResponse()->representJson($response);
        } else {
            $this->getResponse()->setBody($response);
        }
    }
}
