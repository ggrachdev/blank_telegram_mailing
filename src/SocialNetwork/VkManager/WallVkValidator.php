<?php

namespace App\SocialNetwork\VkManager;

class WallVkValidator {

    const STOP_WORDS = [
	'курьер', 'массаж', 'акция',
	'релакс', 'внимание', '***',
	'закладка', 'опро', 'правил',
	'опубликована', 'реклам', 'vk.cc',
	'танцов', 'вахт', 'forms',
	'vk-hr', 'танц', 'интим',
	'click', 'конфиденциальность', 'галка',
	'вакантн', 'эскорт', 'секс', 'google'
    ];
    const LAST_COUNT_DAYS_VALID = 2;

    /**
     * Валидация ответа вконтакте, возвращает массив с записями для публикации
     * 
     * @param type $response json ответ вк
     */
    public static function validateResponsePosts($response): array {
	$arResponse = json_decode($response, true);

	$arPosts = [];

	if (!empty($arResponse['response']['items'])) {

	    foreach ($arResponse['response']['items'] as $arItem) {

		// Удаляем теги
		$arItem['text'] = preg_replace('/#[A-ZА-Я_а-яa-z0-9]+/u', '', $arItem['text']);
		$arItem['text'] = trim($arItem['text']);

		if (array_key_exists('text', $arItem)) {
		    $isValid = self::validateText($arItem['text']);
		} else {
		    $isValid = false;
		}

		if ((time() - $arItem['date']) > 86400 * self::LAST_COUNT_DAYS_VALID) {
		    $isValid = false;
		}

		if ($isValid) {
		    $arPosts[] = $arItem;
		}
	    }
	}

	return $arPosts;
    }

    public static function validateText($text): bool {
	$textIsValid = true;

	if (empty(trim($text))) {
	    $textIsValid = false;
	} else {
	    foreach (self::STOP_WORDS as $stopWord) {
		if (mb_stripos($text, $stopWord) !== FALSE) {
		    $textIsValid = false;
		    break;
		}
	    }

	    // Ищем телефон
	    if (
//			!preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $text) &&
		    mb_stripos($text, 8) === FALSE &&
		    mb_stripos($text, 7) === FALSE &&
		    mb_stripos($text, '+7') === FALSE
	    ) {
		$textIsValid = false;
	    }
	}

	return $textIsValid;
    }

}
