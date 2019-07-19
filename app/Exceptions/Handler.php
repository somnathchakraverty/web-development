<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Jenssegers\Agent\Agent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        try{
            if ((method_exists($exception, "getStatusCode") && $exception->getStatusCode() != 404)) {
                $logger = $this->container->make(LoggerInterface::class);
                $logger->error('Error information : ', [
                    request()->method(),
                    request()->url(),
                    request()->all(),
                    "file:: " . $exception->getFile(),
                    "line:: " . $exception->getLine(),
                    "User Agent :: " . (new Agent())->getUserAgent(),
                    app('Illuminate\Routing\UrlGenerator')->previous(),
                    "Error: " . $exception->getMessage(),
                    "Device:: " . ((isMobile()) ? "Mobile" : "Desktop"),
                    "ip:: ".request()->ip(),
                    "trace:: " . $exception->getTraceAsString() ,
                    "host::".gethostname()                   
                ]);
            }
        }
        catch (\Exception $exception)
        {
            $error_object = [
                'status' => $exception->getCode(),
                'error' => $exception->getMessage(),
                'file_name' => $exception->getFile(),
                'line' => $exception->getLine(),
                "ip:: ".request()->ip(),
                'trace' => $exception->getTraceAsString(),
                "host::".gethostname()
            ];
            // Send Log to SLACK
            \Log::error($error_object);
        }

        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }
        
        if ($exception instanceof TokenMismatchException) {
            return redirect()->back()->withInput(request()->except('password'))->withErrors(['Validation Token was expired. Please try again']);
        }

        if( $exception instanceof MethodNotAllowedException )
        {
            return redirect()->back();
        }

        if( $exception instanceof MethodNotAllowedException )
        {
            return redirect()->back();
        }

        return redirect()->route('404-error',[], 301);
        // You can add your own exception here
        // so redirect to the home route
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
    
                // not authorized
                case '403':
                    return redirect()->route('404-error',[], 301);
    
                // not found
                case '404':
                    return redirect()->route('404-error',[], 301);
    
                // not found
                case '405':
                    return redirect()->route('404-error',[], 301);
                    
                // internal error
                case '500':
                    return redirect()->route('404-error',[], 301);
                    
                default:
                    return $this->renderHttpException($e);
            }
        } 
        else {
            return parent::render($request, $e);
        }
    }
    
    protected function getExceptionTraceAsString($exception) {
        $rtn = "";
        $count = 0;
        foreach ($exception->getTrace() as $frame) {
            $args = "";
            if (isset($frame['args'])) {
                $args = array();
                foreach ($frame['args'] as $arg) {
                    if (is_string($arg)) {
                        $args[] = "'" . $arg . "'";
                    } elseif (is_array($arg)) {
                        $args[] = "Array";
                    } elseif (is_null($arg)) {
                        $args[] = 'NULL';
                    } elseif (is_bool($arg)) {
                        $args[] = ($arg) ? "true" : "false";
                    } elseif (is_object($arg)) {
                        $args[] = get_class($arg);
                    } elseif (is_resource($arg)) {
                        $args[] = get_resource_type($arg);
                    } else {
                        $args[] = $arg;
                    }   
                }   
                $args = join(", ", $args);
            }
            $rtn .= sprintf( "#%s %s(%s): %s(%s)\n",
                                     $count,
                                     $frame['file'],
                                     $frame['line'],
                                     $frame['function'],
                                     $args );
            $count++;
        }
        return $rtn;
    }
}
