<?php

namespace SearchManager\Image;

use Staticus\Config\ConfigInterface;

/**
 * @package Index\Service
 * @info  : https://developers.google.com/custom-search/json-api/v1/reference/cse/list
 */
class GoogleCustomSearchImage extends SearchImageProviderAbstract
{
    const GOOGLE_SEARCH_API_URL = 'https://www.googleapis.com/customsearch/v1';
    const GOOGLE_SEARCH_TYPE = 'image';
    const GOOGLE_SEARCH_FILE_TYPE = 'jpg';
    const GOOGLE_SEARCH_IMAGE_SIZE = 'xlarge';
    const GOOGLE_SEARCH_RESPONSE_FORMAT = 'json';
    const GOOGLE_SEARCH_REQUEST_METHOD = 'GET';
    const GOOGLE_SEARCH_PARAM_SAFE = 'medium';
    protected $config = [];
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->get('api.google');
    }
    /**
     * @param $query
     * @throws \SearchManager\Image\Exception\ImageSearchException
     * @return stdClass
     */
    public function getImage($query)
    {
        $arguments = [
            'key' => $this->config['key'],
            'cx' => $this->config['cx'],
            'q' => $query,
            'searchType' => self::GOOGLE_SEARCH_TYPE,
            'fileType' => self::GOOGLE_SEARCH_FILE_TYPE,
            'imgSize' => self::GOOGLE_SEARCH_IMAGE_SIZE,
            'alt' => self::GOOGLE_SEARCH_RESPONSE_FORMAT,
            'safe' => self::GOOGLE_SEARCH_PARAM_SAFE,
        ];

        $url = sprintf("%s?%s", self::GOOGLE_SEARCH_API_URL, http_build_query($arguments));
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_exec = curl_exec($curl);
        $result = json_decode($curl_exec);

        return $result;
    }
}
