define([
    './column',
    'jquery'
], function (Column, $) {
    'use strict';

    return Column.extend({
        defaults: {
            fieldClass: {
                'ht-mp-grid-price-cell': true
            }
        }
    });
});
