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
 * Class ProductStatus is used tp get Marketplace product status
 */
class ProductStatus implements OptionSourceInterface
{
    /**
     * @var \Hts\Marketplace\Model\Product
     */
    protected $marketplaceProduct;

    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $marketplaceHelper;

    /**
     * @param \Hts\Marketplace\Model\Product $marketplaceProduct
     * @param \Hts\Marketplace\Helper\Data   $marketplaceHelper
     */
    public function __construct(
        \Hts\Marketplace\Model\Product $marketplaceProduct,
        \Hts\Marketplace\Helper\Data $marketplaceHelper
    ) {
        $this->marketplaceProduct = $marketplaceProduct;
        $this->marketplaceHelper = $marketplaceHelper;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->marketplaceProduct->getAvailableStatuses();
        $helper = $this->marketplaceHelper;
        if ($helper->getIsProductApproval() || $helper->getIsProductEditApproval()) {
            $enabledStatusText = __('Approved');
            $disabledStatusText = __('Pending');
            $deniedStatusText = __('Denied');
        } else {
            $enabledStatusText = __('Approved');
            $disabledStatusText = __('Disapproved');
            $deniedStatusText = __('Denied');
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
                } elseif ($key == 2) {
                    $options[] = [
                        'label' =>  $disabledStatusText,
                        'row_label' => "<span class='ht-mp-grid-status
                        ht-mp-grid-status-".$key."'>".$disabledStatusText."</span>",
                        'value' => $key,
                    ];
                } else {
                    $options[] = [
                        'label' =>  $deniedStatusText,
                        'row_label' => "<span class='ht-mp-grid-status
                        ht-mp-grid-status-".$key."'>".$deniedStatusText."</span>",
                        'value' => $key,
                    ];
                }
            }
        }
        return $options;
    }
}
