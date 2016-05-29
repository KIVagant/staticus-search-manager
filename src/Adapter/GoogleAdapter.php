<?php
namespace SearchManager\Adapter;

use SearchManager\Image\ImageSearchInterface;

class GoogleAdapter implements AdapterInterface
{
    /**
     * @var SearchImageProxy
     */
    private $adapter;

    public function __construct(ImageSearchInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function generate($query)
    {
        $result = $this->adapter->getImage($query);

        return $result;
    }
}
