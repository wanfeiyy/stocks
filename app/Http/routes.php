<?php
use App\UserMessage;
use Sunra\PhpSimple\HtmlDomParser;
use App\Pymt;
use App\Libraries\BaiduGeocoding;
use EasyWeChat\Message\News;
use App\Test;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

});



Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('store/list','StoreController@listStore');
Route::resource('store', 'StoreController');

Route::resource('stock','StockController');

Route::post('file','FileController@index');

Route::group(['prefix'=>'api','namespace'=>'Api','middleware'=>['selectDB','compatible','sign']],function(){

});
