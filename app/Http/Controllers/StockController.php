<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Store;
use App\Stock;

class StockController extends Controller
{
    private $_stock;

    public function __construct(Stock $stock)
    {
        $this->_stock = $stock;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $store = new Store();
        $data = $this->_stock->getPage($request->all());
        $stores = $store->getAll();
        return view('stock.list',['goods'=>$data,'stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = new Store();
        $data = $store->getAll();
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
            return redirect('stock');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
