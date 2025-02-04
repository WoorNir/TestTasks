<?php

namespace Json\Stringify;

function toString($value)
{
    return trim(var_export($value, true), "'");
}

function stringify($value, $replacer = ' ', $spacesCount = 1)
{
    if (!is_array($value)) {
        return toString($value);
    }
    $iter = function ($array, $depth = 1) use ($replacer, $spacesCount, &$iter) {
        $indent = str_repeat($replacer, $depth * $spacesCount);
        $begin = "{\n";
        $body = '';
        foreach ($array as $key => $val) {
            if (!is_array($val)) {
                $innerIndent = str_repeat($replacer, ($depth - 1) * $spacesCount);
                $body .= "{$indent}{$key}: " . toString($val) . "\n";
            } else {
                $body .= "{$indent}{$key}: " . $iter($val, $depth + 1);
            }
        }
        $body = rtrim($body);
        $end = "\n$innerIndent}";
        return "{$begin}{$body}{$end}";
    };
    return $iter($value);
}
