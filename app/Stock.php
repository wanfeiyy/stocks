<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/11
 * Time: 13:38
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Stock extends Model
{
    protected $fillable = ['name','sku','price','color','image','thumb','store_id','qty'];

    public function Store()
    {
        return $this->belongsTo('App\Store');
    }
    
    public function add($data)
    {
        return $this->create($data);
    }


    public function Validate($data)
    {
        $message = [
            'required' => ':attribute 的字段是必要的。',
            'max'=>'该 :attribute 不能超过 :max.长度。',
            'numeric'=>'该 :attribute只能为数字',
            'integer'=>'该 :attribute只能为整数',
        ];
        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'sku'=> 'required',
            'price'=>'required|numeric',
            'store_id'=>'required|integer',
            'color'=>'required|max:10',
            'qty'=>'required|integer',
        ],$message);
        return $validator;
    }

}