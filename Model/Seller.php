<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model;

use Magento\Framework\Model\AbstractModel;
use Hts\Marketplace\Api\Data\SellerInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * Marketplace Seller Model.
 *
 * @method \Hts\Marketplace\Model\ResourceModel\Seller _getResource()
 * @method \Hts\Marketplace\Model\ResourceModel\Seller getResource()
 */
class Seller extends AbstractModel implements SellerInterface, IdentityInterface
{
    /**
     * No route page id.
     */
    const NOROUTE_ENTITY_ID = 'no-route';

    /**#@+
     * Seller's Statuses
     */
    const STATUS_ENABLED    = 1;
    const STATUS_PENDING    = 0;
    const STATUS_PROCESSING = 2;
    const STATUS_DISABLED   = 3;
    /**#@-*/

    /**
     * Marketplace Seller cache tag.
     */
    const CACHE_TAG = 'marketplace_seller';

    /**
     * @var string
     */
    protected $_cacheTag = 'marketplace_seller';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'marketplace_seller';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(
            \Hts\Marketplace\Model\ResourceModel\Seller::class
        );
    }

    /**
     * Load object data.
     *
     * @param int|null $id
     * @param string   $field
     *
     * @return $this
     */
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRouteSeller();
        }

        return parent::load($id, $field);
    }

    /**
     * Load No-Route Seller.
     *
     * @return \Hts\Marketplace\Model\Seller
     */
    public function noRouteSeller()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    /**
     * Prepare seller's statuses.
     * Available event marketplace_seller_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
          self::STATUS_ENABLED => __('Approved'),
          self::STATUS_PENDING => __('Pending'),
          self::STATUS_PROCESSING => __('Processing'),
          self::STATUS_DISABLED  => __('Disapproved')
        ];
    }

    /**
     * Get identities.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    /**
     * Get ID.
     *
     * @return int
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set ID.
     *
     * @param int $id
     *
     * @return \Hts\Marketplace\Api\Data\SellerInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }
}
