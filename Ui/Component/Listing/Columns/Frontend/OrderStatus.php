<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Ui\Component\Listing\Columns\Frontend;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class OrderStatus.
 */
class OrderStatus extends Column
{
    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $span = "<span class='ht-mp-grid-status ht-mp-grid-status-";
                    $item[$fieldName] = $span.$item[$fieldName]."'>".$item[$fieldName]."</span>";
                }
            }
        }

        return $dataSource;
    }
}
