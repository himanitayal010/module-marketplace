/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
 /*jshint jquery:true*/
 define([
    //'uiComponent',
    'Magento_Ui/js/grid/columns/multiselect',
    'Magento_Catalog/js/price-utils'
], function (Component, utils, paging) {
    'use strict';
    return Component.extend({
        initialize: function () {
            this._super();
            this.totalSellerPrice = this.totalSelected;
        },
        updateState: function () {
            this.totalSellerPrice = this.totalSelected;
        }
    });
});