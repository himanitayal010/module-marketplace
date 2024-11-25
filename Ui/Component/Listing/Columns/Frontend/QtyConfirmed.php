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

/**
 * Class QtyConfirmed.
 */
class QtyConfirmed extends QtySold
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
            $sellerId = $this->helperData->getCustomerId();
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $collectionData = $this->collectionFactory->create()
                    ->addFieldToFilter(
                        'mageproduct_id',
                        $item['entity_id']
                    )->addFieldToFilter(
                        'seller_id',
                        $sellerId
                    )->addFieldToFilter(
                        'cpprostatus',
                        1
                    );
                    $data = $collectionData->getAllSoldQty();
                    if (!empty($data)) {
                        $item[$fieldName] = $data['0']['qty'];
                    } else {
                        $item[$fieldName] = 0;
                    }
                }
            }
        }

        return $dataSource;
    }
}
