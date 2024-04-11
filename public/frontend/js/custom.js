/*

Project Name : Democracy Website

Created By : Chaitanya Patil from Mypcot

*/
function submitForm(form_id, form_method, subcriber = null) {
    $('.preloader').show();
    var form = $("#" + form_id);
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData(form[0]);
    }
    var can = 0;
    $("#" + form_id)
        .find(".required")
        .each(function () {
            var here = $(this);
            if (here.val() == "") {
                here.addClass("border-danger");
                here.siblings(".select2-container")
                    .find(".selection")
                    .find(".select2-selection")
                    .addClass("border-danger");
                can++;
            }
        });
    $('#' + form_id).find(".integer-validation").each(function () {
        var here = $(this);
        var value = here.val();
        // Regular expression pattern for integers
        var integerPattern = /^-?\d+$/;
        // Check if the parsed value is an integer
        if (value != '' && (isNaN(value) || !integerPattern.test(value))) {
            here.addClass('border-danger');
            can++;
        }
    });
    $('#' + form_id).find(".positive-integer-validation").each(function () {
        var here = $(this);
        var value = here.val();
        // Regular expression pattern for integers
        var integerPattern = /^-?\d+$/;
        // Check if the parsed value is an integer
        if (value != '' && (isNaN(value) || !integerPattern.test(value) || value < 0)) {
            here.addClass('border-danger');
            can++;
        }
    });
    $('#' + form_id).find(".numeric-validation").each(function () {
        var here = $(this);
        var value = here.val();
        if (value != '' && isNaN(value)) {
            here.addClass('border-danger');
            can++;
        }
    });
    $('#' + form_id).find(".positive-numeric-validation").each(function () {
        var here = $(this);
        var value = here.val();
        if (value != '' && (isNaN(value) || value < 0)) {
            here.addClass('border-danger');
            can++;
        }
    });
    $('#' + form_id).find(".allow_numeric").each(function () {
        var here = $(this);
        var value = here.val();
        // Regular expression pattern for integers
        var integerPattern = /^(?:[1-9]\d*|0)?(?:\.\d+)?$/;
        // Check if the parsed value is an integer
        if (!integerPattern.test(value) || value < 0) {
            here.addClass('border-danger');
            can++;
        }
    });
    $('#' + form_id).find(".youtube-url-validation").each(function () {
        var here = $(this);
        var urlPattern = /^https:\/\/www\.youtube\.com\/watch\?v=/;
        if (here.val() && !urlPattern.test(here.val())) {
            here.addClass('border-danger');
            can++;
        }
    });
    
    $('#' + form_id).find("input[name='phone']").each(function () {
        var here = $(this);
        var phonePattern = /^\d{10}$/;
        if (here.val() && !phonePattern.test(here.val())) {
            here.addClass('border-danger');
            can++;
        } else if (here.val().length < 10) {
            here.addClass('border-danger');
            can++;
        }
    });
    



    if (can > 0) {
        $('.preloader').hide();
    }
    if (can == 0) {
        $.ajax({
            url: form.attr("action"),
            type: form_method,
            dataType: "html",
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                form.find(".btn-primary").attr("disabled", true);
                // addLoading();
            },
            success: function (data) {
                form.find(".btn-primary").attr("disabled", false);
                // Remove red-danger validation error after success in form
                form.find(".border-danger").removeClass("border-danger");
                var response = JSON.parse(data);
                if (response["success"] == 0) {
                    Swal.fire({
                        position: 'top',
                        icon: 'error',
                        text: response["message"],
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    $token_val = document.querySelector('input[name=_token]').value;
                    $("#" + form_id).find('input:not([disabled])').val('');
                    $("#" + form_id).find('select').val('');
                    $("#" + form_id).find('textarea').val('');
                    document.querySelector('#' + form_id + ' input[name=_token]').value = $token_val;
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        text: response["message"],
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            },
            error: function () {
                var errorMsg = "Something went wrong, please try again later.";
                form.find(".btn-primary").attr("disabled", false);
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong',
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            complete: function () {
                // Hide loader after request is completed
                $('.preloader').hide();
            }
        });
    } else {
        var ih = $(".border-danger").last().closest(".tab-pane").attr("id");
        $("#" + ih + "-tab").click();
    }
}