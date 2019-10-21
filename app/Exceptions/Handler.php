<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \App\Exceptions\ApiException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $debug = config('app.debug', false);

        /**
         * 如果是 api namespace ，错误使用json格式输出
         * todo 这里的错误状态码获取暂定
         */
        if ($request->ajax()) {
            $error = [
                'code' => $exception->getCode(),
                'msg' => $exception->getMessage(),
            ];
            $out = [
                'status' => 0,
            ];
            if ($debug) {
                $error['trace'] = $exception->getTraceAsString();
            }

            if ($exception instanceof NotFoundHttpException
                || $exception instanceof MethodNotAllowedHttpException) {
                $t['error']['msg'] = '404 not found';
            }

            if ($exception instanceof ValidationException) {
                $error['validate'] = $exception->validator->getMessageBag();
            }

            $out['error'] = $error;

            return response()->json($out)->withException($exception);
        }

        return parent::render($request, $exception);
    }
}
