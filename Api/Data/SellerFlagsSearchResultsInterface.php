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

interface SellerFlagsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get SellerFlags list.
     * @return \Hts\Marketplace\Api\Data\SellerFlagsInterface[]
     */
    public function getItems();

    /**
     * Set SellerFlags list.
     * @param \Hts\Marketplace\Api\Data\SellerFlagsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
