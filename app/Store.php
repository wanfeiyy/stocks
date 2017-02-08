<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 22:38
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Store extends Model
{
    protected $fillable = ['store_name','store_address'];

    public function Validate($data)
    {
        $message = [
            'required' => ':attribute 的字段是必要的。',
            'max'=>'该 :attribute 不能超过 :max.长度',
        ];
        $validator = Validator::make($data, [
            'name' => 'required|max:25',
            'address' => 'required|max:255',
        ],$message);
        return $validator;
    }

    public function add($data)
    {
        $this->store_name = $data['name'];
        $this->store_address = $data['address'];
        return $this->save();
    }
}