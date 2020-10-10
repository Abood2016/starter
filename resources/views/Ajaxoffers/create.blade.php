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
                    @error('photo')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name_en">{{ __('messages.offer Name input en') }}</label>
                    <input type="text" name="name_en" class="form-control" aria-describedby="emailHelp">
                    @error('name_en')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name_ar">{{ __('messages.offer Name input ar') }}</label>
                    <input type="text" name="name_ar" class="form-control" aria-describedby="emailHelp">
                    @error('name_ar')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Offer Price</label>
                    <input type="text" name="price" class="form-control">
                    @error('price')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="details_en">{{ __('messages.offer details input en') }}</label>
                    <input type="text" name="details_en" class="form-control">
                    @error('details_en')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="details_ar">{{ __('messages.offer details input ar') }}</label>
                    <input type="text" name="details_ar" class="form-control">
                    @error('details_ar')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
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
                    }
                },
                error: function (data) {
                    
                },
            });
    });
</script>
@endsection