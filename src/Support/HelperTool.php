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
        return 'timeStamp: ' . date('Y-m-d H:i:s') . ' error: ' . $errorMessage;
    }
}
