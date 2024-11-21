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
 * Controllers CRUD interface.
 */
interface ControllersRepositoryInterface
{
    /**
     * Retrieve controller by id.
     *
     * @api
     * @param string $controllersId
     * @return \Hts\Marketplace\Api\Data\ControllersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($controllersId);

    /**
     * Retrieve all controllers.
     *
     * @api
     * @param int $moduleName
     * @return \Hts\Marketplace\Api\Data\ControllersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByModuleName($moduleName);

    /**
     * Retrieve all controllers.
     *
     * @api
     * @param int $controllerPath
     * @return \Hts\Marketplace\Api\Data\ControllersInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPath($controllerPath);

    /**
     * Retrieve all controllers.
     *
     * @api
     * @return \Hts\Marketplace\Api\Data\ControllersInterface
     */
    public function getList();
}
