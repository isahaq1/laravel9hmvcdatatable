$(function(){
    "use strict";
    $(document).on('click','.delete-confirm',function(){
       let url = $(this).data('route');
       let csrf = $(this).data('csrf');
       console.log(url);
       Swal.fire({
        title: 'Are you sure?',
        text: "You want to Delete Data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url:url,
                data: {
                    _token : csrf,
                    _method: 'DELETE'
                },
                success:function(data){
                    console.log(data);
                    location.reload();

                }
        });
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })


    });
 });
