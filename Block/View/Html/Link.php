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

class Link extends \Magento\Framework\View\Element\Html\Link
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
        if (!$this->helper->getCustomerId()) {
            if (false != $this->getTemplate()) {
                return parent::_toHtml();
            }
            return '<li><a ' . $this->getLinkAttributes() . ' >' . $this->escapeHtml($this->getLabel()) . '</a></li>';
        }
    }

    /**
     * Get href URL
     *
     * @return string
     */
    public function getHref()
    {
        if (!$this->helper->getIsSeparatePanel()) {
            return $this->getUrl($this->getPath());
        } else {
            return $this->getUrl('marketplace/account/login/');
        }
    }
}
