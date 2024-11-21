<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Plugin\Customer;

/**
 * Marketplace Customer Session Plugin.
 */
class Session
{
    /**
     * @var \Hts\Marketplace\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @var \Hts\Marketplace\Model\ControllersRepository
     */
    private $controllersRepository;

    /**
     * @param \Hts\Marketplace\Helper\Data $helper
     * @param \Hts\Marketplace\Model\ControllersRepository $controllersRepository
     */
    public function __construct(
        \Hts\Marketplace\Helper\Data $helper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Hts\Marketplace\Model\ControllersRepository $controllersRepository
    ) {
        $this->_helper = $helper;
        $this->_urlBuilder = $urlBuilder;
        $this->controllersRepository = $controllersRepository;
    }

    /**
     * Insert title and number for concrete document type.
     *
     * @param string $url
     */
    public function beforeAuthenticate(
        \Magento\Customer\Model\Session $session,
        $url = null
    ) {
        if ($this->_helper->getIsSeparatePanel()) {
            $controllerMappedPaths = $this->_helper->getControllerMappedPermissions();
            $currentUrl = $this->_urlBuilder->getCurrentUrl();
            foreach ($controllerMappedPaths as $key => $value) {
                if (strpos($currentUrl, $key) !== false) {
                    $url = $this->_urlBuilder->getUrl("marketplace/account/login");
                }
            }
            if ($url !== null) {
                foreach ($this->controllersRepository->getList() as $coll) {
                    if (gettype($coll['controller_path']) === "string" && strpos($currentUrl, $coll['controller_path']) !== false) {
                        $url = $this->_urlBuilder->getUrl("marketplace/account/login");
                    }
                }
            }
        }
        return [$url];
    }
}
