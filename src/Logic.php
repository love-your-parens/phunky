<?php

namespace Phunky;

final class Logic
{
    static function not($x)
    {
        return !$x;
    }

    static function or(...$args)
    {
        foreach ($args as $arg) {
            if ($arg) {
                return true;
            }
        }

        return false;
    }

    static function xor($a, $b)
    {
        return $a xor $b;
    }

    static function and(...$args)
    {
        foreach ($args as $arg) {
            if (!$arg) {
                return false;
            }
        }

        return true;
    }
}
