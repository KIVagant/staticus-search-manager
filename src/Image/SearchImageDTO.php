<?php

namespace SearchManager\Image;

/**
 * @package Index\Service
 */
class SearchImageDTO
{
    public $start = 0;
    public $count = 0;
    public $total = 0;
    /**
     * Найденные элементы
     * @var array
     */
    public $items = [];
}
