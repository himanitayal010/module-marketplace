<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\Rewrite\Catalog\ResourceModel\Product;

use Magento\Framework\DB\Sql\Expression as SqlExpression;
use Hts\Marketplace\Model\Product as SellerProduct;
use Magento\Framework\DB\Select as DBSelect;

class Collection extends \Magento\Catalog\Model\ResourceModel\Product\Collection
{
    public function joinSellerProducts()
    {
        $this->addAttributeToSelect('*');
        $this->addAttributeToFilter('visibility', ['in' => [4]]);
        $this->addAttributeToFilter('status', ['neq' => SellerProduct::STATUS_DISABLED]);
        $this->addStoreFilter();
        $joinTable = $this->getTable('marketplace_product');
        $sql = 'e.entity_id = mp_product.mageproduct_id';
        $sql .= ' and mp_product.status != '.SellerProduct::STATUS_DISABLED;
        $fields = [];
        $fields[] = 'seller_id';
        $this->getSelect()->joinLeft($joinTable.' as mp_product', $sql, $fields);
    }

    /**
     * Reset All Columns From Collection
     */
    public function resetColumns()
    {
        $this->getSelect()->reset(DBSelect::COLUMNS);
    }

    /**
     * Add New Field To Collection
     *
     * @param string $field
     * @param string $expression
     */
    public function addFieldToCollection($field, $expression = "")
    {
        if ($expression == "") {
            $this->getSelect()->columns($field);
        } else {
            $this->getSelect()->columns([$field => new SqlExpression($expression)]);
        }
    }
}
