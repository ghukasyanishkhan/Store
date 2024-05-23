<?php
namespace App\helpers;
trait Functions
{
    private function swapNullValues($array1, $array2)
    {
        $result = [];

        foreach ($array1 as $key => $value) {
            if ($value !== null) {
                $result[$key] = $value;
            } elseif (isset($array2[$key]) && $array2[$key] !== null) {
                $result[$key] = $array2[$key];
            }
        }

        return $result;
    }
}
