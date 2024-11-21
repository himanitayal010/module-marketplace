/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_Marketplace
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */
/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery',
    'mage/template',
    'uiComponent',
    'ko',
    ], function ($, mageTemplate, Component, ko) {
        'use strict';
        return Component.extend({
            initialize: function () {
                this._super();
                var self = this;
                this.notifyTmp = mageTemplate('#ht_notification_template');
                this.productData = window.notificationConfig.productNotification;
                this.sellerData = window.notificationConfig.sellerNotification;
                this.feedbackData = window.notificationConfig.feedbackNotification;
                if (this.productData.length) {
                    this._showProductNotification(this.productData);
                }
                if (this.sellerData.length) {
                    this._showSellerNotification(this.sellerData);
                }
                if (this.feedbackData.length) {
                    this._showFeedbackNotification(this.feedbackData);
                }
                $('.ht-notifications-action.marketplace-dropdown').on('click', function (event) {
                    event.preventDefault();
                    self._showNotificationBox($(this));
                });
                $('body').on('click', function (event) {
                    self._closeNotifyWindow(event);
                });
            },
            _showProductNotification: function (productData) {
                $('[data-ui-id="menu-hts-marketplace-product"]').css('position','relative');
                $('[data-ui-id="menu-hts-marketplace-product"]').css('padding-right', '50px');
                var data = {},
                    notifyTmp;

                data.notificationCount = productData.length;
                data.notificationImage = window.notificationConfig.image;
                data.notifications = productData;
                data.notificationType = 'product';
                notifyTmp = this.notifyTmp({
                    data: data
                });
                $(notifyTmp)
                .appendTo($('[data-ui-id="menu-hts-marketplace-product"]'));
            },
            _showSellerNotification: function (sellerData) {
                $('[data-ui-id="menu-hts-marketplace-seller"]').css('position','relative');
                $('[data-ui-id="menu-hts-marketplace-seller"]').css('position', '50px');
                var data = {},
                    notifyTmp;

                data.notificationCount = sellerData.length;
                data.notificationImage = window.notificationConfig.image;
                data.notifications = sellerData;
                data.notificationType = 'seller';
                notifyTmp = this.notifyTmp({
                    data: data
                });
                $(notifyTmp)
                .appendTo($('[data-ui-id="menu--marketplace-seller"]'));
            },
             _showFeedbackNotification: function (feedbackData) {
                $('[data-ui-id="menu-hts-marketplace-feedback"]').css('position','relative');
                $('[data-ui-id="menu-hts-marketplace-feedback"]').css('position', '50px');
                var data = {},
                    notifyTmp;

                data.notificationCount = feedbackData.length;
                data.notificationImage = window.notificationConfig.image;
                data.notifications = feedbackData;
                data.notificationType = 'feedback';
                notifyTmp = this.notifyTmp({
                    data: data
                });
                $(notifyTmp)
                .appendTo($('[data-ui-id="menu-hts-marketplace-feedback"]'));
            },
            _showNotificationBox: function (element) {
                
                if ($(element).parent('.ht-notification-block').length) {
                    if ($(element).hasClass('active')) {
                        $(element).removeClass('active');
                        $(element).parent('.ht-notification-block').removeClass('active');
                        $(element).next('.marketplace-dropdown-menu').hide();
                    } else {
                        $('.marketplace-dropdown-menu').hide();
                        $('.ht-notifications-action.marketplace-dropdown').removeClass('active');
                        $('.ht-notification-block').removeClass('active');
                        $(element).addClass('active');
                        $(element).parent('.ht-notification-block').addClass('active');
                        $(element).next('.marketplace-dropdown-menu').show();
                    }
                }
            },
            _closeNotifyWindow: function (event) {
                var className = event.target.className;
                if (className !== 'ht-notification-block' &&
                    className !== 'ht-notifications-action marketplace-dropdown' &&
                    className !== 'ht-notifications-action marketplace-dropdown' &&
                    className !== 'ht-notification-img' &&
                    className !== 'marketplace-dropdown-menu' &&
                    className !== 'ht-notifications-action marketplace-dropdown active' &&
                    className !== 'ht-notification-count'
                ) {
                    $('.ht-notifications-action').removeClass('active');
                    $('.ht-notification-block').removeClass('active');
                    $('.marketplace-dropdown-menu').hide();
                }
            }
        });
    });
