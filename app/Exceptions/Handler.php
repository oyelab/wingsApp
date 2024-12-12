<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\ForbiddenHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

	public function render($request, Throwable $exception)
	{
		// Handle specific HTTP exceptions
		if ($exception instanceof HttpException) {
			// 401 - Unauthorized
			if ($exception->getStatusCode() === 401) {
				return response()->view('errors.401', ['exception' => $exception], 401);
			}

			// 402 - Payment Required
			if ($exception->getStatusCode() === 402) {
				return response()->view('errors.402', ['exception' => $exception], 402);
			}

			// 403 - Forbidden (Handle 403 explicitly)
			if ($exception->getStatusCode() === 403) {
				return response()->view('errors.403', ['exception' => $exception], 403);
			}

			// 419 - Page Expired (Token Mismatch)
			if ($exception->getStatusCode() === 419) {
				return response()->view('errors.419', ['exception' => $exception], 419);
			}

			// 429 - Too Many Requests
			if ($exception->getStatusCode() === 429) {
				return response()->view('errors.429', ['exception' => $exception], 429);
			}

			// 500 - Internal Server Error
			if ($exception->getStatusCode() === 500) {
				return response()->view('errors.500', ['exception' => $exception], 500);
			}

			// 503 - Service Unavailable
			if ($exception->getStatusCode() === 503) {
				return response()->view('errors.503', ['exception' => $exception], 503);
			}
		}

		// Handle MethodNotAllowedHttpException separately for unsupported HTTP methods (e.g., GET to a POST route)
		if ($exception instanceof MethodNotAllowedHttpException) {
			// If the method is GET, show a Forbidden (403) error page
			if ($request->method() === 'GET') {
				return response()->view('errors.403', ['exception' => $exception], 403);
			}
		}

		// For other exceptions, continue with the default behavior
		return parent::render($request, $exception);
	}

}
