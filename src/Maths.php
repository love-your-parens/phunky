<?php

namespace Phunky;

final class Maths
{

    public static function increment($a)
    {
        return $a + 1;
    }

    public static function decrement($a)
    {
        return $a - 1;
    }

    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function subtract($a, $b)
    {
        return $a - $b;
    }

    public static function multiply($a, $b)
    {
        return $a * $b;
    }

    public static function divide($a, $b)
    {
        return $a / $b;
    }

    public static function power($a, $b)
    {
        return $a ** $b;
    }

    public static function remainder($a, $b)
    {
        return $a % $b;
    }

    public static function quotient($a, $b)
    {
        return floor($a / $b);
    }

}