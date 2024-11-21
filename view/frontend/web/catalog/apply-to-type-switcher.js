define([
    'jquery',
    'Hts_Marketplace/js/product/weight-handler',
    'Hts_Marketplace/catalog/type-events'
], function ($, weight, productType) {
    'use strict';

    return {

        /**
         * Bind event
         */
        bindAll: function () {
            $('[data-form=edit-product] [data-role=tabs]').on(
                'contentUpdated',
                this._switchToTypeByApplyAttr.bind(this)
            );

            $('#product_info_tabs').on(
                'beforePanelsMove tabscreate tabsactivate',
                this._switchToTypeByApplyAttr.bind(this)
            );

            $(document).on('changeTypeProduct', this._switchToTypeByApplyAttr.bind(this));
        },

        /**
         * Constructor component
         */
        'Hts_Marketplace/catalog/apply-to-type-switcher': function () {
            this.bindAll();
            this._switchToTypeByApplyAttr();
        },

        /**
         * Show/hide elements based on type
         *
         * @private
         */
        _switchToTypeByApplyAttr: function () {
            $('[data-apply-to]:not(.removed)').each(function (index, element) {
                var attrContainer = $(element),
                    applyTo = attrContainer.data('applyTo') || [],
                    $inputs = attrContainer.find('select, input, textarea');

                if (applyTo.length === 0 || $.inArray(productType.type.current, applyTo) !== -1) {
                    attrContainer.removeClass('not-applicable-attribute');
                    $inputs.removeClass('ignore-validate');
                } else {
                    attrContainer.addClass('not-applicable-attribute');
                    $inputs.addClass('ignore-validate');
                }
            });
        }
    };
});