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
 * Class ProductListStatus is used tp get product list status
 */
class ProductListStatus implements OptionSourceInterface
{
    /**
     * @var \Magento\Catalog\Model\Product\Attribute\Source\Status
     */
    protected $productStatus;

    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $marketplaceHelper;

    /**
     * @param \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus
     * @param \Hts\Marketplace\Helper\Data   $marketplaceHelper
     */
    public function __construct(
        \Hts\Marketplace\Helper\Data $marketplaceHelper,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus
    ) {
        $this->marketplaceHelper = $marketplaceHelper;
        $this->productStatus = $productStatus;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->productStatus->getOptionArray();
        $helper = $this->marketplaceHelper;
        if ($helper->getIsProductApproval() || $helper->getIsProductEditApproval()) {
            $enabledStatusText = __('Approved');
            $disabledStatusText = __('Pending');
        } else {
            $enabledStatusText = __('Enabled');
            $disabledStatusText = __('Disabled');
        }
        $options = [];
        foreach ($availableOptions as $key => $value) {
            if ($helper->getIsProductApproval() || $helper->getIsProductEditApproval()) {
                $options[] = [
                    'label' =>  $value,
                    'row_label' =>  "<span class='ht-mp-grid-status ht-mp-grid-status-".$key."'>".$value."</span>",
                    'value' => $key,
                ];
            } else {
                if ($key == 1) {
                    $options[] = [
                        'label' =>  $enabledStatusText,
                        'row_label' => "<span class='ht-mp-grid-status
                        ht-mp-grid-status-".$key."'>".$enabledStatusText."</span>",
                        'value' => $key,
                    ];
                } else {
                    $options[] = [
                        'label' =>  $disabledStatusText,
                        'row_label' => "<span class='ht-mp-grid-status
                        ht-mp-grid-status-".$key."'>".$disabledStatusText."</span>",
                        'value' => $key,
                    ];
                }
            }
        }
        return $options;
    }
}
