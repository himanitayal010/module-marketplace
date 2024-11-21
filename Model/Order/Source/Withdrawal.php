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
 * Class Withdrawal is used tp get the Withdrawal options
 */
class Withdrawal implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $options[] = [
            'label' => __("Requested"),
            'value' => 1,
        ];
        $options[] = [
            'label' => __("No Request"),
            'value' => 0,
        ];
        return $options;
    }
}
