<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Url as CustomerUrl;
use Hts\Marketplace\Helper\Data as HelperData;
use Hts\Marketplace\Helper\Notification as NotificationHelper;
use Hts\Marketplace\Model\ResourceModel\Product\CollectionFactory;
use \AllowDynamicProperties;
#[\AllowDynamicProperties]

/**
 * Hts Marketplace Product Edit Controller.
 */
class Edit extends Action
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * Array of actions which can be processed without secret key validation.
     *
     * @var array
     */
    protected $_publicActions = ['edit'];

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var CustomerUrl
     */
    protected $customerUrl;

    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var NotificationHelper
     */
    protected $notificationHelper;

    /**
     * @var CollectionFactory
     */
    protected $productCollection;

    /**
     * @var \Magento\Downloadable\Model\SampleFactory
     */
    protected $sample;

    /**
     * @var \Magento\Downloadable\Helper\File
     */
    protected $fileHelper;

    /**
     * @var \Magento\Downloadable\Helper\Download
     */
    protected $downloadHelper;

    /**
     * @var \Magento\Downloadable\Model\LinkFactory
     */
    protected $linkModel;

    /**
     * @param Context                                       $context
     * @param Hts\Marketplace\Controller\Product\Builder $productBuilder
     * @param \Magento\Framework\View\Result\PageFactory    $resultPageFactory
     * @param CustomerUrl                                   $customerUrl
     * @param HelperData                                    $helper
     * @param NotificationHelper                            $notificationHelper
     * @param CollectionFactory                             $productCollection
     * @param \Magento\Downloadable\Model\SampleFactory     $sample
     * @param \Magento\Downloadable\Helper\File             $fileHelper
     * @param \Magento\Downloadable\Helper\Download         $downloadHelper
     * @param \Magento\Downloadable\Model\LinkFactory       $linkModel
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Hts\Marketplace\Controller\Product\Builder $productBuilder,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        CustomerUrl $customerUrl,
        HelperData $helper,
        NotificationHelper $notificationHelper,
        CollectionFactory $productCollection,
        \Magento\Downloadable\Model\SampleFactory $sample,
        \Magento\Downloadable\Helper\File $fileHelper,
        \Magento\Downloadable\Helper\Download $downloadHelper,
        \Magento\Downloadable\Model\LinkFactory $linkModel
    ) {
        $this->_customerSession = $customerSession;
        parent::__construct(
            $context
        );
        $this->productBuilder = $productBuilder;
        $this->_resultPageFactory = $resultPageFactory;
        $this->customerUrl = $customerUrl;
        $this->helper = $helper;
        $this->notificationHelper = $notificationHelper;
        $this->productCollection = $productCollection;
        $this->sample = $sample;
        $this->fileHelper = $fileHelper;
        $this->downloadHelper = $downloadHelper;
        $this->linkModel = $linkModel;
    }

    /**
     * Check customer authentication.
     *
     * @param RequestInterface $request
     *
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $loginUrl = $this->customerUrl->getLoginUrl();

        if (!$this->_customerSession->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        return parent::dispatch($request);
    }

    /**
     * Seller Product Edit Action.
     *
     * @return \Magento\Framework\Controller\Result\RedirectFactory
     */
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            $productId = (int) $this->getRequest()->getParam('id');
            $rightseller = $helper->isRightSeller($productId);
            if ($rightseller) {
                $product = $this->productBuilder->build(
                    $this->getRequest()->getParams(),
                    $helper->getCurrentStoreId()
                );

                if ($productId && !$product->getId()) {
                    $this->messageManager->addError(
                        __('This product no longer exists.')
                    );
                    /*
                     * @var \Magento\Backend\Model\View\Result\Redirect
                     */
                    $resultRedirect = $this->resultRedirectFactory->create();

                    return $resultRedirect->setPath(
                        '*/*/productlist',
                        ['_secure' => $this->getRequest()->isSecure()]
                    );
                }
                if ($productId) {
                    /** @var \Magento\Framework\View\Result\Page $resultPage */
                    $resultPage = $this->_resultPageFactory->create();
                    if ($helper->getIsSeparatePanel()) {
                        $resultPage->addHandle('marketplace_layout2_product_edit');
                    }
                    $resultPage->getConfig()->getTitle()->set(
                        __('Edit Product')
                    );

                    $collectionFactory = $this->productCollection;
                    /**
                     * update notification for products
                     */
                    $collection = $collectionFactory->create()
                    ->addFieldToFilter(
                        'mageproduct_id',
                        $productId
                    )->addFieldToFilter(
                        'seller_pending_notification',
                        1
                    );
                    if ($collection->getSize()) {
                        $type = \Hts\Marketplace\Model\Notification::TYPE_PRODUCT;
                        $this->notificationHelper->updateNotificationCollection(
                            $collection,
                            $type
                        );
                    }

                    return $resultPage;
                } else {
                    return $this->resultRedirectFactory->create()->setPath(
                        '*/*/add',
                        ['_secure' => $this->getRequest()->isSecure()]
                    );
                }
            } else {
                return $this->resultRedirectFactory->create()->setPath(
                    'marketplace/product/productlist',
                    ['_secure' => $this->getRequest()->isSecure()]
                );
            }
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
