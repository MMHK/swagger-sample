<?php
/**
 * Created by PhpStorm.
 * User: mixmedia
 * Date: 2019/10/21
 * Time: 13:35
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SwaggerController extends Controller
{

    public function ui() {
        return view('swagger.ui');
    }

    public function json(Request $request) {
        define('SWAGGER_API_URI', url('api'));

        return \OpenApi\scan(app_path('Http/Controllers/Api'))->toJson();
    }
}