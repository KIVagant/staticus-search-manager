<?php

namespace SearchManager\Adapter;

interface AdapterInterface
{
    /**
     * @param string $text
     * @param int $cursor
     * @return mixed
     */
    public function generate($text, $cursor = 1);
}
