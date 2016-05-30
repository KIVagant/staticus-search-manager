<?php

namespace SearchManager\Image;

use SearchManager\Image\Exception\ImageSearchException;

/**
 * Класс реструктуризирует ответ, полученный от поискового сервиса в стандартный формат
 * @package Index\Service
 */
class SearchImageProviderProxy extends SearchImageProviderAbstract
{
    /**
     * @var GoogleCustomSearchImage
     */
    private $adapter;

    public function __construct(GoogleCustomSearchImage $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Реструктурированный результат
     * @var SearchImageDTO
     */
    protected $result;

    /**
     * @param $query
     * @throws ImageSearchException
     * @return SearchImageDTO
     */
    public function getImage($query)
    {
        $this->result = new SearchImageDTO();
        // Если потребуется, итоговые данные можно преобразовать в формат, ожидаемый извне
        $originResult = $this->adapter->getImage($query);
        if ($this->adapter instanceof GoogleCustomSearchImage) {
            $this->remapGoogleCommon($originResult, $query);
        }
//        } elseif ($this->adapter instanceof YahooImage) { // service closed
//            $this->remapYahooCommon($originResult);
//        }

        return $this->result;
    }

    /**
     * @param stdClass $originResult
     * @param string $query
     * @throws ImageSearchException
     */
    protected function remapGoogleCommon($originResult, $query)
    {
        $this->validateGoogleResponse($originResult, $query);
        $this->result->start = $originResult->queries->request[0]->startIndex - 1;
        $this->result->total = $originResult->queries->request[0]->totalResults;
        $this->result->items = $this->remapGoogleItems($originResult->items);
        $this->result->count = count($this->result->items);
    }

    /**
     * @param stdClass $originItems
     */
    protected function remapGoogleItems($originItems)
    {
        $items = [];
        foreach ($originItems as $originItem) {
            $item = new SearchImageItemDTO();
            $item->url = isset($originItem->link) ? $originItem->link : '';
            $item->title = isset($originItem->title) ? $originItem->title : '';
            $item->size = isset($originItem->image->byteSize) ? $originItem->image->byteSize : '';
            $item->width = isset($originItem->image->width) ? (int)$originItem->image->width : '';
            $item->height = isset($originItem->image->height) ? (int)$originItem->image->height : '';
            $item->thumbnailurl = isset($originItem->image->thumbnailLink) ? $originItem->image->thumbnailLink : '';
            $item->thumbnailwidth = isset($originItem->image->thumbnailWidth) ? (int)$originItem->image->thumbnailWidth : '';
            $item->thumbnailheight = isset($originItem->image->thumbnailHeight) ? (int)$originItem->image->thumbnailHeight : '';
            $items[] = $item;
        }

        return $items;
    }

    /**
     * @param $originResult
     * @param $query
     * @throws ImageSearchException
     */
    protected function validateGoogleResponse($originResult, $query)
    {
        if (empty($originResult->queries->request[0]->count) || empty($originResult->items)) {
            throw new ImageSearchException('Google not found any images by request "' . $query . '"!');
        }
    }
}
