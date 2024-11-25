<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\NoSuchEntityException;
use Hts\Marketplace\Model\ResourceModel\SellerFlags as ResourceSellerFlags;
use Magento\Framework\Exception\CouldNotSaveException;
use Hts\Marketplace\Api\Data\SellerFlagsSearchResultsInterfaceFactory;
use Hts\Marketplace\Api\Data\SellerFlagsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\DataObjectHelper;
use Hts\Marketplace\Api\SellerFlagsRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Hts\Marketplace\Model\ResourceModel\SellerFlags\CollectionFactory as SellerFlagsCollectionFactory;

class SellerFlagsRepository implements SellerFlagsRepositoryInterface
{

    /**
     * @var ResourceSellerFlags
     */
    protected $resource;

    /**
     * @var SellerFlagsCollectionFactory
     */
    protected $sellerFlagsCollectionFactory;

    /**
     * @var SellerFlagsInterfaceFactory
     */
    protected $dataSellerFlagsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var SellerFlagsFactory
     */
    protected $sellerFlagsFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var SellerFlagsSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @param ResourceSellerFlags $resource
     * @param SellerFlagsFactory $sellerFlagsFactory
     * @param SellerFlagsInterfaceFactory $dataSellerFlagsFactory
     * @param SellerFlagsCollectionFactory $sellerFlagsCollectionFactory
     * @param SellerFlagsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceSellerFlags $resource,
        SellerFlagsFactory $sellerFlagsFactory,
        SellerFlagsInterfaceFactory $dataSellerFlagsFactory,
        SellerFlagsCollectionFactory $sellerFlagsCollectionFactory,
        SellerFlagsSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->sellerFlagsFactory = $sellerFlagsFactory;
        $this->sellerFlagsCollectionFactory = $sellerFlagsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSellerFlagsFactory = $dataSellerFlagsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
    ) {
        try {
            $this->resource->save($sellerFlags);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the SellerFlag: %1',
                $exception->getMessage()
            ));
        }
        return $sellerFlags;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($sellerFlagId)
    {
        $sellerFlags = $this->sellerFlagsFactory->create();
        $this->resource->load($sellerFlags, $sellerFlagId);
        if (!$sellerFlags->getId()) {
            throw new NoSuchEntityException(__('SellerFlag with id "%1" does not exist.', $sellerFlagId));
        }
        return $sellerFlags;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sellerFlagsCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $fields[] = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $conditions[] = [$condition => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }

        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
    ) {
        try {
            $this->resource->delete($sellerFlags);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SellerFlag: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sellerFlagId)
    {
        return $this->delete($this->getById($sellerFlagId));
    }
}
