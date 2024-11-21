/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
var config = {
    map: {
        '*': {
            colorpicker: 'Hts_Marketplace/js/colorpicker',
            verifySellerShop: 'Hts_Marketplace/js/account/verify-seller-shop',
            editSellerProfile: 'Hts_Marketplace/js/account/edit-seller-profile',
            sellerDashboard: 'Hts_Marketplace/js/account/seller-dashboard',
            sellerAddProduct: 'Hts_Marketplace/js/product/seller-add-product',
            sellerEditProduct: 'Hts_Marketplace/js/product/seller-edit-product',
            sellerCreateConfigurable: 'Hts_Marketplace/js/product/attribute/create',
            sellerProductList: 'Hts_Marketplace/js/product/seller-product-list',
            sellerOrderHistory: 'Hts_Marketplace/js/order/history',
            sellerOrderShipment: 'Hts_Marketplace/js/order/shipment',
            colorPickerFunction: 'Hts_Marketplace/js/color-picker-function',
            productGallery:     'Hts_Marketplace/js/product-gallery',
            baseImage:          'Hts_Marketplace/catalog/base-image-uploader',
            newVideoDialog:  'Hts_Marketplace/js/new-video-dialog',
            openVideoModal:  'Hts_Marketplace/js/video-modal',
            productAttributes:  'Hts_Marketplace/catalog/product-attributes',
            configurableAttribute:  'Hts_Marketplace/catalog/product/attribute',
            relatedProduct: 'Hts_Marketplace/js/product/related-product',
            upsellProduct: 'Hts_Marketplace/js/product/upsell-product',
            crosssellProduct: 'Hts_Marketplace/js/product/crosssell-product',
            notification : 'Hts_Marketplace/js/notification',
            separateSellerProductList: 'Hts_Marketplace/js/product/separate-seller-product-list',
            formButtonAction: 'Hts_Marketplace/js/form-button-action',
            "OwlCarousel": "Hts_Marketplace/js/sellerlideshow/owl.carousel.min",
            "htSellerSlideShow": 'Hts_Marketplace/js/sellerlideshow/htSellerSlideShow',
            'Magento_Ui/js/form/element/date':  'Hts_Marketplace/js/form/element/date',
            descriptionGallary: 'Hts_Marketplace/js/description-gallery'
        }
    },
    paths: {
        "colorpicker": 'js/colorpicker'
    },
    "shim": {
        "colorpicker" : ["jquery"],
        "OwlCarousel" : ["jQuery"]
    }
};
