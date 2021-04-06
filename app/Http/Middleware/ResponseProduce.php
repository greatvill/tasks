<?php

namespace App\Http\Middleware;
use App\Exceptions\ArrayErrorMessageException;
use App\Exceptions\HasArrayErrorMessage;
use App\Helpers\Memory;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as ResponseClass;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Closure;

class ResponseProduce
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * @param ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $result = $next($request);

        if (isset($result->exception)) {
            return $this->response->failed($result->exception);
        }

        return $this->response->success($result);
    }
}
