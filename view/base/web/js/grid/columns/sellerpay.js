/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
define([
    './column',
    'jquery',
    'mage/template',
    'text!Hts_Marketplace/templates/grid/cells/deny/sellerpay.html',
    'Magento_Ui/js/modal/modal'
], function (Column, $, mageTemplate, denyPreviewTemplate) {
    'use strict';

    return Column.extend({
        defaults: {
            bodyTmpl: 'ui/grid/cells/html',
            fieldClass: {
                'data-grid-html-cell': true
            }
        },
        getFlag: function (row) {
            return row[this.index + '_flag'];
        },
        gethtml: function (row) {
            return row[this.index + '_html'];
        },
        getFormaction: function (row) {
            return row[this.index + '_formaction'];
        },
        getSellerid: function (row) {
            return row[this.index + '_sellerid'];
        },
        getAutoorderid: function (row) {
            return row[this.index + '_autoorderid'];
        },
        getLabel: function (row) {
            return row[this.index + '_html']
        },
        getTitle: function (row) {
            return row[this.index + '_title']
        },
        getSubmitlabel: function (row) {
            return row[this.index + '_submitlabel']
        },
        getCancellabel: function (row) {
            return row[this.index + '_cancellabel']
        },
        preview: function (row) {
            if (this.getFlag(row)==1) {
                var modalHtml = mageTemplate(
                    denyPreviewTemplate,
                    {
                        flag: this.getFlag(row),
                        html: this.gethtml(row),
                        title: this.getTitle(row),
                        label: this.getLabel(row),
                        formaction: this.getFormaction(row),
                        autoorderid: this.getAutoorderid(row),
                        sellerid: this.getSellerid(row),
                        submitlabel: this.getSubmitlabel(row),
                        cancellabel: this.getCancellabel(row),
                        linkText: $.mage.__('Go to Details Page')
                    }
                );
                var previewPopup = $('<div/>').html(modalHtml);
                previewPopup.modal({
                    title: this.getTitle(row),
                    innerScroll: true,
                    modalClass: '_image-box',
                    buttons: []}).trigger('openModal');
            }
        },
        getFieldHandler: function (row) {
            return this.preview.bind(this, row);
        }
    });
});
