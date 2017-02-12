<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/12
 * Time: 20:16
 */
namespace App\Custom;


Trait WithOnly
{
    public function scopeWithOnly($query, $relation, Array $columns)
    {
        return $query->with([$relation => function ($query) use ($columns){
            $query->select(array_merge(['id'], $columns));
        }]);
    }
}
