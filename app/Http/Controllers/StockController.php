<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Store;
use App\Stock;

class StockController extends Controller
{
    private $_stock;

    private $_store;

    public function __construct(Stock $stock,Store $store)
    {
        $this->_stock = $stock;
        $this->_store = $store;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $this->_stock->getPage($request->all());
        $stores = $this->_store->getAll();
        list($goods,$search) = $data;
        return view('stock.list',['goods'=>$goods,'stores'=>$stores,'search'=>$search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->_store->getAll();
        return view('stock.index',['stores'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->_stock->Validate($data);
        if ($validator->fails()) {
            return redirect('stock/create') ->withErrors($validator) ->withInput();
        }
        $result = $this->_stock->add($data);
        if ($result) {
            return redirect('stock/create')->with('status', '保存商品成功!');
        } else {
            return redirect('stock/create')->withErrors(['保存失败']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $stores = $this->_store->getAll();
        $datas = $this->_stock->getById($id);
        return view('stock.edit',['stores'=>$stores,'datas'=>$datas,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();
        $validator = $this->_stock->Validate($data);
        if ($validator->fails()) {
            return redirect('stock/'.$id.'/edit') ->withErrors($validator) ->withInput();
        }
        $result = $this->_stock->editById($data);
        if ($result) {
            return redirect('stock/'.$id.'/edit')->with('status', '修改成功!');;
        } else {
            return redirect('stock/'.$id.'/edit')->withErrors(['保存失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->_stock->del($id)) {
            return response()->json(['code'=>0000,'message'=>'']);
        }
        return response()->json(['code'=>1000,'error'=>'删除失败']);
    }
}
