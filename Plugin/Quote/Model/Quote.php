<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Plugin\Quote\Model;
use Hts\Marketplace\Helper\Data as MarketplaceHelperData;
use Hts\Marketplace\Model\SaleperpartnerFactory as MpSalesPartner;

class Quote
{
    /**
     * @var MarketplaceHelperData
     */
    protected $marketplaceHelperData;

    /**
     * @var MpSalesPartner
     */
    protected $mpSalesPartner;

    /**
     * @param MarketplaceHelperData $marketplaceHelperData
     * @param MpSalesPartner $mpSalesPartner
     */
    public function __construct(
        MarketplaceHelperData $marketplaceHelperData,
        MpSalesPartner $mpSalesPartner
    ) {
        $this->marketplaceHelperData = $marketplaceHelperData;
        $this->mpSalesPartner = $mpSalesPartner;
    }

    /**
     * {@inheritdoc}
     */
    public function aroundValidateMinimumAmount(
        \Magento\Quote\Model\Quote $subject,
        callable $proceed,
        $multishipping = false
    ) {
        $helper = $this->marketplaceHelperData;
        if ($helper->getMinOrderSettings()) {
            if (!$multishipping) {
                $items = $subject->getAllItems();
                $sellerDetails = $helper->getSellerItemsDetails($items);
                foreach ($sellerDetails as $sellerId => $amount) {
                    if ($this->minOrderStatus($sellerId, $amount)) {
                        return false;
                    }
                }
                return true;
            } else {
                $addresses = $subject->getAllAddresses();
                foreach ($addresses as $address) {
                    $items = $address->getQuote()->getItemsCollection();
                    $sellerDetails = $helper->getSellerItemsDetails($items);
                    foreach ($sellerDetails as $sellerId => $amount) {
                        if ($this->minOrderStatus($sellerId, $amount)) {
                            return false;
                        }
                    }
                }
                return true;
            }
        }
        return $proceed($multishipping);
    }
    /**
     * minOrderStatus function
     *
     * @param int $sellerId
     * @param float $amount
     * @return bool
     */
    private function minOrderStatus($sellerId, $amount) {
        $helper = $this->marketplaceHelperData;
        if($sellerId) {
            $salePerPartnerModel = $this->mpSalesPartner->create()
                                    ->getCollection()
                                    ->addFieldToFilter('seller_id', $sellerId)
                                    ->addFieldToFilter('min_order_status', 1);
            if($salePerPartnerModel->getSize()) {
                $minOrderAmount = $salePerPartnerModel->getFirstItem()
                                                ->getMinOrderAmount();
                if ($minOrderAmount > $amount) {
                    return true;
                }
            } elseif ($helper->getMinAmountForSeller()) {
                $minOrderAmount = $helper->getMinOrderAmount();
                if ($minOrderAmount > $amount) {
                    return true;
                } 
            }
        } else {
            $minOrderAmount = $helper->getMinOrderAmount();
            if ($minOrderAmount > $amount) {
                return true;
            }
        }
        return false;
    }
}
