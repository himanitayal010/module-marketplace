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
 * Orders CRUD interface.
 */
interface OrdersRepositoryInterface
{
    /**
     * Retrieve seller order by id.
     *
     * @api
     * @param string $id
     * @return \Hts\Marketplace\Api\Data\OrdersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve all seller order by seller id.
     *
     * @api
     * @param int $sellerId
     * @return \Hts\Marketplace\Api\Data\OrdersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getBySellerId($sellerId);

    /**
     * Retrieve order by order id.
     *
     * @api
     * @param int orderId
     * @return \Hts\Marketplace\Api\Data\OrdersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByOrderId($orderId);

    /**
     * Retrieve all seller order.
     *
     * @api
     * @return \Hts\Marketplace\Api\Data\OrdersInterface
     */
    public function getList();
}
