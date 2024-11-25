<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Ui\Component\Listing\Columns\Frontend;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Hts\Marketplace\Model\Notification;
use Hts\Marketplace\Helper\Notification as NotificationHelper;
use Magento\Framework\UrlInterface;

/**
 * Class NotificationInfo.
 */
class NotificationInfo extends Column
{
    /**
     * @var NotificationHelper
     */
    protected $_helper;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $_escaper;

    /**
     * Constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param NotificationHelper $helper
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        NotificationHelper $helper,
        UrlInterface $urlBuilder,
        \Magento\Framework\Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        $this->_helper = $helper;
        $this->urlBuilder = $urlBuilder;
        $this->_escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                $timeArr = $this->_helper->getCalculatedTimeDigits(
                    $item['created_at']
                );
                $type = $timeArr[0];
                $timedigit = $timeArr[1];
                $time = $timeArr[2];
                $item['created_at'] = $time;
                if ($item['type'] == Notification::TYPE_PRODUCT) {
                    $productNotificationDesc = $this->_helper->getProductNotificationDesc(
                        $item['notification_row_id']
                    );
                    $url = $this->urlBuilder->getUrl(
                        'marketplace/product/edit',
                        [
                            "id" => $item['notification_row_id']
                        ]
                    );
                    $item['details'] = '<span class="ht-mp-notification-row ht-mp-dropdown-notification-products">
                        <a
                        href="'.$url.'"
                        class="ht-mp-notification-entry-description-start"
                        title="'.__("View Product").'">
                            <span>'.$productNotificationDesc.'</span>
                        </a>
                    </span>';
                } elseif ($item['type'] == Notification::TYPE_ORDER) {
                    $order = $this->_helper->getOrder($item['notification_row_id']);
                    $id = $order->getIncrementId();
                    $status = $order->getStatus();
                    $orderClass = "ht-mp-order-notification-".$order->getState();
                    $url = $this->urlBuilder->getUrl(
                        "marketplace/order/view",
                        [
                            "id" => $item['notification_row_id']
                        ]
                    );
                    $item['details'] = '<span class="ht-mp-notification-row
                    ht-mp-dropdown-notification-orders '.$orderClass.'">
                        <a
                        href="'.$url.'"
                        class="ht-mp-notification-entry-description-start"
                        title="'.__("View Order").'">
                            <span>'.__("Order #%1 is %2.", $id, $status).'</span>
                        </a>
                    </span>';
                } elseif ($item['type'] == Notification::TYPE_TRANSACTION) {
                    $transactionNotificationDesc = $this->_helper->getTransactionNotifyDesc(
                        $item['notification_id']
                    );
                    $url = $this->urlBuilder->getUrl(
                        'marketplace/transaction/view',
                        [
                            "id" => $item['notification_id']
                        ]
                    );
                    $item['details'] = '<span class="ht-mp-notification-row ht-mp-dropdown-notification-transaction">
                        <a
                        href="'.$url.'"
                        class="ht-mp-notification-entry-description-start"
                        title="'.__("View Transaction").'">
                            <span>'.$transactionNotificationDesc.'</span>
                        </a>
                    </span>';
                } elseif ($item['type'] == Notification::TYPE_REVIEW) {
                    $reviewNotification = $this->_helper->getReviewNotificationDesc(
                        $item['notification_id']
                    );
                    $allowedTags = null;
                    $reviewNotificationDesc = $this->_escaper->escapeHtml($reviewNotification['desc'], $allowedTags);
                    $reviewClass = $this->_escaper->escapeHtml($reviewNotification['feedsClass'], $allowedTags);
                    $url = $this->urlBuilder->getUrl(
                        'marketplace/account/review'
                    );
                    $item['details'] = '<span class="ht-mp-notification-row
                    ht-mp-dropdown-notification-review '.$reviewClass.'">
                        <a
                        href="'.$url.'"
                        class="ht-mp-notification-entry-description-start"
                        title="'.__("View Review").'">
                            <span>'.$reviewNotificationDesc.'</span>
                        </a>
                    </span>';
                }
            }
        }

        return $dataSource;
    }
}
