<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
namespace Hts\Marketplace\Api\Data;

/**
 * Marketplace Notification interface.
 * @api
 */
interface NotificationInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID = 'entity_id';
    /**#@-*/

    const NOTIFICATION_ID = 'notification_id';
    
    const TYPE = 'type';
    
    const CREATED_AT = 'created_at';
    
    const UPDATED_AT = 'updated_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function setId($id);
    
    /**
     * Get Notification ID
     *
     * @return int|null
     */
    public function getNotificationId();

    /**
     * Set Notification ID
     *
     * @param int $notificationId
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function setNotificationId($notificationId);
        
    /**
     * Get Type
     *
     * @return int|null
     */
    public function getType();

    /**
     * Set Type
     *
     * @param int $type
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function setType($type);

    /**
     * Get Created Time
     *
     * @return int|null
     */
    public function getCreatedAt();

    /**
     * Set Created Time
     *
     * @param int $createdAt
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get Updated Time
     *
     * @return int|null
     */
    public function getUpdatedAt();

    /**
     * Set Updated Time
     *
     * @param int $updatedAt
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function setUpdatedAt($updatedAt);
}
