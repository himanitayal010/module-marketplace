<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Helper\Dashboard;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\Config\ConfigOptionsListConstants;
use Magento\Framework\Encryption\EncryptorInterface;

/**
 * Data helper for dashboard.
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    protected $_deploymentConfigDate;

    /**
     * @var EncryptorInterface
     */
    protected $encryptor;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param DeploymentConfig                      $deploymentConfig
     * @param EncryptorInterface                    $encryptor
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        DeploymentConfig $deploymentConfig,
        EncryptorInterface $encryptor
    ) {
        parent::__construct(
            $context
        );
        $this->encryptor = $encryptor;
        $this->_deploymentConfigDate = $deploymentConfig->get(
            ConfigOptionsListConstants::CONFIG_PATH_INSTALL_DATE
        );
    }

    /**
     * Get Seller Chart Encrypted Hash Data.
     *
     * @param  string $data
     * @return string
     */
    public function getChartEncryptedHashData($data)
    {
        return $this->encryptor->hash($data . $this->_deploymentConfigDate);
    }
}
