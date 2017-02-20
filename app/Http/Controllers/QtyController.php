<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Store;
use App\Stock;

class QtyController extends Controller
{
    private $_store;

    private $_stock;

    public function __construct(Store $store,Stock $stock)
    {
        $this->_store = $store;
        $this->_stock = $stock;
    }

    public function getStock($id)
    {
        if (! $id) {
            return redirect('/stock')->withErrors(['参数有误！']);
        }
        $data = $this->_stock->getPage(['id'=>$id]);
        list($result,$where) = $data;
        if (count($result->toArray()['data'])) {
            return view('qty.index',['goods'=>$result[0]]);
        } else {
            return redirect('/stock')->withErrors(['参数有误,未找到相关数据！']);
        }
    }

    public function postStock(Request $request)
    {
        if (! $request->has('id')) {
            return redirect('/stock')->withErrors(['参数有误,未找到相关数据！']);
        }
        $id = $request->input('id');
        if ($this->_stock->incrementQty($id,$request->input('qty'))) {
            return redirect('qty/stock/'.$id)->with(['status'=>'出库成功']);
        } else {
            return redirect('qty/stock/'.$id)->withErrors(['出库失败！']);
        }
    }
}
