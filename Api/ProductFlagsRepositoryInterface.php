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

interface ProductFlagsRepositoryInterface
{
    /**
     * Save ProductFlag
     * @param \Hts\Marketplace\Api\Data\ProductFlagsInterface $productFlags
     * @return \Hts\Marketplace\Api\Data\ProductFlagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Hts\Marketplace\Api\Data\ProductFlagsInterface $productFlags
    );

    /**
     * Retrieve ProductFlag
     * @param int $entityId
     * @return \Hts\Marketplace\Api\Data\ProductFlagsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($entityId);

    /**
     * Retrieve ProductFlag matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Hts\Marketplace\Api\Data\ProductFlagsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ProductFlag
     * @param \Hts\Marketplace\Api\Data\ProductFlagsInterface $productFlags
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Hts\Marketplace\Api\Data\ProductFlagsInterface $productFlags
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
