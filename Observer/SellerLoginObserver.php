<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SellerLoginObserver implements ObserverInterface
{
    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * Customer data
     *
     * @var \Magento\Customer\Model\Url
     */
    protected $_customerUrl;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @param \Hts\Marketplace\Helper\Data $helper
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Customer\Model\Url $customerUrl
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Hts\Marketplace\Helper\Data $helper,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->_helper = $helper;
        $this->_session = $customerSession;
        $this->_customerUrl = $customerUrl;
        $this->_urlBuilder = $urlBuilder;
    }

    /**
     * Check captcha on user login page
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @throws NoSuchEntityException
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->_helper->getIsSeparatePanel()) {
            $controller = $observer->getControllerAction();
            if ($controller->getRequest()->getPost('vendor_login')) {
                $url = $this->_urlBuilder->getUrl("marketplace/account/dashboard");
                $this->_session->setBeforeAuthUrl($url);
                $this->_session->setAfterAuthUrl($url);
            }
        }

        return $this;
    }
}
