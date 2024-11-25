<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Ui\DataProvider;

use Hts\Marketplace\Model\Notification;
use Hts\Marketplace\Model\ResourceModel\Notification\CollectionFactory;
use Hts\Marketplace\Helper\Data as HelperData;
use Hts\Marketplace\Helper\Notification as NotificationHelper;

/**
 * Class NotificationDataProvider
 */
class NotificationDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
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
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param HelperData $helperData
     * @param NotificationHelper $notificationHelper
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        HelperData $helperData,
        NotificationHelper $notificationHelper,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $sellerId = $helperData->getCustomerId();
        $ids = $notificationHelper->getAllNotificationIds($sellerId);
        $collectionData = $collectionFactory->create()
        ->addFieldToFilter(
            'entity_id',
            ["in" => $ids]
        );
        if (!$helperData->getSellerProfileDisplayFlag()) {
            $collectionData->addFieldToFilter(
                'type',
                ["neq" => Notification::TYPE_REVIEW]
            );
        }
        $collectionData->setOrder('created_at', 'DESC');
        $this->collection = $collectionData;
    }
}
