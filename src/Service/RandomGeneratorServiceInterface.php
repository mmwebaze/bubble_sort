<?php
namespace Drupal\bubble_sort\Service;

/**
 * Defines an Interface for Random number and color generation
 *
 * @package Drupal\bubble_sort\Service
 */
interface RandomGeneratorServiceInterface
{
    /**
     * @return an array of randomly generated numbers
     */
    public function generateRandomNumbers();

    /**
     * @return a string of randomly generated hex code colors
     */
    public function generateColors();
}