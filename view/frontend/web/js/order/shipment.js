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
    "jquery",
    'mage/translate',
    'Magento_Ui/js/modal/alert',
    'mage/template'
], function ($, $t, alert, mageTemplate) {
    'use strict';
    $.widget('mage.sellerOrderShipment', {
        _create: function () {
            var self = this;
            $('#ht-mp-tracking-carrier').change(function () {
                if ($('select#ht-mp-tracking-carrier option:selected').val() != 'custom') {
                    var val = $('select#ht-mp-tracking-carrier option:selected').text();
                    $('#ht-mp-tracking-title').attr('value', $.trim(val));
                } else {
                    $('#ht-mp-tracking-title').attr('value', '');
                }
            });
            $('body').on('click', '.ht-mp-tracking-action-delete', function (e) {
                var thisObj = $(this);
                $.ajax({
                    url: thisObj.attr('data-url'),
                    type: "POST",
                    showLoader: true,
                    success:function ($data) {
                        if ($data.error) {
                            alert({
                                content: $data.message
                            });
                        } else {
                            thisObj.parents('tr').remove();
                        }
                    },
                    error: function (response) {
                        alert({
                            content: self.options.ajaxErrorMessage
                        });
                    }
                });
            });
            $('#ht-mp-tracking-add').click(function (e) {
                $.ajax({
                    url: self.options.addTrackingAjaxUrl,
                    type: "POST",
                    data: {
                        carrier: $('#ht-mp-tracking-carrier').val(),
                        title: $('#ht-mp-tracking-title').val(),
                        number: $('#ht-mp-tracking-number').val()
                    },
                    showLoader: true,
                    success:function ($data) {
                        if ($data.error) {
                            alert({
                                content: $data.message
                            });
                        } else {
                            var progressTmpl = mageTemplate('#sellerOrderShipmentTemplate'),tmpl;
                            tmpl = progressTmpl({
                                data: {
                                    carrier: $data.carrier,
                                    title: $data.title,
                                    number: $data.number,
                                    numberclass: $data.numberclass,
                                    numberclasshref: $data.numberclasshref,
                                    trackingPopupUrl: $data.trackingPopupUrl,
                                    trackingDeleteUrl: $data.trackingDeleteUrl
                                }
                            });
                            $('#ht-mp-shipment-tracking-info-tbody').append(tmpl);
                            $('#ht-mp-tracking-carrier').val('custom');
                            $('#ht-mp-tracking-title').val('');
                            $('#ht-mp-tracking-number').val('');
                        }
                    },
                    error: function (response) {
                        alert({
                            content: self.options.ajaxErrorMessage
                        });
                    }
                });
            });
        }
    });
    return $.mage.sellerOrderShipment;
});
