<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

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

        if ($offer)
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
}
