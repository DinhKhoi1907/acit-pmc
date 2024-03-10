/* Exists */
$.fn.exists = function () {
    return this.length;
};

/*
|--------------------------------------------------------------------------
| Kiểm tra validate form
|--------------------------------------------------------------------------
*/
function ValidationFormSelf(ele = '') {
    $('#loading_order').hide();

    if (ele) {
        //$("."+ele).find("input[type=submit]").removeAttr("disabled");
        $("." + ele).find("button[type=submit]").removeAttr("disabled");
        var forms = document.getElementsByClassName(ele);

        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    //$('#loading_order').show();                    
                }
                form.classList.add('was-validated');
            }, false);
        });
    }

    // if(ele)
    // {
    //     $("."+ele).find("input[type=submit]").removeAttr("disabled");
    //     var forms = document.getElementsByClassName(ele);
    //     var validation = Array.prototype.filter.call(forms,function(form){            
    //         form.addEventListener('submit', function(event){
    //             if(form.checkValidity() === false){
    //                 event.preventDefault();
    //                 event.stopPropagation();                    
    //             }else{                    
    //                 $('#loading_order').show();                    
    //             }
    //             form.classList.add('was-validated');
    //         }, false);
    //     });
    // }
}


/*
|--------------------------------------------------------------------------
| Đăng ký bằng facebook , google, ect...
|--------------------------------------------------------------------------
*/
function SocialLogin(url) {
    $('#loading_order').show();
    window.location.href.substr(0, window.location.href.indexOf('#'))
    window.location = url;
}


/*
|--------------------------------------------------------------------------
| Tìm kiếm
|--------------------------------------------------------------------------
*/

function modalNotify(text) {
    Swal.fire({
        position: 'top',
        icon: 'warning',
        title: '<p class="h6">' + text + '</p>',
        showConfirmButton: false,
        timer: 1500,
        toast: true
    });
}

function doEnter(event, obj) {

    if (event.keyCode == 13 || event.which == 13) onSearch(obj);
}


function onSearch(obj) {
    var keyword = $("#" + obj).val();

    if (keyword == '') {
        modalNotify(LANG_KEY['no_keywords']);
        return false;
    } else {
        location.href = "tim-kiem?keyword=" + keyword;
        loadPage(document.location);
    }
}


function doEnterBlog(event, obj) {

    if (event.keyCode == 13 || event.which == 13) onSearchBlog(obj);
}

function onSearchBlog(obj) {
    var keyword = $("#" + obj).val();

    if (keyword == '') {
        modalNotify(LANG_KEY['no_keywords']);
        return false;
    } else {
        location.href = "tim-kiem-blog?keyword=" + keyword;
        loadPage(document.location);
    }
}


/*
|--------------------------------------------------------------------------
| Cập nhật giỏ hàng
|--------------------------------------------------------------------------
*/
function update_cart(id = 0, code = '', quantity = 1) {
    if (id) {
        var ship = $(".price-ship").val();
        var voucher_code = $('#voucher').val();
        var dienthoai = $('#dienthoai').val();

        $.ajax({
            type: "POST",
            url: "ajax/ajax-cart",
            dataType: 'json',
            data: { voucher_code: voucher_code, dienthoai: dienthoai, cmd: 'update-cart', id: id, code: code, quantity: quantity, ship: ship, _token: $('input[name="_token"]').val() },
            success: function (result) {
                if (result.is_soluong == false) {
                    $('.quantity-counter-procart-' + code).find('.quantity-procat').val(result.soluong_buy);
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: '<p class="h5">' + result.thongbao_status + '</p>',
                        showConfirmButton: false,
                        timer: 2500,
                        toast: true
                    })
                    return false;
                }

                if (result) {
                    $('.load-price-' + code).html(result.gia);
                    $('.load-price-new-' + code).html(result.giamoi);
                    $('.price-temp').val(result.temp);
                    $('.load-price-temp').html(result.tempText);
                    $('.price-total').val(result.total);
                    $('.load-price-total').html(result.totalText);

                    $('.coupon-temp').val(result.coupon);
                    $('.load-price-discount').html(result.couponText);
                    $('.ajax-count-cart').each(function () {
                        $(this).html(result.max);
                    });
                    //$('.count-cart').html(result.max);
                    if (result.total >= 5000) {
                        $('.payments-alepay').removeClass('d-none');
                    } else {
                        $('.payments-alepay').addClass('d-none');
                        $('#payments-3').prop('checked', false);
                        $('#payments-4').prop('checked', false);
                    }

                    if (result.status == false) {
                        if (result.text && result.text != '') { $('#voucher-content').removeClass('text-success').addClass('d-block text-error').text(result.text); }
                        $('.load-price-coupon').text(result.sotien_duocgiam_text);
                    } else {
                        if (result.text && result.text != '') { $('#voucher-content').removeClass('text-error').addClass('d-block text-success').text(result.text); }
                        $('input[name="coupon-temp"]').val(result.sotien_duocgiam);
                        $('.load-price-coupon').text(result.sotien_duocgiam_text);
                        $('.load-price-total').text(result.tongtien_saugiam_text);
                    }
                    console.log(result);
                }
            }
        });
    }
}

