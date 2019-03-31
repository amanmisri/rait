<?php

namespace FleetCart\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->shouldRedirectToDashboard($e)) {
            return redirect()->route('admin.dashboard.index');
        }

        if ($this->shouldShowNotFoundPage($e)) {
            return response()->view('errors.404');
        }

        return parent::render($request, $e);
    }

    /**
     * Determine whether response should redirect to the dashboard.
     *
     * @param \Exception $e
     * @return bool
     */
    private function shouldRedirectToDashboard(Exception $e)
    {
        if (config('app.debug') || ! $this->container['inBackend']) {
            return false;
        }

        return $e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException;
    }

    /**
     * Determine if the response should show not found page.
     *
     * @param \Exception $e
     * @return bool
     */
    private function shouldShowNotFoundPage(Exception $e)
    {
        if ($this->container['inBackend']) {
            return false;
        }

        return $e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException;
    }
}
