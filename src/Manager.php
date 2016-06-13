<?php

namespace SearchManager;

use SearchManager\Adapter\AdapterInterface;
use SearchManager\Adapter\GoogleAdapter;
use SearchManager\Image\SearchImageDTO;

/**
 * Class Manager
 * @package FractalManager
 */
class Manager
{
    /**
     * @var AdapterInterface|GoogleAdapter
     */
    protected $adapter;

    /**
     * Constructor
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * Set adapter
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Get adapter
     * @return AdapterInterface|GoogleAdapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Read audio from adapter
     * @param $text
     * @param int $cursor Cursor position
     * @return SearchImageDTO
     */
    public function generate($text, $cursor = 1)
    {
        return $this->getAdapter()->generate($text, $cursor);
    }
}
