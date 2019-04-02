$(document).ready(function () {
    var ref = document.referrer;

    var getLocation = function(href) {
        var l = document.createElement("a");
        l.href = href;
        return l;
    };

    var l = getLocation(ref);
    console.log(l.pathname);

    if(l.pathname !== "/" && l.pathname !== '/admin')
    {
        setTimeout(function(){
            window.location.href = document.referrer;
        }, 30000);
    }

    $("#table-booking").hide();
    $("#btn-show-dropin-1").addClass("active");
    $("#btn-show-dropin-2").addClass("active");

    window.check = 0;
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        if (window.check == 0) {
            $.ajax({
                url: "/dropin-queue/fetch-data?page=" + page,
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                },
                success: function (data) {
                    $('#drop-in-queue-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "/reservations/fetch-data?page=" + page,
                success: function (data) {
                    $('#booking-table').html(data);
                }
            });
        }
    }

    $.ajax({
        url: "/dropin-booking/count",
        success: function (data) {
            $('#drop-in-res-num').text(data);
        }
    });
    $.ajax({
        url: "/reservations/count",
        success: function (data) {
            $('#onl-res-num').text(data);
        }
    })
});
$.fn.flash_message = function (options) {

    options = $.extend({
        text: 'Done',
        time: 3000,
        how: 'before',
        class_name: ''
    }, options);

    return $(this).each(function () {
        if ($(this).parent().find('.flash_message').get(0))
            return;

        var message = $('<span />', {
            'class': 'alert alert-info flash_message ' + options.class_name,
            text: options.text
        }).hide().fadeIn('fast');

        $(this)[options.how](message);

        message.delay(options.time).fadeOut('normal', function () {
            $(this).remove();
        });

    });
};
$("body").on('hidden.bs.modal','#fill-in-code',function () {
    $("#code").val("0000");
    $("#error").html("");
});
$('body').on('click', '#submit-add-customer', function () {
    $.ajax({
        url: "member/check",
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $("input[name=_token]").val()
        },
        data: {
            phone_number: $("#email").val(),
            code: $("#code").val()
        },
        success: function (data) {


            if (data.errors !== undefined) {
                $("#error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + data.errors.code[0] + "</div>")
            } else {
                $("#error").html("");
                if (window.check == 0) {
                    $.ajax({
                        url: "/dropin-booking/update-status",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $("input[name=_token]").val()
                        },
                        data: {
                            status: 'checked-in',
                            id: $("#book-id").val()
                        },
                        success: function (data) {
                            if (data !== undefined) {
                                if (data.hasOwnProperty('discount')) {
                                    $('#flash-message').flash_message({
                                        text: 'Congratulation, you will have 50% discount today',
                                        how: 'append'
                                    });
                                }
                            }

                            $.ajax({
                                url: "/dropin-queue/fetch-data?page=" + 1,
                                type: "GET",
                                data: {
                                    status: window.data,
                                    service_type: window.service_type,
                                    day: $("#date").val()
                                },
                                success: function (data) {
                                    $('#drop-in-queue-table').html(data);
                                    $("#fill-in-code").modal('hide');
                                    $.ajax({
                                        url: "/dropin-booking/count",
                                        success: function (data) {
                                            $('#drop-in-res-num').text(data);
                                        }
                                    });
                                }
                            });
                        }
                    });

                } else {
                    $.ajax({
                        url: "/reservations/update-status",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $("input[name=_token]").val()
                        },
                        data: {
                            status: 'checked-in',
                            id: $("#book-id").val()
                        },
                        success: function (data) {
                            if (data !== undefined) {
                                if (data.hasOwnProperty('discount')) {
                                    $('#flash-message').flash_message({
                                        text: 'Congratulation, you will have 50% discount today',
                                        how: 'append'
                                    });
                                }
                            }
                            $.ajax({
                                url: "/admin/fetch-onl?page=" + 1,
                                type: "GET",
                                data: {
                                    status: window.data,
                                    service_type: window.service_type,
                                    day: $("#date").val()
                                },
                                success: function (data) {
                                    $('#booking-queue-table').html(data);
                                    $("#fill-in-code").modal('hide');
                                    $.ajax({
                                        url: "/reservations/count",
                                        success: function (data) {
                                            $('#onl-res-num').text(data);
                                        }
                                    });
                                }
                            });

                        }
                    });
                }
            }
        }
    });
});

// $('body').on('click','tr',function (event) {
//     $("#fill-in-code").modal();
//     $("#email").val($(this).data('email'));
//     $("#book-id").val($(this).data('id'));
// });

function showModalEnterCode(element)
{
    $("#fill-in-code").modal();
    $("#email").val($(element).data('phone'));
    $("#book-id").val($(element).data('id'));
}

function showDropinTable() {
    window.check = 0;
    $("#table-booking").hide();
    $("#table-drop-in").show();

    $("#btn-show-dropin-1").addClass("active");
    $("#btn-show-booking-online-1").removeClass("active");

    $("#btn-show-dropin-2").addClass("active");
    $("#btn-show-booking-online-2").removeClass("active");

    $.ajax({
        url: "/dropin-queue/fetch-data?page=" + 1,
        success: function (data) {
            $('#drop-in-queue-table').html(data);
        }
    });
}

function showBookingTable() {
    window.check = 1;
    $("#table-drop-in").hide();
    $("#table-booking").show();

    $("#btn-show-dropin-1").removeClass("active");
    $("#btn-show-booking-online-1").addClass("active");

    $("#btn-show-dropin-2").removeClass("active");
    $("#btn-show-booking-online-2").addClass("active");

    $.ajax({
        url: "/reservations/fetch-data?page=" + 1,
        success: function (data) {
            $('#booking-table').html(data);
        }
    });
}