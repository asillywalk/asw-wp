<?php

namespace Sillynet\Utility;

class Debug
{
    public static function dump(mixed $var, ?string $msg = null): void
    {
        if ($msg) {
            error_log($msg);
        }
        ob_start();
        var_dump($var);
        $log = ob_get_clean();
        if (is_string($log)) {
            error_log($log);
        }
    }
}
