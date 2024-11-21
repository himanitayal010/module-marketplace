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

interface ProductFlagsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get ProductFlags list.
     * @return \Hts\Marketplace\Api\Data\ProductFlagsInterface[]
     */
    public function getItems();

    /**
     * Set ProductFlags list.
     * @param \Hts\Marketplace\Api\Data\ProductFlagsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
