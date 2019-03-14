$(document).ready(function () {
    window.check = 1;

    setDefaultValue();

    // $("#booking-container").hide();
    $("#dropin-table").hide();
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {

        if (window.check == 0) {
            $.ajax({
                url: "/admin/fetch_dropin?page=" + page,
                success: function (data) {
                    $('#drop-in-queue-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "/admin/fetch_onl?page=" + page,
                success: function (data) {
                    $('#booking-table').html(data);
                }
            });
        }
    }
    $.ajax({
        url: "/admin/fetch_onl?page=1",
        success: function (data) {
            console.log(data);
            $('#booking-table').html(data);
        }
    });
});

function showDropinTable(element) {
    $("#booking-table").hide();
    $("#dropin-table").show();
    window.check = 0;
    $.ajax({
        url: "/admin/fetch_dropin?page=" + 1,
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
        success: function (data) {
            console.log(data);
            $('#booking-table').html(data);
        }
    });
    $(element).parents('div.dropdown').find('button').text('Booking');
}

function onClickCheckboxStatus() {
    // $.each($("input[class='checkbox-status']:checked"), function(){
    //     console.log($(this).attr('name'));
    // });
}

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