<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Store;

class StoreController extends Controller
{
    private $_store;

    public function __construct(Store $store)
    {
        $this->_store = $store;
    }

    public function index()
    {
        return view('store.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->_store->Validate($data);
        if ($validator->fails()) {
            return redirect('store') ->withErrors($validator) ->withInput();
        }
        $result = $this->_store->add($data);
        if ($result) {
            return redirect('store/list');
        } else {
            return redirect('store')->withErrors(['保存失败']);
        }
    }

    public function listStore(Request $request)
    {
        $limit = $request->input('limit',8);
        $stores = $this->_store->getStore($limit);
        return view('store.list',['stores'=>$stores]);
    }

    public function destroy($id)
    {
        if ($this->_store->del($id)) {
            return response()->json(['code'=>0000,'message'=>'']);
        }
        return response()->json(['code'=>1000,'error'=>'删除失败']);
    }

}
