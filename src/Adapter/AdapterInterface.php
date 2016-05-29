<?php

namespace SearchManager\Adapter;

interface AdapterInterface
{
    /**
     * @param string $text
     * @return mixed
     */
    public function generate($text);
}
