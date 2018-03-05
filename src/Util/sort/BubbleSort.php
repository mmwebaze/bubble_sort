<?php

namespace Drupal\bubble_sort\Util\sort;

/**
 * Defines a BubbleSort utility Object with functions implementing the bubble sort algorithm
 *
 * @package Drupal\bubble_sort\Util\sort
 */
class BubbleSort {

    /**
     * @param $array the array that will be bubble sort
     * @param $current the current index of item in array that will be compared to the next item in the same array
     * @param $rc
     * @return array the bubble sort array
     */
    public  function bubbleSort($array, $current, $rc){

        $swapped = 'none';
        if ($rc > count($array)-1){
            $swapped = 'false';
        }
        $numberOfItems = count( $array ) - 1;

        $next = $current + 1;

        if ($array[$current] > $array[$next]) {
            $temp = $array[$current];
            $array[$current] = $array[$next];
            $array[$next] = $temp;
            $swapped = 'true';
        }
        if ($next > ($numberOfItems - 1 - $rc)){
            $next = 0;
            $rc = $rc + 1;
        }

        return ['array' => $array, 'status' => $swapped, 'current' => $next, 'crc' => $rc];
    }
}