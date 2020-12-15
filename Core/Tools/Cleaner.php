<?php 

namespace Core\Tools;

class Cleaner {

    public static function cleanArray(array $content) : array {
        $formatedArray = $content;
        array_walk_recursive($content, function ($value, $k) {
            $formatedArray[$k] =  htmlspecialchars($value);
        });
        return $formatedArray;
    }

    public static function cleanHtml (string $value) : string {
        return htmlspecialchars($value);
    }
}