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

use Hts\Marketplace\Model\ResourceModel\Feedback\CollectionFactory;
use Hts\Marketplace\Helper\Data as HelperData;

/**
 * Class ReviewDataProvider
 */
class ReviewDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Feedback collection
     *
     * @var \Hts\Marketplace\Model\ResourceModel\Feedback\Collection
     */
    protected $collection;

    /**
     * @var HelperData
     */
    public $helperData;

    /**
     * Construct
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param HelperData $helperData
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        HelperData $helperData,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $sellerId = $helperData->getCustomerId();
        $collectionData = $collectionFactory->create()
        ->addFieldToFilter(
            'seller_id',
            $sellerId
        );
        $this->collection = $collectionData;
    }
}