function load_district(id = 0) {
    $.ajax({
        type: 'post',
        url: 'ajax/ajax-district',
        data: { id_city: id, _token: $('input[name="_token"]').val() },
        success: function (result) {
            $(".select-district").html(result);
            $(".select-wards").html('<option value="">' + LANG_KEY['wards'] + '</option>');
        }
    });
}

function load_wards(id = 0) {
    $.ajax({
        type: 'post',
        url: 'ajax/ajax-wards',
        data: { id_district: id, _token: $('input[name="_token"]').val() },
        success: function (result) {
            $(".select-wards").html(result);
        }
    });
}


/*
|--------------------------------------------------------------------------
| submit form with recaptcha google
|--------------------------------------------------------------------------
*/
function submitNewsletterForm() {
    window.grecaptcha.ready(function () {
        $(".frm_check_recaptcha").each(function (index) {
            var $formContact = $(this);
            var type = $(this).find('input[name="type"]').val();
            if ($formContact.length) {
                $formContact.submit(function (e) {
                    e.preventDefault();
                    var action = type;
                    window.grecaptcha.execute(SITE_KEY_GOOGLE, { action: action }).then(function (token) {
                        var $recaptchaAction = $('#recaptcha_action');
                        var $recaptchaToken = $('#recaptcha_token');
                        if ($recaptchaAction.length) {
                            $recaptchaAction.val(action);
                        } else {
                            $formContact.append('<input type="hidden" name="recaptcha_action" id="recaptcha_action" value="' + action + '" />');
                        }
                        if ($recaptchaToken.length) {
                            $recaptchaToken.val(token);
                        } else {
                            $formContact.append('<input type="hidden" name="recaptcha_token" id="recaptcha_token" value="' + token + '" />');
                        }
                        $formContact.unbind('submit');//.submit();
                    });
                });
            } // End if
        });
    })
}

$(document).ready(function () {
    //submitNewsletterForm();
});


var onloadCallback = function () {
    console.log("grecaptcha is ready!");

    $(".frm_check_recaptcha").each(function (index) {
        var $formContact = $(this);
        var type = $(this).find('input[name="type"]').val();
        var id = $(this).attr('id');

        if ($formContact.length) {
            $formContact.submit(function (e) {
                e.preventDefault();
                var action = type;

                $formContact.unbind('submit');//.submit();

                window.grecaptcha.execute(SITE_KEY_GOOGLE, { action: action }).then(function (token) {
                    var $recaptchaAction = $('#recaptcha_action');
                    var $recaptchaToken = $('#recaptcha_token');

                    // var forms = document.getElementsByClassName(ele);

                    if ($recaptchaAction.length) {
                        $recaptchaAction.val(action);
                    } else {
                        $formContact.append('<input type="hidden" name="recaptcha_action" id="recaptcha_action" value="' + action + '" />');
                    }
                    if ($recaptchaToken.length) {
                        $recaptchaToken.val(token);
                    } else {
                        $formContact.append('<input type="hidden" name="recaptcha_token" id="recaptcha_token" value="' + token + '" />');
                    }

                    if (document.getElementById(id).checkValidity()) {
                        $('#loading_order').show();
                        $formContact.bind('submit').submit();
                    }
                });
            });
        } // End if
    });


    // $( ".frm_check_recaptcha" ).each(function( index ) {        
    //     var $formContact = $(this);
    //     var type = $(this).find('input[name="type"]').val();

    //     if ($formContact.length) {
    //         $formContact.submit(function (e) {
    //             e.preventDefault();
    //             var action = type;

    //             window.grecaptcha.execute(SITE_KEY_GOOGLE, {action: action}).then(function (token) {
    //                 var $recaptchaAction = $('#recaptcha_action');
    //                 var $recaptchaToken = $('#recaptcha_token');
    //                 if ($recaptchaAction.length) {
    //                     $recaptchaAction.val(action);
    //                 } else {
    //                     $formContact.append('<input type="hidden" name="recaptcha_action" id="recaptcha_action" value="' + action + '" />');
    //                 }
    //                 if ($recaptchaToken.length) {
    //                     $recaptchaToken.val(token);
    //                 } else {
    //                     $formContact.append('<input type="hidden" name="recaptcha_token" id="recaptcha_token" value="' + token + '" />');
    //                 }
    //                 $formContact.unbind('submit');//.submit();
    //             });
    //         });
    //     } // End if
    // });
};


