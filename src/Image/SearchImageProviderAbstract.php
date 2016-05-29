<?php

namespace SearchManager\Image;

abstract class SearchImageProviderAbstract implements ImageSearchInterface
{
    abstract public function getImage($query);
}
