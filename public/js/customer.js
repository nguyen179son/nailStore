$(document).ready(function () {
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
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

    $('body').on("change", "#keyword", function () {
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

        $.ajax({
            url: "/admin/member",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: email,
                name: name,
            },


            success: function (data) {
                if (data.success) {
                    $('#email-add-customer').val("");
                    $('#name-add-customer').val("");

                    // $("#alert-text").removeClass("text-danger text-success").addClass("text-success");
                    // $("#alert-text").text(data.message);
                    // $("#alert-text").show();
                    $("#email-error").html('');
                    $("#name-error").html('');
                    // setTimeout(function() {
                    //     $("#alert-text").hide();
                    $("#add-customer-modal").modal("hide");
                    //
                    // }, 1000);
                    // $("#add-customer-modal").modal("hide");
                    // $("#flash-message").html("<div class='alert alert-info'>Successfully created</div>")
                    // $("#flash-message").slideDown(function() {
                    //     setTimeout(function() {
                    //         $("#flash-message").slideUp();
                    //     }, 5000);
                    // });
                    $('#flash-message').flash_message({
                        text: 'Customer successfully added!',
                        how: 'append'
                    });
                } else {
                    if (data.errors.email[0]) {
                        $("#email-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + data.errors.email[0] + "</div>")
                    }
                    if (data.errors.name[0]) {
                        $("#name-error").html("<div class=\"alert\" style=\"padding-top: 0;color: red\">" + data.errors.name[0] + "</div>")
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
            success:function(data)
            {
                //console.log the response
                console.log("sent");
                //Send another request in 10 seconds.
                setTimeout(function(){
                    sendRequestToUpdateEmail();
                }, 60000);
            },

            error:function() {
                console.log("error");
                setTimeout(function(){
                    sendRequestToUpdateEmail();
                }, 60000);
            }
        });
    }

    sendRequestToUpdateEmail();
});

