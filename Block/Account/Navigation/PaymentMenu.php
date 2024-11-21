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
class PaymentMenu extends \Hts\Marketplace\Block\Account\Navigation
{
    /**
     * isPaymentAvlForSeller
     * @return boolean
     */
    public function isPaymentAvlForSeller()
    {
        $activeMethods = $this->paymentConfig->getActiveMethods();
        $status = false;
        foreach ($activeMethods as $methodCode => $methodModel) {
            if (preg_match('/mp[^a-b][^0-9][^A-Z]/', $methodCode)) {
                $status = true;
            }
        }
        return $status;
    }
}
