$(document).ready(function () {
    $(document).on('click', '.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    window.check=0;
    window.id=-1;
    function fetch_data(page) {
        if(window.check==0) {
            $.ajax({
                url: "/customer-management/show?page=" + page,
                success: function (data) {
                    $('#customer-table').html(data);
                }
            });
        } else {
            $.ajax({
                url: "member/"+window.id+'?page='+page,
                success: function (data) {
                    $('#history-member').html(data);
                }
            });
        }
    }
    $('body').on('hidden.bs.modal','#history-modal',function () {
        window.check=0;
    });
    $('body').on('click','.member-name',function () {
        window.check=1;
        window.id=$(this).attr("data-id");
        $.ajax({
            url: "member/"+$(this).attr("data-id")+'?page=1',
            success: function (data) {
                console.log(data);
                $('#history-member').html(data);
            }
        });
    });
    fetch_data(1);

    $('body').on("change", "#keyword", function () {
        console.log($('#keyword').val());
        $.ajax({
            url: "/customer-management/show?page=1",
            data: {
                keyword: $('#keyword').val()
            },
            success: function (data) {
                $('#customer-table').html(data);
            }
        });
    });

    $('body').on('click', '#submit-add-customer', function(e) {
        var email = $('#email-add-customer').val();
        var name = $('#name-add-customer').val();

        $.ajax({
            url: "/member",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data: {
                email: email,
                name: name,
            },


            success: function (data) {
                console.log(data);
                if (data.success) {
                    $('#email-add-customer').val("");
                    $('#name-add-customer').val("");

                    $("#alert-text").removeClass("text-danger text-success").addClass("text-success");
                    $("#alert-text").text(data.message);
                    $("#alert-text").show();

                    setTimeout(function() {
                        $("#alert-text").hide();
                        $("#add-customer-modal").modal("hide");

                    }, 1000);
                }
                else {
                    $("#alert-text").removeClass("text-danger text-success").addClass("text-danger");
                    $("#alert-text").text(data.message);
                    $("#alert-text").show();

                    setTimeout(function() {
                        $("#alert-text").hide();
                    }, 2000);

                }
            }
        });
    });
});

