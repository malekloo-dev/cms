<?php

namespace App\Exceptions;

use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * کنترل خطاهایی که از نوع بررسی ولیدیشن هستند
     *
     * @param $request
     * @param Exception $exception
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function renderValidationException($request, Exception $exception)
    {
        return response([
            'errors' => $exception->errors()
        ], 422);
    }


    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    private function renderAuthenticateException(\Illuminate\Http\Request $request, $exception)
    {
        return response([
            'errors' => 'شما به این api دسترسی ندارید'
        ], 401);
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

        if ($request->wantsJson()) {

            if ($exception instanceof ValidationException) {

                return $this->renderValidationException($request, $exception);
            }

            if ($exception instanceof AuthenticationException) {

                return $this->renderAuthenticateException($request, $exception);
            }

            if ($exception instanceof NotFoundHttpException ) {

                return response([
                    'errors' => 'Not Found'
                ], 404);

            }

            return $this->renderOtherExceptions($request, $exception);
        }
        return parent::render($request, $exception);


    }

    /**
     * ایجاد جیسان برای سایر خطا ها
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function renderOtherExceptions(Request $request, Exception $exception)
    {
        dd($exception);
        $exception = $this->prepareException($exception);
        $code = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        $message = 'خطایی در سرور رخ داده است';

        if (!($code == 500 || empty($exception->getMessage()))) {
            $message = $exception->getMessage();
        }
        return response([
            'message' => $message
        ], $code);
    }


}
