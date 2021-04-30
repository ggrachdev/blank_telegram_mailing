<?php

namespace App\SocialNetwork\TelegramManager;

class TelegramManager {

    // Максимальное публикуемое количество записей
    const MAX_COUNT_POSTS_REQUEST = 25;
    // Время задержки для постинга
    const DELAY_POST = 4;
    // Время задержки для удаления поста
    const DELAY_DELETE_POST = 1;
    const DELETE_MESSAGE_OLDER_THEN_SEC = 47 * 60 * 60;

    private $logger;
    private $chatId;
    private $token;

    public function __construct(string $token, string $chatId) {
	$this->token = $token;
	$this->chatId = $chatId;
//	$this->logger = $logger;
    }

    /**
     * Сколько постов создано за текущий хит
     * @var type 
     */
    public $postedMessagesCount = 0;

    /**
     * Отправить сообщение в телеграм
     * 
     * @param string $text
     * @return bool
     */
    public function post(string $text): bool {

	if ($this->postedMessagesCount > self::MAX_COUNT_POSTS_REQUEST) {
	    return false;
	}

	sleep(self::DELAY_POST);

	$token = $this->token;

	$data = [
	    'chat_id' => '@' . $this->chatId,
	    'text' => $text
	];

	$res = json_decode(file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?" . http_build_query($data)), true);

	if ($res['ok'] == true) {

	    $this->postedMessagesCount++;

	    $messageId = $res['result']['message_id'];

//	    $this->logger->add($messageId . ' ' . time());
	}

	return $res['ok'] == true;
    }

    /**
     * Отправить группу сообщений
     * 
     * @param array $arResultWallPostsVk
     */
    public function postMessages(array $arResultWallPostsVk) {
	if (!empty($arResultWallPostsVk)) {
	    foreach ($arResultWallPostsVk as $post) {
		$resultPost = $this->post($post['text']);
	    }
	}
    }

    public function clearOldMessages() {

	$logger = $this->logger;

	$messagesIds = $logger->getAll();

	if (!empty($messagesIds)) {
	    $messagesIdsForSave = $messagesIds;

	    $token = $this->token;

	    foreach ($messagesIds as $logString) {

		$arLog = explode(' ', $logString);
		$id = $arLog[0];
		$timePost = $arLog[1];

		if (time() - $timePost > self::DELETE_MESSAGE_OLDER_THEN_SEC) {
		    sleep(self::DELAY_DELETE_POST);

		    $requestData = [
			'chat_id' => '@' . $this->chatId,
			'message_id' => $id
		    ];

		    $urlApi = "https://api.telegram.org/bot{$token}/deleteMessage?" . http_build_query($requestData);

		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, $urlApi);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $response = curl_exec($curl);
		    $arResponse = json_decode($response, true);
		    curl_close($curl);

		    if ($arResponse['ok'] == true) {
			unset($messagesIdsForSave[array_search($id . ' ' . $timePost, $messagesIdsForSave)]);
		    }
		}
	    }

//	    $logger->set($messagesIdsForSave);
	}
    }

    /**
     * Удалить сообщения с id From по id To
     * @param int $idFrom
     * @param int $idTo
     */
    public function clearMessagesFromTo(int $idFrom, int $idTo) {
	$token = $this->token;

	for ($i = $idFrom; $i < $idTo; $i++) {
	    sleep(self::DELAY_DELETE_POST);

	    $requestData = [
		'chat_id' => '@' . $this->chatId,
		'message_id' => $i
	    ];

	    $urlApi = "https://api.telegram.org/bot{$token}/deleteMessage?" . http_build_query($requestData);

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $urlApi);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    $arResponse = json_decode($response, true);
	    curl_close($curl);
	}
    }

}
