<?php
namespace App\Vetter\Helpers;

class DebugHelper
{
    public static function debug($message)
    {
        if(env('APP_ENV') != 'production')
        {
            if(isset($_SERVER['REMOTE_ADDR']))
            {
                echo '<pre>';
                print_r($message);
                echo '</pre>';
            }
            else
            {
                print_r($message);
                print_r("\n");
            }
        }
    }

    public static function firelog($message) {
        // Get an instance of Monolog
        $monolog = \Log::getMonolog();

        // Choose FirePHP as the log handler
        $monolog->pushHandler(new \Monolog\Handler\FirePHPHandler());

        if (is_array($message)) {
            $message = var_export($message, true);
        }
        $monolog->debug($message);
    }

}

