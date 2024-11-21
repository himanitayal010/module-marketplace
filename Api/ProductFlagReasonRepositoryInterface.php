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

interface ProductFlagReasonRepositoryInterface
{
    /**
     * Save ProductFlag
     * @param \Hts\Marketplace\Api\Data\ProductFlagReasonInterface $productFlagReason
     * @return \Hts\Marketplace\Api\Data\ProductFlagReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Hts\Marketplace\Api\Data\ProductFlagReasonInterface $productFlagReason
    );

    /**
     * Retrieve ProductFlag
     * @param int $entityId
     * @return \Hts\Marketplace\Api\Data\ProductFlagReasonInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * Retrieve ProductFlag matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hts\Marketplace\Api\Data\ProductFlagSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ProductFlag
     * @param \Hts\Marketplace\Api\Data\ProductFlagReasonInterface $productFlagReason
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Hts\Marketplace\Api\Data\ProductFlagReasonInterface $productFlagReason
    );

    /**
     * Delete ProductFlag by ID
     * @param string $entityId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($entityId);
}
