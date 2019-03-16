$(document).ready(function () {
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
        console.log(window.check);
        if (window.check == 0) {
            $.ajax({
                url: "/dropin-queue/fetch-data?page=" + page,
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
    console.log("hehe");
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