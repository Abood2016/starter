@extends('layouts.app')

@section('content')

<div class="alert alert-success text-center" id="success_msg" style="display: none;">
    تم حذف العرض بنجاح
</div>

@if(Session::has('success'))
<div class="alert alert-success">
    <div>
        {{Session::get('success')}}
    </div>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">
    <div>
        {{Session::get('error')}}
    </div>
</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.offerName')}}</th>
            <th scope="col">{{ __('messages.offer price') }}</th>
            <th scope="col">Offer Details</th>
            <th scope="col">صورة العرض</th>
            <th scope="col">{{ __('messages.Operations') }}</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($offers as $offer)
        <tr class="offerRow{{$offer -> id}}">

            <th scope="row">{{ $offer->id }}</th>
            <td>{{ $offer->name }}</td>
            <td>{{ $offer->price }}</td>
            <td>{{ $offer->details }}</td>
            <td><img src="{{url('images/offers/'. $offer->photo)}}"
                    style="width: 125px;height: 100px;border-radius: 30px;"></td>
            <td><a class="btn btn-primary" href="{{ route('offer.edit',['offer_id' => $offer->id]) }}">
                    {{__('messages.editBtn')}}
                </a>
                <a class="btn btn-danger" href="{{ route('offer.delete',['offer_id' => $offer->id]) }}">
                    {{__('messages.deleteBtn')}}
                </a>
                <a class="btn btn-danger delete_btn" offer_id="{{ $offer->id }}">
                    حذف اجاكس
                </a>
                <a class="btn btn-primary edit_btn" href="{{ route('offer-ajax.edit',['offer_id' => $offer->id]) }}">
                    تعديل أجاكس
                </a>
            </td>


        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('scripts')

<script>
    $(document).on('click', '.delete_btn' ,function(e) {
        e.preventDefault();


        var offer_id = $(this).attr('offer_id');

        $.ajax({
                type: 'post',
                url: "{{route('offer-ajax.delete')}}",
                data: {

                    '_token' : "{{ csrf_token() }}",
                    'id' : offer_id,
                },

                success: function (data) {
                    if (data.status == true) {
                       $('#success_msg').show();
                    }

                   $('.offerRow'+ data.id).remove();
                },
                error: function (data) {
                    
                },
            });
    });
</script>
@endsection