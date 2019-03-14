$(document).ready(function () {

    setDefaultValue();

    // $("#booking-container").hide();
    $("#dropin-table").hide();

});

function onClickCheckboxStatus() {
    // $.each($("input[class='checkbox-status']:checked"), function(){            
    //     console.log($(this).attr('name'));
    // });
}

function setDefaultValue () {

    // Set today
    $(".date-picker").each(function () {
        $(this).val(getToday());
    });
}

function getToday () {
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

function showDropinTable (element)
{
    $("#booking-table").hide();
    $("#dropin-table").show();

    $(element).parents('div.dropdown').find('button').text('Drop-in');
}

function showBookingTable (element)
{
    $("#dropin-table").hide();
    $("#booking-table").show();

    $(element).parents('div.dropdown').find('button').text('Booking');
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