<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{

    use OfferTrait;

    public function create()
    {
        return view('Ajaxoffers.create');
    }

    public function store(OfferRequest $request)
    {
        //Save data into db using ajax

        $file_name = $this->saveImages($request->photo, 'images/offers');

        $offer =  Offer::create([
            'photo' => $file_name,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        if ($offer) // true
            return response()->json([
                'status' => true,
                'message' => 'تم إضافة العرض بنجاح',
            ]);
        else
            return response()->json([
                'status' => false,
                'message' => 'فشل في عملية الحفظ ',
            ]);
    }


    public function getOfferByAjax()
    {
        $offers = Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        )->get();

        return view('Ajaxoffers.index')->with(['offers' => $offers]);
    }


    public function edit(Request $request)
    {
        $offer = Offer::find($request->offer_id);

        if (!$offer) {
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);
        }

        $offer = Offer::select(
            'id',
            'name_en',
            'name_ar',
            'price',
            'details_ar',
            'details_en',
        )->find($request->offer_id);

        return  view('Ajaxoffers.edit')->with(['offer' => $offer]);
    }


    public function update(Request $request)
    {
        $offer = Offer::find($request->offer_id);

        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);

        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'تم تحديث العرض بنجاح',
        ]);
    }


    public function delete(Request $request)
    {
        // return $request;
        $offer = Offer::find($request->id); //Offer::where('id,'offer_id')->first();

        if (!$offer) {
            return response()->json();
        }

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request->id
        ]);
    }
}