$(window).on('load', function () {
    if ($('.frm_check_recaptcha').exists()) {
        $.ajax({
            url: 'ajax/ajax-js',
            type: "GET",
            dataType: 'html',
            success: function (result) {
                if (result) {
                    if ($("#recaptcha_element").exists()) {
                        $('#recaptcha_element').html(result);
                    }
                }
            }
        });
    }
});



function ShipCart() {
    var ship = $(".price-ship").val();

    $.ajax({
        type: "POST",
        url: 'ajax/ajax-cart',
        dataType: 'json',
        data: { cmd: 'ship-cart', ship: ship, _token: $('input[name="_token"]').val() },
        success: function (result) {
            if (result) {
                $('.price-temp').val(result.temp);
                $('.load-price-temp').html(result.tempText);
                $('.price-total').val(result.total);
                $('.coupon-temp').val(result.sotien_duocgiam);
                $('.load-price-total').html(result.totalText);
            }
        }
    });
}

function ChangeUrlBrowser(urlNew) {
    const nextURL = urlNew;
    const nextTitle = '';
    const nextState = {};
    // This will create a new entry in the browser's history, without reloading
    //window.history.pushState(nextState, nextTitle, nextURL);

    // This will replace the current entry in the browser's history, without reloading
    window.history.replaceState(nextState, nextTitle, nextURL);
}

function GetPhotoZone() {
    $('.module-upload-file').each(function () {
        var e_id = $(this).attr('id');
        var e_for = $(this).attr('for');
        var e_preview = $(this).attr('data-preview');

        photoZone("#" + e_id, "#" + e_for, "#" + e_preview + " img");
    })
}

function photoZone(eDrag, iDrag, eLoad) {
    if ($(eDrag).length) {
        /* Drag over */
        $(eDrag).on("dragover", function () {
            $(this).addClass("drag-over");
            return false;
        });

        /* Drag leave */
        $(eDrag).on("dragleave", function () {
            $(this).removeClass("drag-over");
            return false;
        });

        /* Drop */
        $(eDrag).on("drop", function (e) {
            e.preventDefault();
            $(this).removeClass("drag-over");

            var lengthZone = e.originalEvent.dataTransfer.files.length;

            if (lengthZone == 1) {
                $(iDrag).prop("files", e.originalEvent.dataTransfer.files);
                readImage($(iDrag), eLoad);
            } else if (lengthZone > 1) {
                notifyDialog("Bạn chỉ được chọn 1 hình ảnh để upload");
                return false;
            } else {
                notifyDialog("Dữ liệu không hợp lệ");
                return false;
            }
        });

        /* File zone */
        $(iDrag).change(function () {
            readImage($(this), eLoad);
        });
    }
}

/* Reader image */
function readImage(inputFile, elementPhoto) {
    if (inputFile[0].files[0]) {
        if (inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            var size = parseInt(inputFile[0].files[0].size) / 1024;

            var reader = new FileReader();
            reader.onload = function (e) {
                $(elementPhoto).attr('src', e.target.result);
            }
            reader.readAsDataURL(inputFile[0].files[0]);

            // if(size <= 4096){
            //     var reader = new FileReader();
            //     reader.onload = function(e){
            //         $(elementPhoto).attr('src', e.target.result);
            //     }
            //     reader.readAsDataURL(inputFile[0].files[0]);
            // }else{
            //     notifyDialog("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB");
            //     return false;
            // }
        } else {
            notifyDialog("Hình ảnh không hợp lệ");
            return false;
        }
    } else {
        notifyDialog("Dữ liệu không hợp lệ");
        return false;
    }
}

/* Sweet Alert - Notify */
function notifyDialog(text) {
    const swalconst = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-sm bg-gradient-primary text-sm',
        },
        buttonsStyling: false
    })
    swalconst.fire({
        text: text,
        icon: "info",
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
        showClass: {
            popup: 'animated fadeIn faster'
        },
        hideClass: {
            popup: 'animated fadeOut faster'
        }
    })
}

/* Sweet Alert - Confirm */
function confirmDialog(action, text, value) {
    const swalconst = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-sm bg-gradient-primary text-sm mr-2',
            cancelButton: 'btn btn-sm bg-gradient-danger text-sm'
        },
        buttonsStyling: false
    })
    swalconst.fire({
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Hủy',
        showClass: {
            popup: 'animated zoomIn faster'
        },
        hideClass: {
            popup: 'animated fadeOut faster'
        }
    }).then((result) => {
        if (result.value) {
            if (action == "delete-postnews") deletePostNews(value);
        }
    })
}