<?php

namespace Phunky;

final class Functions
{
    static function composite(callable ...$fns)
    {
        return function(...$args) use ($fns) {
            foreach ($fns as $fn) {
                $args = $fn(...$args);
            }
            return $args;
        };
    }

    static function partial(callable $fn, ...$preset_args)
    {
        return function (...$args) use ($fn, $preset_args) {
            return $fn(...array_merge($preset_args, $args));
        };
    }

    static function not(callable $fn)
    {
        return function (...$args) use ($fn) {
            return !$fn(...$args);
        };
    }

    static function juxtaposition(callable ...$fns)
    {
        return function (...$args) use ($fns) {
            return array_map(
                function ($fn) use ($args) {
                    return $fn(...$args);
                }
                ,
                $fns
            );
        };
    }

    static function identity($x)
    {
        return $x;
    }
}
