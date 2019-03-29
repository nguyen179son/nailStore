window.page = 1;
$(document).ready(function () {
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        window.page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    window.check = 0;
    window.id = -1;

    function fetch_data(page) {
        if (window.check == 0) {
            $.ajax({
                url: "/admin/customer-management/show?page=" + page,
                success: function (data) {
                    $('#customer-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "member/" + window.id + '?page=' + page,
                success: function (data) {
                    $('#history-member').html(data);
                }
            });
        }
    }

    $('body').on('hidden.bs.modal', '#history-modal', function () {
        window.check = 0;
    });
    $('body').on('hidden.bs.modal','#add-customer-modal',function () {
        $('#email-add-customer').val("");
        $('#name-add-customer').val("");
        $('#code').val('');
        $('#phone-number').val('');
        $("#email-error").html('');
        $("#name-error").html('');
        $("#code-error").html('');
        $("#phone-error").html('');
    });
    $('body').on('click', '.member-name', function () {
        window.check = 1;
        window.id = $(this).attr("data-id");
        $.ajax({
            url: "member/" + $(this).attr("data-id") + '?page=1',
            success: function (data) {
                $('#history-member').html(data);
            }
        });
    });
    fetch_data(1);

    $("body").on('click','#add-button',function () {
        $("#email-add-customer").val('');
        $("#name-add-customer").val('');
        $("#customer-code").val('');
    });

    $("body").on('click', '.add-history', function () {
        $("#cus-id").val($(this).data("id"));
        $("#cus-name").val($(this).data("name"));
        $("#cus-email").val($(this).data("email"));
        $("#service").val('Pedikyr');
        $("#staff").val('');
        $("#note").val('');
        $("#receipt").val('0');
        $("#service-error").html("");
        $("#staff-error").html("");
        $("#note-error").html("");
        $("#receipt-error").html("");
    });

    $("body").on('click', '#submit-add-history', function () {
        $.ajax({
            url: '/dropin-booking/add-history',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                id: $("#cus-id").val(),
                name: $("#cus-name").val(),
                email: $("#cus-email").val(),
                type: $("#service").val(),
                status: 'done',
                staff: $("#staff").val(),
                receipt: $("#receipt").val(),
                note: $("#note").val()
            },
            success: function (data) {
                $("#service-error").html("");
                $("#staff-error").html("");
                $("#note-error").html("");
                $("#receipt-error").html("");
                if (data.hasOwnProperty('errors')) {
                    var errors = data.errors;
                    if (errors.hasOwnProperty('type')) {
                        $("#service-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.type[0] + "</div>");
                    }
                    if (errors.hasOwnProperty('staff')) {
                        $("#staff-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.staff[0] + "</div>");
                    }
                    if (errors.hasOwnProperty('note')) {
                        $("#note-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.note[0] + "</div>");
                    }
                    if (errors.hasOwnProperty('receipt')) {
                        $("#receipt-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.receipt[0] + "</div>");
                    }
                } else {
                    $('#flash-message').flash_message({
                        text: 'Added record to customer history!',
                        how: 'append'
                    });
                    $("#add-history-modal").modal('hide');
                    fetch_data(window.page);
                }
            }
        })
    });

    $('body').on("keyup", "#keyword", function () {
        $.ajax({
            url: "/admin/customer-management/show?page=1",
            data: {
                keyword: $('#keyword').val()
            },
            success: function (data) {
                $('#customer-table').html(data);
            }
        });
    });

    $('body').on('click', '#submit-add-customer', function (e) {
        var email = $('#email-add-customer').val();
        var name = $('#name-add-customer').val();
        var customer_code = $('#customer-code').val();
        var phone_number = $('#phone-number').val();
        $.ajax({
            url: "/admin/member",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: email,
                name: name,
                customer_code: customer_code,
                phone_number: phone_number
            },


            success: function (data) {
                if (data.success) {
                    $('#email-add-customer').val("");
                    $('#name-add-customer').val("");
                    $('#code').val('');
                    $('#phone-number').val('');
                    $("#email-error").html('');
                    $("#name-error").html('');
                    $("#code-error").html('');
                    $("#phone-error").html('');
                    $("#add-customer-modal").modal("hide");
                    $('#flash-message').flash_message({
                        text: 'Customer successfully added!',
                        how: 'append'
                    });
                    if ($(".table-hover td").closest("tr").length == 10) {
                        if (window.page == 0) {
                            window.page = window.page + 1;
                        } else {
                            if ($(".page-link").length == window.page) {
                                window.page = window.page + 1;
                            }
                        }
                    }
                    fetch_data(window.page);
                } else {
                    var errors = data.errors;
                    $("#email-error").html("");
                    $("#name-error").html("");
                    $("#code-error").html("");
                    if (errors.hasOwnProperty('email')) {
                        $("#email-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.email[0] + "</div>")
                    }
                    if (errors.hasOwnProperty('name')) {
                        $("#name-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.name[0] + "</div>")
                    }
                    if (errors.hasOwnProperty('customer_code')) {
                        $("#code-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.customer_code[0] + "</div>")
                    }
                    if (errors.hasOwnProperty('phone_number')) {
                        $("#phone-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + errors.phone_number[0] + "</div>")
                    }
                    $("#alert-text").removeClass("text-danger text-success").addClass("text-danger");
                    $("#alert-text").text(data.message);
                    $("#alert-text").show();

                    setTimeout(function () {
                        $("#alert-text").hide();
                    }, 2000);

                }
            }
        });
    });
    $.fn.flash_message = function (options) {

        options = $.extend({
            text: 'Done',
            time: 1000,
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

    function sendRequestToUpdateEmail() {
        $.ajax({
            type: "get",
            url: '/update-online-reservation-emails',
            success: function (data) {
                console.log("sent");
                //Send another request in 10 seconds.
                setTimeout(function () {
                    sendRequestToUpdateEmail();
                }, 60000);
            },

            error: function () {
                console.log("error");
                setTimeout(function () {
                    sendRequestToUpdateEmail();
                }, 60000);
            }
        });
    }

    sendRequestToUpdateEmail();
});

