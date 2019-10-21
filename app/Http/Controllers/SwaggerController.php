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
        $swagger = \Swagger\scan(base_path('app/Http/Controllers/Api'));

        $swagger->basePath = '/api/';
        $swagger->host = trim(str_replace(['http://', 'https://'], '', url('')), '/');

        return $swagger;
    }
}