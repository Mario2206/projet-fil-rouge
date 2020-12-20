<?php 

namespace Core\Tools;

class Cleaner {

    /**
     * For cleaning up string array from HTML syntax
     * 
     * @param array $content 
     * 
     * @return array
     */
    public static function cleanArray(array $content) : array {
        $formatedArray = $content;
        array_walk_recursive($content, function ($value, $k) {
            $formatedArray[$k] =  htmlspecialchars($value);
        });
        return $formatedArray;
    }

    /**
     * For cleaning up a string value from HTML syntax
     * 
     * @param string $value 
     * 
     * @return string
     */
    public static function cleanHtml (string $value) : string {
        return htmlspecialchars($value);
    }
}