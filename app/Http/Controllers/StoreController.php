<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Store;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index');
    }

    public function store(Request $request)
    {
        $store = new Store();
        $data = $request->all();
        $validator = $store->Validate($data);
        if ($validator->fails()) {
            return redirect('store') ->withErrors($validator) ->withInput();
        }
        $result = $store->add($data);
        if ($result) {
            return redirect('store/list');
        } else {
            return redirect('store')->withErrors(['保存失败']);
        }
    }


}
