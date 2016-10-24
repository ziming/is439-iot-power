<?php
namespace App\Transformers;
use League\Fractal;

// This class is not used anymore but kept here in case we need it in the future.
// Replaced by Fractal Transformer Parent class.

abstract class Transformer extends Fractal\TransformerAbstract
{
    /**
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }
    public abstract function transform($item);
}