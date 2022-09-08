<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param $request
     * @param Throwable $e
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if($e instanceof ModelNotFoundException)
        {
            return response(['message' => "No query results for model {$e->getModel()} {$request->route()->client}"
        ],404);
        }
        return parent::render($request, $e);
    }
    // private function prettyModelNotFound(Throwable $exception)
    // {
    //     try {
    //         return Str::lower(
    //             ltrim(
    //                 preg_replace(
    //                     '/[A-Z]/',
    //                     ' LARACASTS_SNIPPET_PLACEHOLDER',
    //                     (new ReflectionClass($exception->getModel()))->getShortName()
    //                 )
    //             )
    //         );
    //     } catch (ReflectionException $e) {
    //         report($e);
    //     }
    //     return 'resource';
    // }
}
