<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block\View\Html;

class SwitchLink extends \Magento\Framework\View\Element\Html\Link
{
    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    private $helper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Hts\Marketplace\Helper\Data                  $helper
     * @param array                                            $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Hts\Marketplace\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->helper->getIsSeparatePanel()) {
            if (false != $this->getTemplate()) {
                return parent::_toHtml();
            }
            $label = $this->escapeHtml($this->getLabel());
            return '<li><a ' . $this->getLinkAttributes() . ' >' . $label . '</a></li>';
        }
    }
}
