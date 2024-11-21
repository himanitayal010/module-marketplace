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

use Magento\Sales\Ui\Component\Listing\Column\Status\Options as StatusOptions ;

/**
 * Class OrderListStatus is used tp get the order list status
 */
class OrderListStatus extends StatusOptions
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = parent::toOptionArray();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' =>  $value['label'],
                'row_label' =>  "<span class='ht-mp-grid-status ht-mp-grid-status-".
                $value['value']."'>".$value['label']."</span>",
                'value' => $value['value'],
            ];
        }
        return $options;
    }
}
