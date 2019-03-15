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

    function fetch_data(page) {

        if (window.check == 0) {
            $.ajax({
                url: "/admin/fetch_dropin?page=" + page,
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
                url: "/admin/fetch_onl?page=" + page,
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
        url: "/admin/fetch_onl?page=1",
        data: {
            day:  $('#date').val()
        },
        success: function (data) {
            $('#booking-queue-table').html(data);
        }
    });
    $('.dropdown').find('button').text('Booking');
window.data = [];
window.service_type = [];
});
window.data = [];
window.service_type = [];

function showDropinTable(element) {
    $("#booking-table").hide();
    $("#dropin-table").show();
    window.check = 0;
    $.ajax({
        url: "/admin/fetch_dropin?page=" + 1,
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
    window.check = 1;
    $.ajax({
        url: "/admin/fetch_onl?page=1",
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

$('body').on('change',"#date",function () {
    var date = $('#date').val();
    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch_dropin?page=" + 1,
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
            url: "/admin/fetch_onl?page=" + 1,
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
    window.service_type=[];

    $.each($("input[class='checkbox-type']:checked"), function () {
        window.service_type.push($(this).val());
    });

    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch_dropin?page=" + 1,
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
            url: "/admin/fetch_onl?page=" + 1,
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

$('body').on('click','.delete',function () {
    $("#confirm-delete").attr('book-id',$(this).attr("id"));

});

$('body').on('click','#confirm-delete',function () {
    if (check==1) {
        $.ajax({
            url: "/reservations/"+$(this).attr("book-id"),
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            success: function () {
                $.ajax({
                    url: "/admin/fetch_onl?page=" + 1,
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
            url: "/dropinBooking/"+$(this).attr("book-id"),
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            success: function () {
                $.ajax({
                    url: "/admin/fetch_dropin?page=" + 1,
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

$('body').on('change','.dropdown-status',function () {
    console.log($(this).val(), $(this).attr("id"));
    if (window.check == 0) {
        $.ajax({
            url: "/dropinBooking/updateStatus",
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
                    url: "/admin/fetch_dropin?page=" + 1,
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

        $.ajax({
            url: "/member/addPoint",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: $(this).attr("data-email")
            },
            success: function (data) {
                console.log(data);
            }
        });

    } else {
        $.ajax({
            url: "/reservations/updateStatus",
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
                    url: "/admin/fetch_onl?page=" + 1,
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

});
$('body').on('click', "input[class='checkbox-status']", function () {
    window.data=[];
    $.each($("input[class='checkbox-status']:checked"), function () {
        // console.log($(this).attr('name'));
        window.data.push($(this).val());
    });
    if (window.check == 0) {
        $.ajax({
            url: "/admin/fetch_dropin?page=" + 1,
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
            url: "/admin/fetch_onl?page=" + 1,
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

