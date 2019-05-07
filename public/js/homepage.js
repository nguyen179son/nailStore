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
    // var today = new Date();
    // if(Date.parse('04/21/2019 23:59:59') >= today)
    // {
    //     $('#discount-modal').modal();
    // }

    $('body').on('click', '#send-complaint', function () {
        var content = $('#complaint-content').val();
        var name = $('#name').val();
        var email = $('#email').val();
        console.log("content: "+ content);
        $.ajax({
            type: "post",
            url: '/send-complaint',
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                content: content,
                name: name,
                email: email,
            },

            beforeSend: function() {
                $('#close-btn').prop('disabled', true);
                $('#send-complaint').prop('disabled', true);
            },

            success:function(data)
            {
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
                    $('#close-btn').prop('disabled', false);
                    $('#send-complaint').prop('disabled', false);
                    if (data.success === true) {
                        $('#complaint-modal').modal('hide');
                        $('#complaint-content').val("");
                        $('#email').val("");
                        $('#name').val("");
                    }
                }, 1500);
            },

            error:function(e) {
                $('#close-btn').prop('disabled', false);
                $('#send-complaint').prop('disabled', false);
            }
        });
    });

    fetchBanners();
    fetchPopups();

    sendRequestToUpdateEmail();
});

function fetchBanners() {
    $.ajax({
        type: "get",
        url: '/links/banners',
        success: function(data)
        {
            var index = 1;
            data.forEach((value) => {
                var url = value.url;

                // console.log(url);
                if (url !== "") {
                    $('#banners-carousel-indicators').append(`<li data-target=\"#slides\" data-slide-to=\"${index+1}\"></li>`);
                    $('#banners-carousel-inner').append(`<div class=\"carousel-item\"> <img src=\"${url}\"> </div>`);

                    index += 1;
                }
            });

            $('#slides').carousel({
                interval: 2500
            });
        },

        error:function(e) {
            console.log(`Error ${e}`);
        }
    });
}

function fetchPopups() {
    $.ajax({
        type: "get",
        url: '/links/popups',
        success: function(data)
        {
            var index = 0;
            var shouldShow = false;

            data.forEach((value) => {
                var url = value.url;

                // console.log(value.url);

                if (url !== "") {
                    $('#popups-carousel-indicators').append(`<li data-target=\"#popups-slides\" data-slide-to=\"${index}\" ${index === 0 ? "class=\"active\"" : ""}></li>`);
                    $('#popups-carousel-inner').append(`<div class=\"carousel-item ${index === 0 ? "active" : " "}\"> <img src=\"${url}\"> </div>`);

                    shouldShow = true;
                    index += 1;
                }
            });

            if(shouldShow) {
                $('#discount-modal').modal();
                $('#popups-slides').carousel({
                    interval: 1000
                });
            }
        },

        error:function(e) {
            console.log(`Error ${e}`);
        }
    });
}

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



