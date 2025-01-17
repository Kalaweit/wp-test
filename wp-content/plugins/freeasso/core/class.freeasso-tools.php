<?php

/**
 * FreeAsso tools
 *
 * Parser, ...
 *
 * @author jeromeklam
 *
 */
class Freeasso_Tools
{

    /**
     * Enter description here ...
     *
     * @var unknown_type
     */
    const REGEX_PARAM_PLACEHOLDER = '#\[\[:(.*?):\]\]#sim';

    /**
     * Parse et remplace suivant les marqueur
     *
     * @param string $p_string
     * @param array  $p_data
     * @param string $p_regex
     *
     * @return string
     */
    public static function parse($p_string, $p_data = array(), $p_regex = null)
    {
        if ($p_regex === null) {
            $p_regex = self::REGEX_PARAM_PLACEHOLDER;
        }
        if (0 < preg_match_all($p_regex, $p_string, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $replace = '';
                if (array_key_exists($match[1], $p_data)) {
                    $replace = $p_data[$match[1]];
                }
                $p_string = str_replace(
                    $match[0],
                    $replace,
                    $p_string
                );
            }
            return self::parse($p_string, $p_data, $p_regex);
        }
        return $p_string;
    }

    /**
     * Convert to CamelCase
     *
     * @param string  $p_str
     * @param boolean $p_first
     * @param string  $p_glue
     *
     * @return string
     */
    public static function toCamelCase($p_str, $p_first = false, $p_glue = '_')
    {
        if ($p_first) {
            $p_str[0] = strtoupper($p_str[0]);
        }
        return preg_replace_callback(
            "|{$p_glue}([a-z])|",
            function ($matches) use ($p_glue) {
                return str_replace($p_glue, '', strtoupper($matches[0]));
            },
            $p_str
        );
    }
}
