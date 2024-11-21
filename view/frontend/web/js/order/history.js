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
    "jquery/ui",
    'mage/calendar'
], function ($) {
    'use strict';
    $.widget('mage.sellerOrderHistory', {
        _create: function () {
            var self = this;
            
            $('.ht-shipslip').click(function () {
                $('#ht-ship-light').hide();
                $('#ht-ship-fade').hide();
            });

            $('body').append($('#ht-mp-invoice-print-data'));

            $('#invoice-lightboxopen').click(function () {
                $('#form-invoice-print input, #form-invoice-print textarea').removeClass('error_border');
                $('.page-wrapper').css('opacity','0.4');
                $('#ht-mp-invoice-print-data').find('.ht-mp-model-popup').addClass('_show');
                $('#ht-mp-invoice-print-data').show();
            });
            $('.ht-close').click(function () {
                $('.page-wrapper').css('opacity','1');
                $('#resetbtn').trigger('click');
                $('#ht-mp-invoice-print-data').hide();
                $('#form-invoice-print .validation-failed').each(function () {
                    $(this).removeClass('validation-failed');
                });
                $('#form-invoice-print .validation-advice').each(function () {
                    $(this).remove();
                });
            });
            
            $('.ht-shipslip').click(function () {
                $('#ht-ship-light').hide();
                $('#ht-ship-fade').hide();
            });

            $('body').append($('#ht-mp-shipping-print-data'));

            $('#shiplightboxopen').click(function () {
                $('#form-shipping-print input,#form-shipping-print textarea').removeClass('error_border');
                $('.page-wrapper').css('opacity','0.4');
                $('#ht-mp-shipping-print-data').find('.ht-mp-model-popup').addClass('_show');
                $('#ht-mp-shipping-print-data').show();
            });
            $('.ht-close').click(function () {
                $('.page-wrapper').css('opacity','1');
                $('#resetbtn').trigger('click');
                $('#ht-mp-shipping-print-data').hide();
                $('#form-shipping-print .validation-failed').each(function () {
                    $(this).removeClass('validation-failed');
                });
                $('#form-shipping-print .validation-advice').each(function () {
                    $(this).remove();
                });
            });
            $(".ht-mp-body").dateRange({
                'dateFormat':'mm/dd/yy',
                'from': {
                    'id': 'special-from-date'
                },
                'to': {
                    'id': 'special-to-date'
                }
            });
            $("#form-shipping-print").dateRange({
                'dateFormat':'mm/dd/yy',
                'from': {
                    'id': 'editfromdatepicker'
                },
                'to': {
                    'id': 'edittodatepicker'
                }
            });
            $("#form-invoice-print").dateRange({
                'dateFormat':'mm/dd/yy',
                'from': {
                    'id': 'invoice_editfromdatepicker'
                },
                'to': {
                    'id': 'invoice_edittodatepicker'
                }
            });
        }
    });
    return $.mage.sellerOrderHistory;
});
