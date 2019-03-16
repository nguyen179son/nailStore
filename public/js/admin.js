$(document).ready(function () {
    window.check = 1;
    setDefaultValue();

    $("#dropin-table").hide();
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    $("#booking-container").hide();

    $("#btn-show-dropin").removeClass("active");
    $("#btn-show-booking-online").addClass("active");

    function fetch_data(page) {

        if (window.check == 0) {
            $.ajax({
                url: "/admin/fetch-dropin?page=" + page,
                data: {
                    status: window.data,
                    service_type: window.service_type,
                    day: $('#date').val()
                },
                success: function (data) {
                    $('#drop-in-queue-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "/admin/fetch-onl?page=" + page,
                data: {
                    status: window.data,
                    service_type: window.service_type,
                    day: $('#date').val()
                },
                success: function (data) {
                    $('#booking-queue-table').html(data);
                }
            });
        }
    }

    $.ajax({
        url: "/admin/fetch-onl?page=1",
        data: {
            day: $('#date').val()
        },
        success: function (data) {
            $('#booking-queue-table').html(data);
        }
    });
    $('.dropdown').find('button').text('Booking');
    window.data = [];
    window.service_type = [];


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
window.data = [];
window.service_type = [];

function showDropinTable(element) {
    $("#booking-table").hide();
    $("#dropin-table").show();

    $("#btn-show-dropin").addClass("active");
    $("#btn-show-booking-online").removeClass("active");

    window.check = 0;
    $.ajax({
        url: "/admin/fetch-dropin?page=" + 1,
        data: {
            status: window.data,
            service_type: window.service_type,
            day: $('#date').val()
        },
        success: function (data) {
            $('#drop-in-queue-table').html(data);
        }
    });
    $(element).parents('div.dropdown').find('button').text('Drop-in');
}

function showBookingTable(element) {
    $("#dropin-table").hide();
    $("#booking-table").show();

    $("#btn-show-dropin").removeClass("active");
    $("#btn-show-booking-online").addClass("active");

    window.check = 1;
    $.ajax({
        url: "/admin/fetch-onl?page=1",
        data: {
            status: window.data,
            service_type: window.service_type,
            day: $('#date').val()
        },
        success: function (data) {
            $('#booking-queue-table').html(data);
        }
    });
    $(element).parents('div.dropdown').find('button').text('Booking');
}

$('body').on('change', "#date", function () {
    var date = $('#date').val();
    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch-dropin?page=" + 1,
            type: "GET",
            data: {
                status: window.data,
                service_type: window.service_type,
                day: date
            },
            success: function (data) {
                $('#drop-in-queue-table').html(data);
            }
        });
    } else {
        $.ajax({
            url: "/admin/fetch-onl?page=" + 1,
            type: "GET",
            data: {
                status: window.data,
                service_type: window.service_type,
                day: date
            },
            success: function (data) {
                $('#booking-queue-table').html(data);
            }
        });
    }
});

$('body').on('click', "input[class='checkbox-type']", function () {
    window.service_type = [];

    $.each($("input[class='checkbox-type']:checked"), function () {
        window.service_type.push($(this).val());
    });

    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch-dropin?page=" + 1,
            type: "GET",
            data: {
                status: window.data,
                service_type: window.service_type,
                day: $('#date').val()
            },
            success: function (data) {
                $('#drop-in-queue-table').html(data);
            }
        });
    } else {
        $.ajax({
            url: "/admin/fetch-onl?page=" + 1,
            type: "GET",
            data: {
                status: window.data,
                service_type: window.service_type,
                day: $('#date').val()
            },
            success: function (data) {
                $('#booking-queue-table').html(data);
            }
        });
    }
});

$('body').on('click', '.delete', function () {
    $("#confirm-delete-button").attr('book-id', $(this).attr("id"));

});

$('body').on('click', '#confirm-delete-button', function () {
    if (check == 1) {
        $.ajax({
            url: "/reservations/" + $(this).attr("book-id"),
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            success: function () {
                $.ajax({
                    url: "/admin/fetch-onl?page=" + 1,
                    type: "GET",
                    data: {
                        status: window.data,
                        service_type: window.service_type,
                        day: $('#date').val(),
                    },
                    success: function (data) {
                        $('#booking-queue-table').html(data);
                    }
                });
            }
        });
    } else {
        $.ajax({
            url: "/dropin-booking/"+$(this).attr("book-id"),
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            success: function () {
                $.ajax({
                    url: "/admin/fetch-dropin?page=" + 1,
                    type: "GET",
                    data: {
                        status: window.data,
                        service_type: window.service_type,
                        day: $("#date").val(),
                    },
                    success: function (data) {
                        $('#drop-in-queue-table').html(data);
                    }
                });
            }
        });
    }

    $(".modal").modal('hide');
});
window.oldVal='';
$('body').on('focusin', '.dropdown-status',function(){
    window.oldVal = $(this).val();
});
$('body').on('change', '.dropdown-status', function () {
    console.log($(this).val(), $(this).attr("id"));
    if (window.check == 0) {
        $.ajax({
            url: "/dropin-booking/update-status",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                status: $(this).val(),
                id: $(this).attr("id")
            },
            success: function (data) {
                $.ajax({
                    url: "/admin/fetch-dropin?page=" + 1,
                    type: "GET",
                    data: {
                        status: window.data,
                        service_type: window.service_type,
                        day: $("#date").val()
                    },
                    success: function (data) {
                        $('#drop-in-queue-table').html(data);
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
                status: $(this).val(),
                id: $(this).attr("id")
            },
            success: function (data) {
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
                    }
                });
            }
        });

    }
    if ($(this).val() == 'done' && window.oldVal != 'done') {
        $.ajax({
            url: "/member/addPoint",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: $(this).children(":first").attr("data-email"),
                name: $(this).children(":first").attr("data-name")
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
    if ($(this).val() != 'done' && window.oldVal == 'done') {
        $.ajax({
            url: "/member/minusPoint",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: $(this).children(":first").attr("data-email"),
                name: $(this).children(":first").attr("data-name")
            },
            success: function (data) {
                console.log(data);
            }
        });
    }
});
$('body').on('click', "input[class='checkbox-status']", function () {
    window.data = [];
    $.each($("input[class='checkbox-status']:checked"), function () {
        // console.log($(this).attr('name'));
        window.data.push($(this).val());
    });
    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch-dropin?page=" + 1,
            type: "GET",
            data: {
                status: window.data,
                service_type: window.service_type,
                day: $("#date").val()
            },
            success: function (data) {
                $('#drop-in-queue-table').html(data);
            }
        });
    } else {
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
            }
        });
    }
});

function setDefaultValue() {

    // Set today
    $(".date-picker").each(function () {
        $(this).val(getToday());
        $(".selected-date").text($(this).val());

        $(this).on('change', function() {
            $(".selected-date").text($(this).val());
        });
    });


}

function getToday() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;

    return today;
}


function changeStatus(element, newStatus) {
    var parent = $(element).parents("tr"); //.attr('id');
    // var button = $("#" + parentId + " td .dropdown button");
    var button = $(parent).find("td .dropdown button");

    // var dropdownMenu = $("#" + parentId + " td .dropdown");
    var dropdownMenu = $(parent).find("td .dropdown");

    button.removeClass('status-waiting status-doing status-done status-removed').addClass('status-' + newStatus);
    button.html("<span class='status'>&bull;</span> " + newStatus);

    $(dropdownMenu).find('a').show();
    $(dropdownMenu).find('a.status-' + newStatus).hide();

    // goi api o day
}

