@extends('layouts.backend')
@push('css')
@endpush

@section('content')
  

<div class="body-content">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 fw-bold mb-0">Checkout</h6>
                        </div>
                        <div class="text-end">
                            <a href="{{route('checkouts.index')}}" class="btn btn-success"><i class="typcn typcn-th-list me-1"></i>Checkout List</a>
                        </div>
                    </div>
                </div>


                <div class="card-body">

                    <form action="{{route('checkouts.store')}}" method="POST" enctype="multipart/form-data" class="ajaxForm needs-validation" id="ajaxForm" novalidate="" data="showCallBackData" accept-charset="UTF-8">
                   
                        @csrf
                    <div class="row">
                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->





<script>

var showCallBackData = function() {
        $('#id').val('');
        $('.ajaxForm')[0].reset();
        $('#myModal').modal('hide');
        //$('#example').DataTable().ajax.reload(null, false);
        //$("#assignList").load(" #assignList > *");
    }

        
    $('body').on('change', '#client_id', function(e) {
        var user_id = $('#user_id').val();
        var client_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{route('getUserProductList')}}",
            data: {"_token": "{{ csrf_token() }}","client_id":client_id,'user_id':user_id},
            dataType: 'JSON',
            success: function(res) {
                console.log(res.message);
                $('#productlist').html(res.message);
            },
            error: function() {
            }
        });
    });


    function checkCaseStock(id){
        var caseStock = parseInt($('#caseStock_'+id).parent().prev().prev().children().val());
        var check = parseInt($('#caseStock_'+id).val());
        if(check>caseStock){
            alert('You cannot checkout more then stock qty ');
            $('#caseStock_'+id).val(caseStock);
        }
    }


    function checkUnitStock(id){
        var unitStock = parseInt($('#uniteStock_'+id).parent().prev().prev().children().val());
        var check = parseInt($('#uniteStock_'+id).val());
        if(check>unitStock){
            alert('You cannot checkout more then stock qty ');
            $('#uniteStock_'+id).val(unitStock);
        }   
    }


</script>




@endsection

@push('js')
@endpush
