<?php
namespace SearchManager\Adapter;

use SearchManager\Image\ImageSearchInterface;
use SearchManager\Image\SearchImageDTO;
use SearchManager\Image\SearchImageProviderProxy;

class GoogleAdapter implements AdapterInterface
{
    /**
     * @var SearchImageProviderProxy
     */
    private $adapter;

    public function __construct(ImageSearchInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $query
     * @param int $cursor
     * @return SearchImageDTO
     */
    public function generate($query, $cursor = 1)
    {
        $result = $this->adapter->getImage($query, $cursor);

        return $result;
    }
}
