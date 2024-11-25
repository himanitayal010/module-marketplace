<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block\Page;

use Hts\Marketplace\Model\ResourceModel\Notification\CollectionFactory;
use Hts\Marketplace\Helper\Data as HelperData;
use Hts\Marketplace\Helper\Notification as NotificationHelper;
use Hts\Marketplace\Model\Notification;

class Notifications extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    protected $_template = 'Hts_Marketplace::layout2/page/header.phtml';

    /**
     * Notification collection
     *
     * @var \Hts\Marketplace\Model\ResourceModel\Notification\Collection
     */
    protected $collection;

    /**
     * @var HelperData
     */
    public $helperData;

    /**
     * @var NotificationHelper
     */
    public $notificationHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param CollectionFactory                                $collectionFactory
     * @param HelperData                                       $helperData
     * @param NotificationHelper                               $notificationHelper
     * @param array                                            $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CollectionFactory $collectionFactory,
        HelperData $helperData,
        NotificationHelper $notificationHelper,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->helperData = $helperData;
        $this->notificationHelper = $notificationHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get All notifications .
     *
     * @return array
     */
    public function getAllNotificationCount()
    {
        $sellerId = $this->helperData->getCustomerId();
        $ids = $this->notificationHelper->getAllNotificationIds($sellerId);
        $collectionData = $this->collectionFactory->create()
        ->addFieldToFilter(
            'entity_id',
            ["in" => $ids]
        );
        return count($collectionData);
    }

    /**
     * Get All notifications .
     *
     * @return array
     */
    public function getAllNotification()
    {
        $sellerId = $this->helperData->getCustomerId();
        $ids = $this->notificationHelper->getAllNotificationIds($sellerId);
        $collectionData = $this->collectionFactory->create()
        ->addFieldToFilter(
            'entity_id',
            ["in" => $ids]
        );
        $collectionData->setOrder('created_at', 'DESC');
        $collectionData->setPageSize(5) ->setCurPage(1);
        return $collectionData;
    }

    /**
     * getNotificationInfo.
     *
     * @param array $rowData
     *
     * @return string
     */
    public function getNotificationInfo($rowData)
    {
        $message = '';
        if (empty($rowData)) {
            return $message;
        }
        $timeArr = $this->notificationHelper->getCalculatedTimeDigits(
            $rowData['created_at']
        );
        $type = $timeArr[0];
        $timedigit = $timeArr[1];
        $time = $timeArr[2];
        if ($rowData['type'] == Notification::TYPE_PRODUCT) {
            $productNotificationDesc = $this->notificationHelper->getProductNotificationDesc(
                $rowData['notification_row_id']
            );
            $url = $this->getUrl(
                'marketplace/product/edit',
                [
                    "id" => $rowData['notification_row_id']
                ]
            );
            $message = '<li class="ht-mp-notification-row ht-mp-dropdown-notification-products">
                <a
                href="'.$url.'"
                class="ht-mp-notification-entry-description-start"
                title="'.__("View Product").'">
                    <span>'.$productNotificationDesc.'</span>
                </a>
                <small class="ht-mp-notification-time">'.$time.'</small>
            </li>';
        } elseif ($rowData['type'] == Notification::TYPE_ORDER) {
            $order = $this->notificationHelper->getOrder($rowData['notification_row_id']);
            $id = $order->getIncrementId();
            $status = $order->getFrontendStatusLabel();
            $orderClass = "ht-mp-order-notification-".$order->getState();
            $url = $this->getUrl(
                "marketplace/order/view",
                [
                    "id" => $rowData['notification_row_id']
                ]
            );
            $message = '<li class="ht-mp-notification-row ht-mp-dropdown-notification-orders '.$orderClass.'">
                <a
                href="'.$url.'"
                class="ht-mp-notification-entry-description-start"
                title="'.__("View Order").'">
                    <span>'.__("Order #%1 is %2.", $id, $status).'</span>
                </a>
                <small class="ht-mp-notification-time">'.$time.'</small>
            </li>';
        } elseif ($rowData['type'] == Notification::TYPE_TRANSACTION) {
            $transactionNotificationDesc = $this->notificationHelper->getTransactionNotifyDesc(
                $rowData['notification_id']
            );
            $url = $this->getUrl(
                'marketplace/transaction/view',
                [
                    "id" => $rowData['notification_id']
                ]
            );
            $message = '<li class="ht-mp-notification-row ht-mp-dropdown-notification-transaction">
                <a
                href="'.$url.'"
                class="ht-mp-notification-entry-description-start"
                title="'.__("View Transaction").'">
                    <span>'.$transactionNotificationDesc.'</span>
                </a>
                <small class="ht-mp-notification-time">'.$time.'</small>
            </li>';
        } elseif ($rowData['type'] == Notification::TYPE_REVIEW) {
            $reviewNotification = $this->notificationHelper->getReviewNotificationDesc(
                $rowData['notification_id']
            );
            $reviewNotificationDesc = $this->escapeHtml($reviewNotification['desc']);
            $reviewClass = $this->escapeHtml($reviewNotification['feedsClass']);
            $url = $this->getUrl(
                'marketplace/account/review/'
            );
            $message = '<li class="ht-mp-notification-row ht-mp-dropdown-notification-review '.$reviewClass.'">
                <a
                href="'.$url.'"
                class="ht-mp-notification-entry-description-start"
                title="'.__("View Review").'">
                    <span>'.$reviewNotificationDesc.'</span>
                </a>
                <small class="ht-mp-notification-time">'.$time.'</small>
            </li>';
        }
        return $message;
    }
}
