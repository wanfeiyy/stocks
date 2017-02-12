<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/11
 * Time: 14:07
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Libraries\ImageUpload;

class FileController extends Controller
{

    public function index(Request $request)
    {
        if (! $request->hasFile('file') || ! $request->file('file')->isValid()) {
            return response()->json(['code'=>2000,'error'=>'验证失败！']);
        }
        $file = $request->file('file');
        $result = ImageUpload::upload($file,[100,100]);
        return response()->json($result);
    }



}