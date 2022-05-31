<?php

namespace Semrush\HomeTest\Support;

class HelperTool
{
    public static function failed($message){
        if (!$message)
            $message = 'Something went wrong';

        return (object)[
            'status' => false,
            'code' => 400,
            'message'  => $message
        ];
    }

    public static function success($message = null, $data = []){
        if (!$message)
            $message = 'Success';

        return (object)[
            'status' => true,
            'code' => 400,
            'message'  => $message
        ];
    }

    public static function logger($errorMessage){
        $log = self::getLogMessage($errorMessage);

        file_put_contents('logs.txt', $log . PHP_EOL, FILE_APPEND | LOCK_EX);

        return true;
    }

    public static function getLogMessage($errorMessage){
        return 'timeStamp: ' . date('Y-m-d H:i:s') . ' error: ' . $errorMessage;
    }
}
