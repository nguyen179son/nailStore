$(document).ready(function () {

    $("body").on('click', '.add-history', function () {
        $(".badge-primary").removeClass("badge-light").removeClass("badge-primary").addClass("badge-light");
    });

    $("body").on('click', '#checkout-button', function () {
        $(".badge-primary").removeClass("badge-light").removeClass("badge-primary").addClass("badge-light");
        $("#checkout-code").focus();
    });

    // Need staff-container and add-history button.
    fetchStaff();
});

function fetchStaff() {
    return fetch('/admin/employees').then(res => res.json()).then(data => {
        var staffList = parseStaff(data);

        staffList.forEach(function (value) {
            $("#staff-container").append("<span class=\"li-staff badge badge-light\" style=\"margin-right: 6px;\">"+value+"</span>");
        });

        bindOnClickLiStaff();
    }).catch(e => console.log(e));
}

function parseStaff (staffRawStr) {

    var re = /\s*([A-Za-z1-9]+)\s*\,?\s*/g;
    var result;

    var staffList = [];

    do {
        result = re.exec(staffRawStr);
        if (result) {
            staffList.push(result[1]);
            // console.log(result[1]);
        }
    } while (result);

    return staffList;
}

function bindOnClickLiStaff() {
    $(".li-staff").on('click', function () {
        if ($(this).hasClass("badge-light")) {

            $(".badge-primary").removeClass("badge-light").removeClass("badge-primary").addClass("badge-light");

            $(this).removeClass("badge-light").addClass("badge-primary");

            $("#staff").val($(this).text());
            $("#checkout-staff").val($(this).text());



        } else if ($(this).hasClass("badge-primary")) {

            $(this).removeClass("badge-primary").addClass("badge-light");
            $("#staff").val("");
            $("#checkout-staff").val("");
        }
    });
}