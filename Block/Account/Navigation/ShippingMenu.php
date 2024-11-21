<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
namespace Hts\Marketplace\Block\Account\Navigation;

use \AllowDynamicProperties;
#[\AllowDynamicProperties]

/**
 * Marketplace Navigation link
 *
 */
class ShippingMenu extends \Hts\Marketplace\Block\Account\Navigation
{
    /**
     * isShippineAvlForSeller
     * @return boolean
     */
    public function isShippineAvlForSeller()
    {
        $activeCarriers = $this->shipconfig->getActiveCarriers();
        $status = false;
        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            $allowToSeller = $this->_scopeConfig->getValue(
                'carriers/'.$carrierCode.'/allow_seller'
            );
            if ($allowToSeller) {
                $status = true;
            }
        }
        return $status;
    }
}
