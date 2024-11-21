<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block\Adminhtml\Customer\Edit;

use \AllowDynamicProperties;
#[\AllowDynamicProperties]

class Js extends \Magento\Config\Block\System\Config\Form\Field
{
    const JS_TEMPLATE = 'customer/js.phtml';

    /**
     * Set JS template to itself.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate(static::JS_TEMPLATE);
        }

        return $this;
    }
}
