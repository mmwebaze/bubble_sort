<?php

namespace Drupal\bubble_sort\Controller;

use Drupal\bubble_sort\Service\RandomGeneratorServiceInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\bubble_sort\Util\sort\BubbleSort;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines the Bubble Sort Controller Object
 *
 * @package Drupal\bubble_sort\Controller
 */
class BubbleSortController extends ControllerBase{

    protected $randomGeneratorService;

    public function __construct(RandomGeneratorServiceInterface $randomGeneratorService ){

        $this->randomGeneratorService = $randomGeneratorService;
    }

    /**
     * /bubblesort end point
     *
     * @param Request $request
     * @return render array
     */
    public function bubbleSort(Request $request){
        $numbers = [];
        $processed = $request->attributes->get('processed');
        if($processed == 'false'){

            $numbers  = $this->randomGeneratorService->generateRandomNumbers();
        }

        $element = array(
            '#type' => 'markup',
            '#theme' => 'bubblesort',
            '#bubble_sort_data' => ['data-sort' => json_encode($numbers), 'colors' => $this->randomGeneratorService->generateColors()],
            '#attached' => array(
                'library' => array('bubble_sort/bubble_sort'),
            )
        );
        return $element;
    }
    /**
     * api/result end point
     */
    public function result( Request $request ){
        $response = ['none'];
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {

            $crc = $request->query->get('crc');
            $current = $request->query->get('current');
            $numbers = explode(',',$request->query->get('numbers'));
            $bubleSort = new BubbleSort();
            $response = $bubleSort->bubbleSort($numbers, $current, $crc);
            $response['color'] = '#FF0000';
        }

        return new JsonResponse( $response );
    }
    public static function create(ContainerInterface $container){
        return new static(
            $container->get('bubble_sort.random_generator')
        );
    }
}