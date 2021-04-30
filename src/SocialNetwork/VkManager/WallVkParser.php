<?php

namespace App\SocialNetwork\VkManager;

use Exception;

class WallVkParser {

    // Количество постов
    const COUNT_POST = 20;

    private $arIdsGroupsForParsing = [];

    /**
     * @param array $arIdsGroup айдишники групп вконтакте
     */
    public function __construct(array $arIdsGroup) {
	$this->arIdsGroupsForParsing = $arIdsGroup;
    }

    public function getPosts(): array {
	$arPosts = [];

	foreach ($this->arIdsGroupsForParsing as $id) {
	    sleep(1);

	    $queryData = [
		'v' => '5.124',
		'access_token' => $_SERVER['VK_TOKEN'],
		'count' => self::COUNT_POST,
		'owner_id' => '-' . $id
	    ];

	    $response = file_get_contents("http://api.vk.com/method/wall.get?" . http_build_query($queryData));

	    $arValidPosts = WallVkValidator::validateResponsePosts($response);

	    if (!empty($arValidPosts)) {
		// $arPosts[] = $arValidPosts;

		$arPosts = array_merge($arPosts, $arValidPosts);
	    }
	}

//	$arPosts = array_unique($arPosts);

	shuffle($arPosts);

	return $arPosts;
    }

}
