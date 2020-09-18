$(document).ready(function () {

    $('#search_header').on('keyup', function (e){
        var value = ($(this).val()).trim();
        if(value == ''){
            // $('#table_cate').show();
            // $('#ajax').hide();
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(value) {
            $.ajax({
                type: 'post',
                url: "search-auto",
                data: {
                    search: value,
                },

                success: function (data) {
                    // $('#table_cate').hide();
                    // $('#ajax').show();
                    $('#show-list').html(data);
                },
                error: function () {
                    console.log("error");
                    // $('#table_cate').show();
                },
            });
        }

    });
});
