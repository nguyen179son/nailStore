window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        $("#mainNav").removeClass("pv-15px").addClass("pv-5px");
    } else {
        $("#mainNav").removeClass("pv-5px").addClass("pv-15px");
    }
}

window.onload = function () {
    collapseMenu();
    $(".dropdown-item").click(collapseMenu);
};

function collapseMenu() {
    console.log("click");
    $("#navbarResponsive").removeClass("show");
}

$(document).ready(function () {
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