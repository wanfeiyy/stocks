<?php
/**
 * Created by PhpStorm.
 * User: sobey
 * Date: 2017/2/9
 * Time: 13:50
 */
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 使用对象型态的视图组件...
        View::composer(
            'layouts.header', 'App\Http\ViewComposers\NavComposer'
        );
    }

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function register()
    {
        //
    }

}