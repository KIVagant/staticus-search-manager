<?php

namespace SearchManager\Image;

abstract class SearchImageProviderAbstract implements ImageSearchInterface
{
    /**
     * @param string $query
     * @param int $cursor Cursor position
     * @return SearchImageDTO
     */
    abstract public function getImage($query, $cursor = 1);
}