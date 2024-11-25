<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Config\Source;

/**
 * Used in seller featured widget for getting seller logo ratio value.
 */
class Ratio implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter.
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('Default')],
            ['value' => '1', 'label' => __('1:1')],
            ['value' => '2', 'label' => __('1:2')],
            ['value' => '3', 'label' => __('1:3')],
            ['value' => '4', 'label' => __('1:4')],
            ['value' => '5', 'label' => __('1:5')],
            ['value' => '34', 'label' => __('3:4')],
        ];
    }
}
