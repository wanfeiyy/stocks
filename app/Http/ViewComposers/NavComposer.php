<?php
/**
 * Created by PhpStorm.
 * User: sobey
 * Date: 2017/2/9
 * Time: 13:53
 */
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Config;

class NavComposer
{
    public function __construct()
    {
    }


    /**
     * 将数据绑定到视图。
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navs', Config::get('local.nav'));
    }
}