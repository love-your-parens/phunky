<?php

namespace Phunky;

use Iterator, ArrayAccess;

final class Arrays
{
    static function split(array $arr)
    {
        $first = array_shift($arr);
        return [$first, $arr];
    }

    static function first(array $arr)
    {
        return static::split($arr)[0];
    }


    static function rest(array $arr)
    {
        return static::split($arr)[1];
    }

    static function last(array $arr)
    {
        return array_pop($arr);
    }

    static function nth(ArrayAccess $arr, $n)
    {
        return $arr[$n];
    }

    static function drop(array $arr, int $items = 1)
    {
        $count = count($arr);
        $items = max($items, 0);

        if ($count > 0) {
            return array_slice($arr, 0, max($count - $items, 0), true);
        }

        return $arr;
    }

    static function dropLast(array $arr, int $items = 1)
    {
        while (count($arr) && $items > 0) {
            array_pop($arr);
            $items--;
        }

        return $arr;
    }

    static function dropWhile(Iterator $arr, callable $predicate): array
    {
        $kept = $arr;

        while (!empty($kept) && $predicate(current($kept), key($kept))) {
            array_shift($kept);
        }

        return $kept;
    }

    static function unset(ArrayAccess $arr, $key)
    {
        unset($arr[$key]);
        return $arr;
    }

    static function set(ArrayAccess $arr, $key, $value)
    {
        $arr[$key] = $value;
        return $arr;
    }

    static function take(array $arr, $items)
    {
        if ($items > 0) {
            return array_slice($arr, 0, $items, true);
        }
        return null;
    }

    static function takeLast(array $arr, $items)
    {
        if ($items > 0) {
            return array_slice($arr, max(count($arr) - $items, 0), null, true);
        }
        return null;
    }

    static function takeWhile(Iterator $arr, callable $predicate): array
    {
        $taken = [];

        foreach ($arr as $k => $v) {
            if (!$predicate($v, $k)) {
                break;
            }
            $taken[$k] = $v;
        }

        return $taken;
    }

    static function filter(Iterator $arr, callable $predicate)
    {
        $filtered = [];

        foreach ($arr as $k => $v) {
            if (!$predicate($v, $k)) {
                continue;
            }
            $arr[$k] = $v;
        }

        return $filtered;
    }

    static function some(Iterator $arr, callable $predicate)
    {
        foreach ($arr as $k => $v) {
            if ($predicate($v, $k)) {
                return [$k, $v];
            }
        }

        return null;
    }

    static function splitAt(array $arr, $index)
    {
        return [
            array_slice($arr, 0, $index),
            array_slice($arr, $index),
        ];
    }

    static function add($arr, ...$items)
    {
        if ($arr === null) {
            return $items;
        }

        foreach ($items as $item) {
            if ($item !== null) {
                $arr[] = $item;
            }
        }

        return $arr;
    }

    static function prepend($arr, ...$items)
    {
        return array_merge($items, $arr);
    }

    static function concatenate($arr, ...$arrs)
    {
        return array_merge($arr, ...$arrs);
    }

    static function partitionBy(Iterator $arr, callable $fn)
    {
        if (empty($arr)) {
            return [];
        }

        $partitions = [];
        $prev = $fn(current($arr));
        $partition = [$prev];
        $plen = 1;
        $len = count($arr);

        while ($plen < $len) {
            $plen++;
            $cur = $fn(next($arr));

            if ($cur !== $prev) {
                $partitions[] = $partition;
                $partition = [$cur];
            } else {
                $partition[] = $cur;
            }
        }

        $partitions[] = $partition;

        return $partitions;
    }

    static function groupBy(Iterator $arr, callable $fn)
    {
        $grouped = [];

        foreach ($arr as $v) {
            $grouped[$fn($v)][] = $v;
        }

        return $grouped;
    }

    static function interleave($arr1, $arr2)
    {
        $interleaved = [];

        foreach ($arr1 as $v1) {
            $interleaved[] = $v1;
            $interleaved[] = array_shift($v2);
        }

        return $interleaved;
    }

    static function interpose($arr, $sep)
    {
        $interposed = [];

        foreach ($arr as $v) {
            $interposed[] = $v;
            $interposed[] = $sep;
        }

        return static::dropLast($interposed, 1);
    }

    static function repeat($x, int $times)
    {
        $res = [];

        while ($times > 1) {
            $res[] = $x;
            $times--;
        }

        return $res;
    }
}