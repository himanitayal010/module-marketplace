<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Model\ResourceModel;

class WysiwygImage extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
     /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('ht_mp_wysiwyg_image', 'entity_id');
    }

}