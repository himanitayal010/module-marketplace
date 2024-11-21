<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
namespace Hts\Marketplace\Api;

/**
 * Notification CRUD interface.
 */
interface NotificationRepositoryInterface
{
    /**
     * Retrieve notification by id.
     *
     * @api
     * @param string $id
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve all notification.
     *
     * @api
     * @param int $type
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByType($type);

    /**
     * Retrieve all notification.
     *
     * @api
     * @param int $type
     * @param int $notificationId
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByNotificationIdType($type, $notificationId);

    /**
     * Retrieve all notification.
     *
     * @api
     * @return \Hts\Marketplace\Api\Data\NotificationInterface
     */
    public function getList();

    /**
     * Delete Seller Notification.
     *
     * @api
     * @param \Hts\Notification\Api\Data\NotificationInterface $notification
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Hts\Marketplace\Api\Data\NotificationInterface $notification);

    /**
     * Delete Seller Notification by ID.
     *
     * @api
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
