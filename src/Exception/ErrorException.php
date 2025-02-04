<?php
namespace WhmcsSI\Exception;

use ErrorException as BaseErrorException;

class ErrorException extends BaseErrorException
{
    public function __construct($message = null, $code = 0, $previous = null)
    {
        include ROOTDIR . '/configuration.php';
        if (!empty($sentry_enable) && !empty($sentry_project_link)) {
            \Sentry\init([
                'dsn' => $sentry_project_link,
                'environment' => $project_environment ?? 'production',
                'traces_sample_rate' => 1.0,
              ]);
            \Sentry\captureException($this);  
        }
    }
}
