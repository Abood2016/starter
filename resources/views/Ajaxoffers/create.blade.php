@extends('layouts.app')

@section('content')

<div class="container">

    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم إضافة العرض بنجاح
    </div>
    <div class="alert alert-danger" id="error_msg" style="display: none;">
        حدث خطآ ما
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.offer add title')}}
            </div>

            <form method="POST" id="offerForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="photo">إختر صورة</label>
                    <input type="file" name="photo" class="form-control">
                    <small id="photo_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="name_en">{{ __('messages.offer Name input en') }}</label>
                    <input type="text" name="name_en" class="form-control" aria-describedby="emailHelp">
                    <small id="name_en_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="name_ar">{{ __('messages.offer Name input ar') }}</label>
                    <input type="text" name="name_ar" class="form-control" aria-describedby="emailHelp">
                    <small id="name_ar_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Price</label>
                    <input type="text" name="price" class="form-control">
                    <small id="price_error" class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="details_en">{{ __('messages.offer details input en') }}</label>
                    <input type="text" name="details_en" class="form-control">
                    <small id="details_en_error" class="form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label for="details_ar">{{ __('messages.offer details input ar') }}</label>
                    <input type="text" name="details_ar" class="form-control">
                    <small id="details_ar_error" class="form-text text-danger"></small>
                </div>

                <button id="offer_save" class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>
</div>
@stop

@section('scripts')

<script>
    $(document).on('click', '#offer_save' ,function(e) {
        e.preventDefault();

            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_en_error').text('');
            $('#details_ar_error').text('');

        var formData = new FormData($('#offerForm')[0]);

        $.ajax({
                type: 'post',
                url: "{{route('offer-ajax.store')}}",
                enctype: 'multipart/form-data',
                data: 
                    formData,
                    // '_token' : "{{ csrf_token() }}",
                    // 'name_ar': $("input[name = 'name_ar']").val(),
                    // 'name_en': $("input[name = 'name_en']").val(),
                    // 'price':   $("input[name = 'price']").val(),
                    // 'details_en': $("input[name = 'details_en']").val(),
                processData: false,
                contentType: false,
                cache:  false,    

                success: function (data) {
                    if (data.status == true) {
                       $('#success_msg').show();
                      $("#offerForm").trigger("reset"); //to clear the form
                    }
                },
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#"  + key + "_error").text(val[0]); //# معناها اختار لي اسم الايررور
                    });
                }
            });
              
    });
</script>
@endsection