<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block;

use Magento\Catalog\Model\Category;
use Hts\Marketplace\Helper\Data as MpHelper;

class Sellercategory extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Catalog\Model\Category
     */
    protected $category;

    /**
     * @var \Hts\Marketplace\Helper\Data $helper
     */
    protected $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Category $category
     * @param \Hts\Marketplace\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Category $category,
        MpHelper $helper,
        array $data = []
    ) {
        $this->category = $category;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Get Category By Id
     *
     * @param int $id
     *
     * @return \Magento\Catalog\Model\Category
     */
    public function getCategoryById($id)
    {
        return $this->category->load($id);
    }

    /**
     * Get Seller Profile Details
     *
     * @return \Hts\Marketplace\Model\Seller | bool
     */
    public function getProfileDetail()
    {
        return $this->helper->getProfileDetail(MpHelper::URL_TYPE_COLLECTION);
    }
}
