<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Ui\DataProvider\Product;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Hts\Marketplace\Model\ResourceModel\ProductFlags\CollectionFactory;

/**
 * Class FlagsDataProvider
 */
class FlagsDataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     * @since 100.1.0
     */
    protected $collectionFactory;
    /**
     * @var RequestInterface
     * @since 100.1.0
     */
    protected $request;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collection = $this->collectionFactory->create();
        $this->request = $request;
    }
    /**
     * {@inheritdoc}
     * @since 100.1.0
     */
    public function getData()
    {
        $this->getCollection()->addFieldToFilter(
            'product_id',
            $this->request->getParam('current_product_id', 0)
        );
        $arrItems = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => [],
        ];
        foreach ($this->getCollection() as $item) {
            $arrItems['items'][] = $item->toArray([]);
        }
        return $arrItems;
    }
}
