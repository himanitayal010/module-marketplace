<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Product\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class AttributeSets is used tp get attribute sets
 */
class AttributeSets implements OptionSourceInterface
{
    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $marketplaceHelper;

    /**
     * Constructor
     *
     * @param \Hts\Marketplace\Helper\Data $marketplaceHelper
     */
    public function __construct(
        \Hts\Marketplace\Helper\Data $marketplaceHelper
    ) {
        $this->marketplaceHelper = $marketplaceHelper;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->marketplaceHelper->getAllowedSets();
        return $availableOptions;
    }
}
