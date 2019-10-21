<?php
/**
 * Created by PhpStorm.
 * User: mixmedia
 * Date: 2019/10/21
 * Time: 13:36
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SampleController extends Controller
{

    /**
     * @OA\Get(
     *   path="/now",
     *   summary="一般Get",
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function now() {
        return [
            'time' => Carbon::now(),
        ];
    }

    /**
     * @OA\Get(
     *   path="/query",
     *   summary="带query",
     *   @OA\Parameter(
     *       name="params",
     *       in="query",
     *       description="必选参数",
     *       required=true,
     *       @OA\Schema(
     *         type="string",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function query(Request $request) {
        return $request->input();
    }

    /**
     * @OA\Get(
     *   path="/path/{key}/{value}",
     *   summary="路径参数",
     *   @OA\Parameter(
     *       name="key",
     *       in="path",
     *       description="必选参数",
     *       required=true,
     *       @OA\Schema(
     *         type="string",
     *       ),
     *   ),
     *   @OA\Parameter(
     *       name="value",
     *       in="path",
     *       description="必选参数",
     *       required=true,
     *       @OA\Schema(
     *         type="string",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function path(Request $request) {
        return $request->route()->parameters();
    }

    /**
     * @OA\Get(
     *   path="/header",
     *   summary="HTTP 头部参数",
     *   @OA\Parameter(
     *       name="auth-token",
     *       in="header",
     *       description="必选参数",
     *       required=true,
     *       @OA\Schema(
     *         type="string",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function header(Request $request) {
        return $request->headers->all();
    }

    /**
     * @OA\Get(
     *   path="/array",
     *   summary="数组",
     *   @OA\Parameter(
     *       name="params",
     *       in="query",
     *       description="必选参数",
     *       required=true,
     *       @OA\Schema(
     *          type="array",
     *         @OA\Items(type="string"),
     *       ),
     *       style="deepObject",
     *       explode=true,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function Array(Request $request) {
        return $request->input();
    }

    /**
     * @OA\Post(
     *   path="/post",
     *   summary="数组",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="param1",
     *                   description="参数1",
     *                   type="string",
     *               ),
     *               @OA\Property(
     *                   property="param2",
     *                   description="参数2",
     *                   type="string",
     *               ),
     *               required={"param1", "param2"},
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function post(Request $request) {
        return $request->input();
    }

    /**
     * @OA\Post(
     *   path="/file",
     *   summary="数组",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="file",
     *                   description="文件",
     *                   type="string",
     *                   format="binary",
     *               ),
     *               @OA\Property(
     *                   property="param1",
     *                   description="参数1",
     *                   type="string",
     *               ),
     *               required={"file", "param1"},
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function file(Request $request) {
        return [
            'params' => $request->input(),
            'file' => $request->file('file')->getClientOriginalName()
        ];
    }

    /**
     * @OA\Post(
     *   path="/json/post",
     *   summary="复杂嵌套JSON POST",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="param1",
     *                   description="参数1",
     *                   type="string",
     *               ),
     *               @OA\Property(
     *                   property="param2",
     *                   description="参数2",
     *                   type="string",
     *               ),
     *               @OA\Property(
     *                   property="param3",
     *                   description="参数3",
     *                   type="array",
     *                   @OA\Items(type="number"),
     *               ),
     *               @OA\Property(
     *                   property="param4",
     *                   description="参数4",
     *                   type="object",
     *                   @OA\Property(
     *                       property="arg1",
     *                       description="参数4 - 参数1",
     *                       type="string",
     *                   ),
     *                   @OA\Property(
     *                       property="arg2",
     *                       description="参数4 - 参数2",
     *                       type="string",
     *                   ),
     *                   required={"arg1", "arg2"},
     *               ),
     *               required={"param1", "param2", "param3", "param4"},
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function jsonPost(Request $request) {
        return $request->input();
    }
}