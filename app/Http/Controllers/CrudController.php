<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CrudController extends Controller
{

    public function getOffers()
    {
        return Offer::select('id', 'name')->get(); //get only sep field

        
    }


    public function getAllOffers()
    {

       $offers = Offer::select('id','price',
       'name_'.LaravelLocalization::getCurrentLocale().' as name',
       'details_'.LaravelLocalization::getCurrentLocale(). ' as details')->get();
       
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

        Offer::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم أضافة العرض بنجاح']);

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
