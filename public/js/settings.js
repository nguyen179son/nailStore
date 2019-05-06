$(document).ready(function() {
    bindActionToLinkButtons();
    bindActionToStaffButtons();
    fetchLinks();
    fetchStaff();
});

function bindActionToLinkButtons() {
    ['change', 'delete'].forEach(action => {
        ['b', 'p'].forEach(type => {
            [1, 2, 3, 4, 5].forEach((index) => {
                $(`#${action}-${type}${index}`).on('click', function() {
                    $.ajax({
                        url: `/admin/settings/${action}`,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $("input[name=_token]").val()
                        },
                        data: {
                            type: `${type}${index}`,
                            url: $(`#${type}${index}`).val(),
                        },
                        success: function (data) {
                            $(`#${type}${index}`).val("");
                            console.log(`Success | ${type}${index}`);

                            if (data.url !== undefined) {
                                $(`#${type}${index}`).val(`${data.url}`);
                            }
                        },
                        error: function(e) {
                            console.log(`Error ${e}`);
                        }
                    });
                });
            });
        });
    });
}

function fetchLinks() {
    $.ajax({
        url: `/admin/settings/links`,
        type: 'GET',
        success: function (data) {
            data.forEach(pair => {
                $(`#${pair.type}`).val(`${pair.url}`);
            })
        },
        error: function(e) {
            console.log(`Error ${e}`);
        }
    });
}

function bindActionToStaffButtons() {
    ['change', 'delete'].forEach(action => {
        $(`#${action}-e`).on('click', function() {
            $.ajax({
                url: `/admin/employees/${action}`,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                },
                data: {
                    type: `e`,
                    url: $(`#e`).val(),
                },
                success: function (data) {
                    $(`#e`).val("");
                    console.log(`Success | e`);

                    if (data.url !== undefined) {
                        $(`#e`).val(`${data.url}`);
                    }
                },
                error: function(e) {
                    console.log(`Error ${e}`);
                }
            });
        });
    });
}

function fetchStaff() {
    $.ajax({
        url: `/admin/employees`,
        type: 'GET',
        success: function (data) {
            $("#e").val(data);
        },
        error: function(e) {
            console.log(`Error ${e}`);
        }
    });
}