<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Order\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status is used tp get the order available status
 */
class Status implements OptionSourceInterface
{
    /**
     * @var \Hts\Marketplace\Model\Orders
     */
    protected $marketplaceOrder;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Page $cmsPage
     */
    public function __construct(\Hts\Marketplace\Model\Orders $marketplaceOrder)
    {
        $this->marketplaceOrder = $marketplaceOrder;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->marketplaceOrder->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
