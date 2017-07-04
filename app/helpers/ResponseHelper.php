<?php
namespace App\Helpers;


/**
 * Trait ResponseHelper
 * @package App\Helpers
 */
trait ResponseHelper
{

    /**
     * @param array $data
     * @return array
     */
    public function createGetUserLinks(array $data):array
    {
        return [
            "collection" => [
                "version" => "{App\Components\GitTags::getCurrentTag()[\'whole\']}",
                "href" => "http://example.org/friends/",
            ],
            "links" => [
                "rel" => "self",
                "href" => "/v{num}/users/search",
            ],
            "items" => [
                "href" => "http://example.org/friends/jdoe",
                "data" => $data,
            ]
        ];
    }

}