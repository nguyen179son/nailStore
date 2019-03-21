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

    $('body').on('click', '#send-complaint', function () {
        var content = $('#complaint-content').val();
        console.log("content: "+ content);
        $.ajax({
            type: "post",
            url: '/send-complaint',
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                content: content
            },

            success:function(data)
            {
                console.log(data);
                if (data.success === true) {
                    $('#message').removeClass("text-danger");
                    $('#message').addClass("text-success");
                } else {
                    $('#message').removeClass("text-success");
                    $('#message').addClass("text-danger");
                }
                $('#message').text(data.message);
                $('#message').removeAttr('hidden');
                setTimeout(function () {
                    $('#message').text("");
                    $('#message').attr("hidden", "hidden");
                    if (data.success === true) {
                        $('#complaint-modal').modal('hide');
                    }
                }, 1500);
            },

            error:function(e) {

            }
        });
    });
});