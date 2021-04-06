<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register the application's response macros.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($value = []) {
            return Response::json($value, 200);
        });

        Response::macro('failed', function (
            $errors,
            $additional = [],
            $errorCode = 401
        ) {
            if (!is_array($errors)) {
                if ($errors instanceof HttpException) {
                    return Response::json(
                        array_merge((array) $additional, [
                            'errors' => [$errors->getMessage()]
                        ]),
                        $errors->getStatusCode()
                    );
                }
                if ($errors instanceof \Throwable) {
                    return Response::json(
                        array_merge((array) $additional, [
                            'errors' => [$errors->getMessage()]
                        ]),
                        $errorCode
                    );
                }
            }

            return Response::json(
                array_merge(
                    (array) $additional,
                    empty($errors) ? [] : ['errors' => $errors]
                ),
                $errorCode
            );
            // dd($errors);
            // throw new \Exception('В failed пришли непонятные данные' . var_export($errors, true));
        });
    }
}
