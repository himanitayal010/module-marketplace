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

interface SellerFlagReasonRepositoryInterface
{
    /**
     * Save SellerFlagReason
     * @param \Hts\Marketplace\Api\Data\SellerFlagReasonInterface $sellerFlagReason
     * @return \Hts\Marketplace\Api\Data\SellerFlagReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Hts\Marketplace\Api\Data\SellerFlagReasonInterface $sellerFlagReason
    );

    /**
     * Retrieve SellerFlagReason
     * @param int $entityId
     * @return \Hts\Marketplace\Api\Data\SellerFlagReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * Retrieve SellerFlagReason matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hts\Marketplace\Api\Data\SellerFlagReasonSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SellerFlagReason
     * @param \Hts\Marketplace\Api\Data\SellerFlagReasonInterface $sellerFlagReason
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Hts\Marketplace\Api\Data\SellerFlagReasonInterface $sellerFlagReason
    );

    /**
     * Delete SellerFlagReason by ID
     * @param string $entityId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);
}
