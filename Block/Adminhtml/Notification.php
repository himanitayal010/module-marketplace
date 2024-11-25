<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Block\Adminhtml;

class Notification extends \Magento\Backend\Block\Template
{

    /**
     * @var \Magento\Framework\Data\FormFactory
     */
    protected $configProvider;

    /**
     * Constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Customer\Model\Customer        $customer
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Hts\Marketplace\Model\Notification\MarketplaceConfigProvider $configProvider,
        array $data = []
    ) {
        $this->configProvider = $configProvider;
        parent::__construct($context, $data);
    }

    public function getNotificationConfig()
    {
        $configData = $this->configProvider->getConfig();
        return $configData;
    }
}
