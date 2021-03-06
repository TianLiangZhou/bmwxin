<?php

declare(strict_types=1);

namespace Shrimp\Support;

/**
 * Class Arr
 * @package Shrimp\Support
 */
class Arr
{
    /**
     * 根据key排序转换成http query
     *
     * @param array $array
     * @param callable|null $encode
     * @return string
     */
    public static function sortQuery(array $array, callable $encode = null): string
    {
        ksort($array);
        $query = '';
        foreach ($array as $key => $value) {
            if ($value == '' || $value == null || is_array($value)) {
                continue;
            }
            $query .= "$key=" . ($encode ? call_user_func($encode, $value) : $value) . '&';
        }
        return rtrim($query, '&');
    }

    /**
     * @param array $headers
     * @param callable|null $encode
     * @return array
     */
    public static function header(array $headers, callable $encode = null): array
    {
        ksort($headers);
        foreach ($headers as $name => $value) {
            $join[] = ($encode ? call_user_func($encode, strtolower($name)) : $name)
                . ':'
                . ($encode ? call_user_func($encode, $value) : $value);
        }
        return $join;
    }

    /**
     * @param array $array
     * @return Str
     */
    public static function query(array $array): string
    {
        return http_build_query($array, null, '&', PHP_QUERY_RFC3986);
    }
}
