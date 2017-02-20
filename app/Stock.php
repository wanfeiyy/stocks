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
use DB;
use App\Custom\WithOnly;

class Stock extends Model
{
    use WithOnly;

    protected $fillable = ['name','sku','price','color','image','thumb','store_id','qty'];

    protected $hidden = ['updated_at'];

    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    
    public function add($data)
    {
        return $this->create($data);
    }

    public function getById($id)
    {
        return $this->findOrFail($id);
    }

    public function del($id)
    {
        return $this->destroy($id);
    }

    public function editById($data)
    {
        $store = $this->find($data['id']);
        $store->name = $data['name'];
        $store->sku = $data['sku'];
        $store->price = $data['price'];
        $store->store_id = $data['store_id'];
        $store->color = $data['color'];
        $store->qty = $data['qty'];
        isset($data['thumb']) && $data['thumb'] && $store->thumb = $data['thumb'];
        isset($data['image']) && $data['image'] && $store->thumb = $data['image'];
        return $store->save();
    }


    public function getPage($wheres)
    {
        $where = [];
        isset($wheres['sku']) && $wheres['sku'] && $where['sku'] = $wheres['sku'];
        isset($wheres['color']) && $wheres['color'] && $where['color'] = $wheres['color'];
        isset($wheres['store_id']) && $wheres['store_id'] && $where['store_id'] = $wheres['store_id'];
        $list = $this->withOnly('store',['store_name'])->where($where)->OrderBy('created_at','desc')->paginate(6);
        $list->appends($where);
        return [$list,$where];
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