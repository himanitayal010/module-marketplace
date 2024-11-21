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
    $.widget('mage.earningDateRange', {
        _create: function () {
            var self = this;
            $(".ht-mp-design").dateRange({
                'dateFormat':'mm/dd/yy',
                'from': {
                    'id': 'earning-from-date'
                },
                'to': {
                    'id': 'earning-to-date'
                }
            });
        }
    });
    return $.mage.earningDateRange;
});
