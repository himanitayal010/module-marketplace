<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SellerFlagsRepositoryInterface
{
    /**
     * Save SellerFlags
     * @param \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
     * @return \Hts\Marketplace\Api\Data\SellerFlagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
    );

    /**
     * Retrieve SellerFlags
     * @param int $entityId
     * @return \Hts\Marketplace\Api\Data\SellerFlagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * Retrieve SellerFlags matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hts\Marketplace\Api\Data\SellerFlagsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SellerFlags
     * @param \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Hts\Marketplace\Api\Data\SellerFlagsInterface $sellerFlags
    );

    /**
     * Delete SellerFlags by ID
     * @param string $entityId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);
}
