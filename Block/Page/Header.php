<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block\Page;

class Header extends \Magento\Theme\Block\Html\Header\Logo
{
    /**
     * @var string
     */
    protected $_template = 'Hts_Marketplace::layout2/page/header.phtml';

    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context   $context
     * @param \Magento\MediaStorage\Helper\File\Storage\Database $fileStorageHelper
     * @param \Hts\Marketplace\Helper\Data                    $helper
     * @param array                                              $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hts\Marketplace\Helper\Data $helper,
        \Magento\MediaStorage\Helper\File\Storage\Database $fileStorageHelper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct(
            $context,
            $fileStorageHelper,
            $data
        );
    }

    /**
     * @return string
     */
    public function getSellerShopName()
    {
        $sellerId = $this->helper->getCustomerId();
        $collection = $this->helper->getSellerCollectionObj($sellerId);
        $shopName = '';
        foreach ($collection as $key => $value) {
            $shopName = $value->getShopTitle();
            if (empty($value->getShopTitle())) {
                $shopName = $value->getShopUrl();
            }
        }
        return $shopName;
    }

    /**
     * @return string
     */
    public function getSellerLogo()
    {
        $sellerId = $this->helper->getCustomerId();
        $collection = $this->helper->getSellerCollectionObj($sellerId);
        $logoPic = 'noimage.png';
        foreach ($collection as $key => $value) {
            $logoPic = $value->getLogoPic();
            if (empty($logoPic)) {
                $logoPic = 'noimage.png';
            }
        }
        return $logoPic;
    }

    /**
     * Get logo image URL
     *
     * @return string
     */
    public function getSellerDashboardLogoSrc()
    {
        if ($logo = $this->helper->getSellerDashboardLogoUrl()) {
            return $logo;
        }
        return $this->getLogoSrc();
    }
}
