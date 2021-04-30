<?php

namespace App\SocialNetwork\VkManager;

class WallVkCreator {

    const GROUP_ID = 147576106;

    public static function post($text) {

	$data = [
	    'owner_id' => '-' . self::GROUP_ID,
	    'access_token' => $_SERVER['VK_TOKEN'],
	    'message' => $text,
	    'v' => '5.124'
	];

	$response = file_get_contents("http://api.vk.com/method/wall.post?" . http_build_query($data));

	echo '<pre>';
	print_r($response);
	echo '</pre>';
    }

}
