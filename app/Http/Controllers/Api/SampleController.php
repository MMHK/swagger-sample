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
     * @SWG\Get(
     *   path="/now",
     *   summary="一般Get",
     *   produces={"application/json"},
     *   @SWG\Response(
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
     * @SWG\Get(
     *   path="/query",
     *   summary="带query",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="params",
     *       in="query",
     *       description="必选参数",
     *       type="string",
     *       required=true,
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function query(Request $request) {
        return $request->input();
    }

    /**
     * @SWG\Get(
     *   path="/path/{key}/{value}",
     *   summary="路径参数",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="key",
     *       in="path",
     *       description="必选参数",
     *       required=true,
     *       type="string",
     *   ),
     *   @SWG\Parameter(
     *       name="value",
     *       in="path",
     *       description="必选参数",
     *       required=true,
     *       type="string",
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function path(Request $request) {
        return $request->route()->parameters();
    }

    /**
     * @SWG\Get(
     *   path="/header",
     *   summary="HTTP 头部参数",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="auth-token",
     *       in="header",
     *       description="必选参数",
     *       required=true,
     *       type="string",
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function header(Request $request) {
        return $request->headers->all();
    }

    /**
     * @SWG\Get(
     *   path="/array",
     *   summary="数组",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *       name="params",
     *       in="query",
     *       description="必选参数",
     *       required=true,
     *       type="array",
     *       @SWG\Items(type="string"),
     *       collectionFormat="csv",
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function Array(Request $request) {
        return $request->input();
    }

    /**
     * @SWG\Post(
     *   path="/post",
     *   summary="数组",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *          name="param1",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="参数1",
     *   ),
     *   @SWG\Parameter(
     *          name="param2",
     *          in="formData",
     *          required=true,
     *          type="string",
     *          description="参数2",
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function post(Request $request) {
        return $request->input();
    }

    /**
     * @SWG\Post(
     *   path="/file",
     *   summary="数组",
     *   consumes={"multipart/form-data"},
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *        name="file",
     *        in="formData",
     *        required=true,
     *        type="file",
     *        description="文件",
     *   ),
     *   @SWG\Parameter(
     *        name="param1",
     *        in="formData",
     *        required=true,
     *        type="string",
     *        description="参数1",
     *   ),
     *   @SWG\Response(
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
     * @SWG\Post(
     *   path="/json/post",
     *   summary="复杂嵌套JSON POST",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *   @SWG\Parameter(
     *       name="body",
     *       in="body",
     *       required=true,
     *       @SWG\Schema(
     *           type="object",
     *           @SWG\Property(
     *               property="param1",
     *               description="参数1",
     *               type="string",
     *           ),
     *           @SWG\Property(
     *               property="param2",
     *               description="参数2",
     *               type="string",
     *           ),
     *           @SWG\Property(
     *               property="param3",
     *               description="参数3",
     *               type="array",
     *               @SWG\Items(type="number"),
     *           ),
     *           @SWG\Property(
     *               property="param4",
     *               description="参数4",
     *               type="object",
     *               @SWG\Property(
     *                   property="arg1",
     *                   description="参数4 - 参数1",
     *                   type="string",
     *               ),
     *               @SWG\Property(
     *                   property="arg2",
     *                   description="参数4 - 参数2",
     *                   type="string",
     *               ),
     *               required={"arg1", "arg2"},
     *           ),
     *           required={"param1", "param2", "param3", "param4"},
     *       )
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="正常返回"
     *   ),
     * )
     */
    public function jsonPost(Request $request) {
        return $request->input();
    }
}