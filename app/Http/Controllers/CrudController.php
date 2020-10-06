<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    public function getOffers()
    {
        return Offer::select('id', 'name')->get(); //get only sep field

    }

    public function store(Request $request)
    {
        $rules = $this->rules();
        $messages = $this->getMessages();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);
        return redirect()->back()->with(['success' => 'تم أضافة العرض بنجاح']);

    }


    protected function rules()
    {
        return
            [
                'name' => 'required|max:100|unique:offers,name',
                'price' => 'required|numeric',
                'details' => 'required',
            ];
    }

    protected function getMessages()
    {

        return  [
            'name.required' => __('messages.offer name'),
            'price.required' => __('messages.offer price'),
            'name.unique' => __('messages.offer name unique'),
            'price.numeric' => 'Price must be number.',
            'details.required' => 'التفاصيل مطلوبة',
        ];
    }


    public function create()
    {

        return view('offers.create');
    }
}
