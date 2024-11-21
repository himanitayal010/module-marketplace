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
    "jquery/ui",
    'mage/calendar'
], function ($, $t, alert) {
    'use strict';
    $.widget('mage.sellerAddProduct', {
        options: {
            errorMessageSku: $t("SKU can\'t be left empty"),
            ajaxErrorMessage: $t('There was error during fetching results.'),
            productid: 0
        },
        _create: function () {
            var self = this;
            $("#edit-product").dateRange({
                'dateFormat':'mm/dd/yy',
                'from': {
                    'id': 'special-from-date'
                },
                'to': {
                    'id': 'special-to-date'
                }
            });
            $('#ht-mp-save-duplicate-btn').click(function () {
                $("#edit-product").append('<input type="hidden" name="back" value="duplicate">');
                $('#save-btn').trigger('click');
            });
            $('#save-btn').click(function (e) {
                if ($("#edit-product").valid()!==false) {
                    if ($('#description_ifr').length) {
                        var desc = $('#description_ifr').contents().find('#tinymce').text();
                        $('#description-error').remove();
                        if (desc === "" || desc === null) {
                            $('#description-error').remove();
                            $('#description').parent().append('<div class="mage-error" generated="true" id="description-error">This is a required field.</div>');
                        }
                        if (desc !== "" && desc !== null) {
                            $('.button').css('opacity','0.7');
                            $('.button').css('cursor','default');
                            $('.button').attr('disabled','disabled');
                            $('body').trigger('processStart');
                            $('#edit-product').submit();
                        } else {
                            return false;
                        }
                    }
                }
            });
            $('.input-text').change(function () {
                var validt = $(this).val();
                var regex = /(<([^>]+)>)/ig;
                var mainvald = validt .replace(regex, "");
                $(this).val(mainvald);
            });
            $('input#sku').change(function () {
                var len=$('input#sku').val();
                var len2=len.length;
                if (len2 === 0) {
                    alert({
                        content: self.options.errorMessageSku
                    });
                    $('div#skuavail').css('display','none');
                    $('div#skunotavail').css('display','none');
                } else {
                    self.callVerifySkuAjaxFunction();
                }
            });
            $('body').on('change','.ht-elements',function () {
                var category_id=$(this).val();
                if (this.checked === true) {
                    var $obj = $('<input/>').attr('type','hidden').attr('name','product[category_ids][]').attr('id','ht-cat-hide'+category_id).attr('value',category_id);
                    $('.ht-for-validation').append($obj);
                } else {
                    $('#ht-cat-hide'+category_id).remove();
                }
            });
            $("#ht-bodymain").delegate('.ht-plus ,.ht-plusend,.ht-minus, .ht-minusend ',"click",function () {
                var thisthis=$(this);
                if (thisthis.hasClass("ht-plus") || thisthis.hasClass("ht-plusend")) {
                    if (thisthis.hasClass("ht-plus")) {
                        thisthis.removeClass('ht-plus').addClass('ht-plus_click');
                    }
                    if (thisthis.hasClass("ht-plusend")) {
                        thisthis.removeClass('ht-plusend').addClass('ht-plusend_click');
                    }
                    thisthis.prepend("<span class='ht-node-loader'></span>");
                    self.callCategoryTreeAjaxFunction(thisthis);
                }
                if (thisthis.hasClass("ht-minus") || thisthis.hasClass("ht-minusend")) {
                    self.callRemoveCategoryNodeFunction(thisthis);
                }
            });
        },
        callVerifySkuAjaxFunction: function () {
            var self = this;
            $.ajax({
                url: self.options.verifySkuAjaxUrl,
                type: "POST",
                data: {sku:$('input#sku').val(), product_id:self.options.productid},
                dataType: 'html',
                success:function ($data) {
                    $data=JSON.parse($data);
                    if ($data.avialability==1) {
                        $('div#skuavail').css('display','block');
                        $('div#skunotavail').css('display','none');
                    } else {
                        $('div#skunotavail').css('display','block');
                        $('div#skuavail').css('display','none');
                        $("input#sku").attr('value','');
                    }
                },
                error: function (response) {
                    alert({
                        content: self.options.ajaxErrorMessage
                    });
                }
            });
        },
        callCategoryTreeAjaxFunction: function (thisthis) {
            var self = this;
            var i, len, name, id;
            $.ajax({
                url     :   self.options.categoryTreeAjaxUrl,
                type    :   "POST",
                data    :   {
                    parentCategoryId:thisthis.siblings("input").val()
                },
                dataType:   "html",
                success :   function (content) {
                    var newdata=  $.parseJSON(content);
                    len = newdata.length;
                    var pxl= parseInt(thisthis.parent(".ht-cat-container").css("margin-left").replace("px",""))+20;
                    thisthis.find(".ht-node-loader").remove();
                    if (thisthis.attr("class") == "ht-plus") {
                        thisthis.attr("class","ht-minus");
                    }
                    if (thisthis.attr("class") == "ht-plusend") {
                        thisthis.attr("class","ht-minusend");
                    }
                    if (thisthis.attr("class") == "ht-plus_click") {
                        thisthis.attr("class","ht-minus");
                    }
                    if (thisthis.attr("class") == "ht-plusend_click") {
                        thisthis.attr("class","ht-minusend");
                    }
                    for (i=0; i<len; i++) {
                        id=newdata[i].id;
                        name=newdata[i].name;
                        if ($('#ht-cat-hide'+id).length) {
                            if (newdata[i].counting === 0) {
                                thisthis.parent(".ht-cat-container").after('<div class="ht-removable ht-cat-container" style="display:none;margin-left:'+pxl+'px;"><span  class="ht-no"></span><span class="ht-foldersign"></span><span class="ht-elements ht-cat-name">'+ name +'</span><input class="ht-elements" type="checkbox" checked name="product[category_ids][]" value='+ id +'></div>');
                            } else {
                                thisthis.parent(".ht-cat-container").after('<div class="ht-removable ht-cat-container" style="display:none;margin-left:'+pxl+'px;"><span  class="ht-plusend"></span><span class="ht-foldersign"></span><span class="ht-elements ht-cat-name">'+ name +'</span><input class="ht-elements" type="checkbox" checked name="product[category_ids][]" value='+ id +'></div>');
                            }
                        } else {
                            if (newdata[i].counting === 0) {
                                thisthis.parent(".ht-cat-container").after('<div class="ht-removable ht-cat-container" style="display:none;margin-left:'+pxl+'px;"><span  class="ht-no"></span><span class="ht-foldersign"></span><span class="ht-elements ht-cat-name">'+ name +'</span><input class="ht-elements" type="checkbox" name="product[category_ids][]" value='+ id +'></div>');
                            } else {
                                thisthis.parent(".ht-cat-container").after('<div class="ht-removable ht-cat-container" style="display:none;margin-left:'+pxl+'px;"><span  class="ht-plusend"></span><span class="ht-foldersign"></span><span class="ht-elements ht-cat-name">'+ name +'</span><input class="ht-elements" type="checkbox" name="product[category_ids][]" value='+ id +'></div>');
                            }
                        }
                    }
                    thisthis.parent(".ht-cat-container").nextAll().slideDown(300);
                },
                error: function (response) {
                    alert({
                        content: self.options.ajaxErrorMessage
                    });
                }
            });
        },
        callRemoveCategoryNodeFunction: function (thisthis) {
            if (thisthis.attr("class") == "ht-minus") {
                thisthis.attr("class","ht-plus");
            }
            if (thisthis.attr("class") == "ht-minusend") {
                thisthis.attr("class","ht-plusend");
            }
            var thiscategory = thisthis.parent(".ht-cat-container");
            var marg= parseInt(thiscategory.css("margin-left").replace("px",""));
            while (thiscategory.next().hasClass("ht-removable")) {
                if (parseInt(thiscategory.next().css("margin-left").replace("px",""))>marg) {
                    thiscategory.next().slideUp("slow",function () {
                        $(this).remove();
                    });
                }
                thiscategory = thiscategory.next();
                if (typeof thiscategory.next().css("margin-left")!= "undefined") {
                    if (marg == thiscategory.next().css("margin-left").replace("px","")) {
                        break;
                    }
                }
            }
        }
    });
    return $.mage.sellerAddProduct;
});
