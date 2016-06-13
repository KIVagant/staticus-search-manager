<?php
namespace SearchManager\Image;

interface ImageSearchInterface
{
    /**
     * @param string $query
     * @param int $cursor Cursor position
     * @return SearchImageDTO
     */
    public function getImage($query, $cursor = 1);
}
