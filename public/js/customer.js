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
                data: {
                    status: window.data,
                    service_type: window.service_type,
                    day: $('#date').val()
                },
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

    $('body').on('click', '#submit-add-customer', function(e) {
        $('#form-add-customer').submit();
        e.preventDefault();
    });
});

