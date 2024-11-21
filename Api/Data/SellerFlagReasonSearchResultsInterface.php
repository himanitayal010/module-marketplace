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

interface SellerFlagReasonSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get SellerFlag list.
     * @return \Hts\Marketplace\Api\Data\SellerFlagReasonInterface[]
     */
    public function getItems();

    /**
     * Set SellerFlag list.
     * @param \Hts\Marketplace\Api\Data\SellerFlagReasonInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
