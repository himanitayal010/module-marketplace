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
 * Class Producttype is used tp get the product type options
 */
class Producttype implements OptionSourceInterface
{

    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Magento\Cms\Model\Page $cmsPage
     */
    public function __construct(
        \Magento\Framework\Module\Manager $manager
    ) {
        $this->manager = $manager;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            ['value' => 'simple', 'label' => __('Simple')],
            ['value' => 'downloadable', 'label' => __('Downloadable')],
            ['value' => 'virtual', 'label' => __('Virtual')],
            ['value' => 'configurable', 'label' => __('Configurable')]
        ];
        if ($this->manager->isEnabled('Hts_MpBundleProduct')) {
            array_push($options, ['value' => 'bundle', 'label' => __('Bundle Product')]);
        }
        if ($this->manager->isEnabled('Hts_MpGroupedProduct')) {
            array_push($options, ['value' => 'grouped', 'label' => __('Grouped Product')]);
        }
        return $options;
    }
}
