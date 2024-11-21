<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Api\Data;

interface ProductFlagReasonSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get ProductFlag list.
     * @return \Hts\Marketplace\Api\Data\ProductFlagReasonInterface[]
     */
    public function getItems();

    /**
     * Set ProductFlag list.
     * @param \Hts\Marketplace\Api\Data\ProductFlagReasonInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
