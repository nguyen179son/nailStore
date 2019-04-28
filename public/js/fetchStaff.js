$(document).ready(function () {

    // Need staff-container and add-history button.

    var staffRawStr = "Hung1, Hung2, Hung3, Hung4, Hung5, Hung6, Hung7, Hung8, Hung9, Hung10, Hung11, Hung12, Hung13, Hung14, Hung15, Hung16, Hung17, Hung18, Hung19";
    
    var staffList = parseStaff(staffRawStr);

    staffList.forEach(function (value) {
        $("#staff-container").append("<span class=\"li-staff badge badge-light\">"+value+"</span>");
    });
    
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

    $("body").on('click', '.add-history', function () {
        $(".badge-primary").removeClass("badge-light").removeClass("badge-primary").addClass("badge-light");
    });

    $("body").on('click', '#checkout-button', function () {
        $(".badge-primary").removeClass("badge-light").removeClass("badge-primary").addClass("badge-light");
    });
});

function parseStaff (staffRawStr) {

    var re = /\s*([A-Za-z1-9]+)\s*\,?\s*/g;
    // var staffRawStr = "Hung1, Hung2, Hung3, Hung4, Hung5, Hung6, Hung7, Hung8, Hung9, Hung10, Hung11, Hung12, Hung13, Hung14, Hung15, Hung16, Hung17, Hung18, Hung19";
    var result;

    var staffList = [];

    do {
        result = re.exec(staffRawStr);
        if (result) {
            staffList.push(result[1]);
            console.log(result[1]);
        }
    } while (result);

    return staffList;
}