<?php
/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

namespace Hts\Marketplace\Controller\Order;

/**
 * Hts Marketplace Sold Product Order Details Controller.
 */
class Salesdetail extends \Hts\Marketplace\Controller\Order
{
    /**
     * Hts Marketplace Sold Product Order Details page.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $helper = $this->helper;
        $isPartner = $helper->isSeller();
        if ($isPartner == 1) {
            /* @var \Magento\Framework\View\Result\Page $resultPage */

            $productId = (int) $this->getRequest()->getParam('id');

            $resultPage = $this->_resultPageFactory->create();
            if ($helper->getIsSeparatePanel()) {
                $resultPage->addHandle('marketplace_layout2_order_salesdetail');
            }
            $resultPage->getConfig()->getTitle()->set(
                __(
                    'Order Details of Product : %1',
                    $this->productModel->create()->load($productId)->getName()
                )
            );

            return $resultPage;
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
