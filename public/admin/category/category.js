function openAddCategoryModal() {
    setTimeout(function () {
        $('#addCategoryModal').modal('show');
    }, 230);

}
$(document).ready(function (){
    $('#form_add').on('submit', function (e){
       // e.preventDefault();
       var formurl = $(this).attr('action');
       var type = $(this).attr('method');
       var formData = new FormData(this);
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $.ajax({
           url: formurl,
           type: type,
           data: formData,
           cache: false,
           contentType: false,
           processData: false,
           success: function (data){
               $('#table tr:last').after('<tr> <td>'+title+'</td> <td>'+description+'</td> <td>'+color+'</td> <td>'+'ahihi'+'</td>')
               // return swal({
               //     title: "Good job!",
               //     text: "You clicked the button!",
               //     timer: 3000,
               //     icon: "success",
               // });
               $.growl({
                   title: "Growl",
                   message: "errits already released in SU or Submitted for SU!"
               });
           },
           error: function(){
               console.log(data);
           },
       });
    });
    $('#add_submit').on('click', function(){
        $('#form_add').submit();
    });

    $('#search').on('keyup', function (e){
        var value = ($(this).val()).trim();
        if(value == ''){
            $('#table_cate').show();
            $('#ajax').hide();
        }
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(value) {
            $.ajax({
                type: 'get',
                url: "admin/category/search",
                data: {
                    search: value,
                },

                success: function (data) {
                    $('#table_cate').hide();
                    $('#ajax').show();
                    $('#ajax').html(data);
                },
                error: function () {
                    console.log("error");
                    $('#table_cate').show();
                },
            });
        }

    });
    // $.ajaxSetup({header:{'csrftoken':'{{csrf_token()}}'}});
});

    function testGrowl(){
    // $.bootstrapGrowl("Successfully",{
    //     type: "success",
    //     align: 'right',
    //     width: 'auto',
    //     timer: 3000,
    //     allow_dismiss: true,
    // });
        $.growl({
            title: "Successfully",
            message: "Thêm mới thành công"
        });
}
