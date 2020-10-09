<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CrudController extends Controller
{

    use OfferTrait;

    public function getAllOffers()
    {

        $offers = Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        )->get();

        return view('offers.index')->with(['offers' => $offers]);
    }


    public function store(OfferRequest $request)
    {
        // $rules = $this->rules();
        // $messages = $this->getMessages();

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($request->all());
        // }


        // get image by func in offer trait file
        $file_name =  $this->saveImages($request->photo, 'images/offers');

        Offer::create([
            'photo' => $file_name,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم أضافة العرض بنجاح']);
    }


    // protected function saveImages($photo, $folder)
    // {
    //     //save image in folder
    //     $file_extension = $photo->getClientOriginalExtension();
    //     $file_name = time() . '.' . $file_extension;
    //     $path = $folder;
    //     $photo->move($path, $file_name);

    //     return $file_name;
    // }


    public function editOffer($offer_id)
    {
        $offer = Offer::find($offer_id);

        if (!$offer) {
            return redirect()->back()->with(['error' => 'حدث خطآ ما']);
        }

        $offer = Offer::select(
            'id',
            'name_en',
            'name_ar',
            'price',
            'details_ar',
            'details_en',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
        )
            ->find($offer_id);
        return view('offers.edit')->with(['offer' => $offer]);
    }


    public function updateOffer(OfferRequest $request, $offer_id)
    {
        $offer = Offer::find($offer_id);

        if (!$offer) {
            return redirect()->back()->with(['error' => 'حدث خطآ ما']);;
        }

        $offer->update($request->all());

        return redirect()->back()->with(['success' => 'تم تعديل العرض بنجاح']);
    }


    // protected function rules()
    // {
    //     return
    //         [
    //             'name' => 'required|max:100|unique:offers,name',
    //             'price' => 'required|numeric',
    //             'details' => 'required',
    //         ];
    // }

    // protected function getMessages()
    // {

    //     return  [
    //         'name.required' => __('messages.offer name'),
    //         'price.required' => __('messages.offer price'),
    //         'name.unique' => __('messages.offer name unique'),
    //         'price.numeric' => 'Price must be number.',
    //         'details.required' => 'التفاصيل مطلوبة',
    //     ];
    // }


    public function create()
    {

        return view('offers.create');
    }
}
