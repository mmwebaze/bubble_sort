<?php
namespace Drupal\bubble_sort\Service;

use Drupal\Core\Config\ConfigFactory;

/**
 * Defines a  Random Generator Service object
 *
 * @package Drupal\bubble_sort\Service
 */
class RandomGeneratorService implements RandomGeneratorServiceInterface {
    protected $sortSize;
    public function __construct(ConfigFactory $configFactory) {
        $this->configFactory = $configFactory->getEditable('bubble_sort.settings');
        $this->sortSize = $this->configFactory->get('sort_size');
    }
    /**
     * {@inheritdoc}
     */
    public function generateRandomNumbers()
    {
        $randomNumberList = array();

        //$maxGeneratedNumbers = $this->configFactory->get('bubble_sort.sort_size');
        $min = $this->configFactory->get('min_range');
        $max = $this->configFactory->get('max_range');

        for($n = 0; $n < $this->sortSize; $n++ ){
            array_push($randomNumberList, mt_rand($min,$max));
        }

        return $randomNumberList;
    }
    /**
     * {@inheritdoc}
     */
    public function generateColors(){
        $colors = [];
        for($i = 0; $i < $this->sortSize; $i++){
            array_push($colors, sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
        }

        return implode(',',$colors);
    }
}