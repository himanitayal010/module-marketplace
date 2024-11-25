<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Plugin\Catalog\Model\Layer;

class FilterList
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $_mpHelper;

    /**
     * Initialize dependencies
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Hts\Marketplace\Helper\Data $mpHelper
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Hts\Marketplace\Helper\Data $mpHelper
    ) {
        $this->_objectManager = $objectManager;
        $this->_mpHelper = $mpHelper;
    }

    /**
     * aroundGetFilters Plugin
     *
     * @param \Magento\Catalog\Model\Layer\FilterList $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Layer $layer
     * @return array
     */
    public function aroundGetFilters(
        \Magento\Catalog\Model\Layer\FilterList $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Layer $layer
    ) {
        $result = $proceed($layer);
        if ($this->_mpHelper->allowSellerFilter()) {
            $result[] = $this->_objectManager->create(
                \Hts\Marketplace\Model\Layer\Filter\Seller::class,
                ['layer' => $layer]
            );
        }

        return $result;
    }
}
